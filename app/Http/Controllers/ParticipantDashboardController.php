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

        if ($now->gt($endTime)) {
            $status = 'Terlewati';
        } elseif ($now->between($startTime, $endTime)) {
            $status = 'Sedang Berlangsung';
        } else {
            $status = diffInDaysHuman($startTime);
        }

        $competitions[] = [
            'title' => $competition->is_cbt ? $competition->name : "Penyisihan ".$competition->name,
            'date' => $dateRange,
            'status' => $status,
            'isMissed' => $now->gt($endTime),
        ];

        if($competition->is_cbt) {
            $simulasiConfig = Config::get('const.simulation');
            $simulasiStart = Carbon::parse($simulasiConfig['start_at']);
            $simulasiEnd = Carbon::parse($simulasiConfig['end_at']);
            $simulasiStartFormatted = $simulasiStart->translatedFormat('d F Y, H:i');
            $simulasiEndFormatted = $simulasiEnd->translatedFormat('d F Y, H:i') . ' WITA';
            $simulasiDateRange = $simulasiStartFormatted . ' - ' . $simulasiEndFormatted;
    
            if ($now->gt($simulasiEnd)) {
                $simulasiStatus = 'Terlewati';
            } elseif ($now->between($simulasiStart, $simulasiEnd)) {
                $simulasiStatus = 'Sedang Berlangsung';
            } else {
                $simulasiStatus = diffInDaysHuman($simulasiStart);
            }
    
            $competitions[] = [
                'title' => 'Simulasi Kompetisi',
                'date' => $simulasiDateRange,
                'status' => $simulasiStatus,
                'isMissed' => $now->gt($simulasiEnd),
            ];
        }
        
        $competitions = collect($competitions)->sortBy('date')->values();

        return view('competition', compact('competitions'));
    }

    public function cbt($slug, Request $request)
    {
        $competition = Competition::where('slug', $slug)->with('questions')->get()->first();
        $participant = Auth::user()->participant;
        $participant->load(['real_attempt.competition_answers' => function($query) {
            $query->orderBy('question_id');
        }]);
        $start = now();
        if ($participant->real_attempt->start_at == null) {
            $participant->real_attempt->start_at = $start;
            $participant->real_attempt->save();
        } else {
            $start = Carbon::parse($participant->real_attempt->start_at);
        }
        $est_end = $start->addMinutes($competition->duration);
        $end = ($est_end > $competition->end_competition) ? $competition->end_competition : $est_end;

        $questions = $competition->questions->all();
        $answers = $participant->real_attempt->competition_answers->pluck('answer_key')->all();
        $question_number = $request->get('question', 1);

        mt_srand($participant->token);
        $count = count($questions);
        $question_number = $question_number > $count ? 1 : $question_number;
        for ($i = $count - 1; $i > 0; $i--) {
            $j = mt_rand(0, $i);
            [$questions[$i], $questions[$j]] = [$questions[$j], $questions[$i]];
            [$answers[$i], $answers[$j]] = [$answers[$j], $answers[$i]];
        }
        
        return view('cbt', compact('competition', 'end', 'participant', 'questions', 'answers', 'question_number'));
    }
}
