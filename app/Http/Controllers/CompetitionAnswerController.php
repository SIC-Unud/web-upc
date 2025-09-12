<?php

namespace App\Http\Controllers;

use App\Models\CompetitionAnswer;
use App\Models\CompetitionAttempt;
use App\Models\Question;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompetitionAnswerController extends Controller
{
    public function autoSubmitTimeOut(Request $request) {
        // aktifkan saat sudah terintegrasi
        // $user = Auth::user(); 
        // $competitionId = $user->participant->competition_id;
        // $participant_id = $user->participant->id;
        // $token = $user->participant->token;

        //hanya untuk testing
        $competitionId = 1;
        $participant_id = 1;
        $token = 12345;

        // Ambil semua soal di kompetisi
        $questions = Question::where('competition_id', $competitionId)->get();
        $questionsOnly = $questions->toArray();
        $randomQuestions = seeded_shuffle($questionsOnly, $token);
        $randomQuestionIds = array_column($randomQuestions, 'id');

        // Ambil soal yang sudah dijawab user.
        $competititonAttempt = CompetitionAttempt::with('competition_answers')->where('participant_id', $participant_id)
            ->first();
        $answeredIds = $competititonAttempt->competition_answers->pluck('question_id')->toArray();

        // Cari soal yang belum dijawab
        $unansweredIds = [];
        foreach ($randomQuestionIds as $index => $qid) {
            if (!in_array($qid, $answeredIds)) {
                $unansweredIds[] = [
                    'no' => $index + 1,
                    'id' => $qid
                ];
            }
        }

        
        foreach ($unansweredIds as $arrayNoAndId) {
            CompetitionAnswer::create([
                'competition_attempt_id' => $competititonAttempt->id,
                'question_id'    => $arrayNoAndId['id'],
                'answer_key'         => null, // atau '-'
                'question_number' => $arrayNoAndId['no'],
            ]);
        }

        $correct = 0;
        $score = 0;
        $correctHots = 0;
        
        foreach ($competititonAttempt->competition_answers as $compAnswer) {
            $quesId = $compAnswer->question_id;
            $qst = $questions->findOrFail($quesId);
            if (!empty($compAnswer->answer_key) && $compAnswer->answer_key == $qst->question_answer_key) {
                $correct += 1;
                $score += $qst->question_score;
                if ($qst->is_hot) {
                    $correctHots += 1;
                }
            }
        }

        $competititonAttempt->update([
            "correct_answer" => $correct,
            "wrong_answer" => $questions->count() - $correct,
            "score" => $score,
            "correct_hots_question" => $correctHots,
            "finish_at" => Carbon::now()
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Auto submit selesai',
            'unanswered_filled' => count($unansweredIds)
        ], 200);
    }

    public function hashPass($pw) {
        $hash = Hash::make($pw);

        return response()->json([
            'status' => 'succes',
            'pw' => $hash
        ], 200);
    }

    public function finishByUser() {
        // aktifkan saat sudah terintegrasi
        // $user = Auth::user(); 
        // $competitionId = $user->participant->competition_id;
        // $participant_id = $user->participant->id;

        //hanya untuk testing
        $competitionId = 1;
        $participant_id = 1;

        $questions = Question::where('competition_id', $competitionId)->get();
        $countQuestions = $questions->count();

        $competititonAttempt = CompetitionAttempt::with('competition_answers')->where('participant_id', $participant_id)
            ->first();
        $answered = $competititonAttempt->competition_answers;
        $nullAnswered = $answered->where('answer_key', null)->count();
        $countAnswerd = $answered->count();

        if ($countAnswerd < $countQuestions || $nullAnswered > 0) {
            //nanti ganti pakek return back dengan message yang sama 
            return response()->json([
                'status'  => 'fail',
                'message' => 'Terdapat soal yang belum terjawab',
            ], 400);
        }

        $correct = 0;
        $score = 0;
        $correctHots = 0;
        
        foreach ($competititonAttempt->competition_answers as $compAnswer) {
            $quesId = $compAnswer->question_id;
            $qst = $questions->findOrFail($quesId);
            if (!empty($compAnswer->answer_key) && $compAnswer->answer_key == $qst->question_answer_key) {
                $correct += 1;
                $score += $qst->question_score;
                if ($qst->is_hot) {
                    $correctHots += 1;
                }
            }
        }

        $competititonAttempt->update([
            "correct_answer" => $correct,
            "wrong_answer" => $countQuestions - $correct,
            "score" => $score,
            "correct_hots_question" => $correctHots,
            "finish_at" => Carbon::now()
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Finish berhasil',
        ], 200);
    }

}
