<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Broadcast;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ParticipantDashboardController extends Controller
{
    public function profil()
    {
        $user = User::with('participant', 'participant.competition')->find(Auth::user()->id);

        return view('profil', compact('user'));
    }

    public function informasi()
    {
        $broadcasts = Broadcast::latest()->get();

        return view('informasi', compact('broadcasts'));
    }

    public function competitions()
    {
        $now = now();
        $participant = Auth::user()->participant;
        $competition = $participant->competition;

        $startTime = Carbon::parse($competition->start_competition);
        $endTime = Carbon::parse($competition->end_competition);
        $startTimeFormatted = Carbon::parse($startTime)->translatedFormat('d F Y, H:i');
        $endTimeFormatted = Carbon::parse($endTime)->translatedFormat('d F Y, H:i') . ' WITA';
        $dateRange = $startTimeFormatted . ' - ' . $endTimeFormatted;

        $competitions[] = [
            'title' => $competition->is_cbt ? $competition->name : "Penyisihan ".$competition->name,
            'date' => $dateRange,
            'slug' => $competition->slug,
            'is_cbt' => $competition->is_cbt,
            'countQuestion' => $competition->question_count,
            'status' => $competition->formatted_status,
        ];

        $competitionSimulation = Competition::where('is_simulation', true)->first();
        $startTime = Carbon::parse($competitionSimulation->start_competition);
        $endTime = Carbon::parse($competitionSimulation->end_competition);
        $startTimeFormatted = Carbon::parse($startTime)->translatedFormat('d F Y, H:i');
        $endTimeFormatted = Carbon::parse($endTime)->translatedFormat('d F Y, H:i') . ' WITA';
        $dateRange = $startTimeFormatted . ' - ' . $endTimeFormatted;

        $competitions[] = [
            'title' => $competitionSimulation->name,
            'date' => $dateRange,
            'slug' => $competitionSimulation->slug,
            'is_cbt' => $competitionSimulation->is_cbt,
            'countQuestion' => $competitionSimulation->question_count,
            'status' => $competitionSimulation->formatted_status,
        ];
        
        $competitions = collect($competitions)->sortBy('date')->values();

        return view('competition', compact('competitions'));
    }

    public function cbt(Competition $competition, Request $request)
    {
        $competition->load('questions');
        $participant = Auth::user()->participant;
        $participant->load('real_attempt.competition_answers', 'simulation_attempt.competition_answers');

        if($competition->is_simulation) {
            $attempt = $participant->simulation_attempt;
            if (!$attempt) {
                $attempt = $participant->simulation_attempt()->create([
                    'is_simulation' => true,
                    'start_at' => null,
                ]);
            }
        } else {
            if($competition->id == $participant->competition_id) {
                $attempt = $participant->real_attempt;
                if (!$attempt) {
                    $attempt = $participant->real_attempt()->create([
                        'is_simulation' => false,
                        'start_at' => null,
                    ]);
                }
            } else {
                abort(404);
            }
        }

        if($attempt->finish_at != null) {
            return redirect()->route('participants.index');
        }

        $start = $attempt->start_at ? Carbon::parse($attempt->start_at) : now();
        if (!$attempt->start_at) {
            $attempt->update(['start_at' => $start]);
        }
        $est_end = (clone $start)->addMinutes((int) $competition->duration);

        $end = min($est_end, Carbon::parse($competition->end_competition));
        $end = $end->setTimezone('Asia/Makassar')->toIso8601String();

        if ($attempt->competition_answers()->count() === 0) {
            DB::transaction(function () use ($attempt, $competition, $participant) {
                $questions = $competition->questions;

                mt_srand($participant->token);
                $shuffled = $questions->shuffle();

                foreach ($shuffled as $index => $q) {
                    $attempt->competition_answers()->create([
                        'competition_attempt_id' => $attempt->id,
                        'question_id'     => $q->id,
                        'question_number' => $index + 1,
                        'answer_key'      => null,
                    ]);
                }
            });
            $attempt->load('competition_answers');
        }

        $answers = $attempt->competition_answers->pluck('answer_key', 'question_number');
        $questions = $attempt->competition_answers
                    ->sortBy('question_number')
                    ->map(function ($answer) {
                        return $answer->question;
                    })
                    ->values();
        // dd($questions, $answers);

        $count = $questions->count();
        $question_number = max(1, min($request->get('question', 1), $count));

        return view('cbt', compact(
            'competition',
            'end',
            'participant',
            'questions',
            'answers',
            'question_number'
        ));
    }

    public function autoFinishAttempt($competitionType) {
        $participant = Auth::user()->participant;
        $participant->load('simulation_attempt', 'real_attempt');

        $attempt = null;
        if($competitionType == 'simulation') {
            if($participant->simulation_attempt && $participant->simulation_attempt->finish_at == null) {
                $attempt = $participant->simulation_attempt;
                $competition = Competition::where('slug', 'simulation')->first();
            }
        } else if($competitionType == 'real') {
            if($participant->real_attempt && $participant->real_attempt->finish_at == null) {
                $attempt = $participant->real_attempt;
                $competition = Competition::find($participant->competition_id);
            }
        }

        if($attempt != null) {
            $now = now();
            $start = $attempt->start_at ? Carbon::parse($attempt->start_at) : now();
            if (!$attempt->start_at) {
                $attempt->update(['start_at' => $start]);
            }
            $est_end = (clone $start)->addMinutes((int) $competition->duration);
            $end = min($est_end, Carbon::parse($competition->end_competition));

            if(!$now->between($start, $end)) {
                $correct = 0;
                $score = 0;
                $correctHots = 0;
    
                $attempt->load('competition_answers', 'competition_answers.question');
                foreach ($attempt->competition_answers as $compAnswer) {
                    $question = $compAnswer->question;
                    if (!empty($compAnswer->answer_key) && $compAnswer->answer_key == $question->question_answer_key) {
                        $correct += 1;
                        $score += $question->question_score;
                        if ($question->is_hot) {
                            $correctHots += 1;
                        }
                    }
                }
    
                $attempt->update([
                    "correct_answer" => $correct,
                    "wrong_answer" => $competition->question_count - $correct,
                    "score" => $score,
                    "correct_hots_question" => $correctHots,
                    "finish_at" => Carbon::now()
                ]);
            } else {
                abort(404);
            }

            return redirect()->route('participants.index');
        }
        abort(404);
    }
}
