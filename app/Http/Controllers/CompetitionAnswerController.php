<?php

namespace App\Http\Controllers;

use App\Models\CompetitionAnswer;
use App\Models\CompetitionAttempt;
use App\Models\Question;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompetitionAnswerController extends Controller
{
    public function autoSubmitTimeOut(Request $request) {
        // aktifkan saat sudah terintegrasi
        // $user = Auth::user(); 
        // $competitionId = $user->participant->competition_id;
        // $token = $user->participant->token;

        //hanya untuk testing
        $userId = 1;
        $competitionId = 1;
        $participant_id = 1;
        $token = 12345;

        // Ambil semua soal di kompetisi
        $questionIds = Question::where('competition_id', $competitionId)
            ->pluck('id')
            ->toArray();
        $randomQuestionIds = seeded_shuffle($questionIds, $token);

        // Ambil soal yang sudah dijawab user. Ganti $participant_id dengan $user->participant->id saat sudah integrasi
        $competititonAttempt = CompetitionAttempt::with('competition_answers')->where('participant_id', $participant_id)
            ->first();
        $answeredIds = $competititonAttempt->competition_answers->pluck('question_id')->toArray();

        // Cari soal yang belum dijawab
        $unansweredIds = [];
        foreach ($randomQuestionIds as $index => $qid) {
            if (!in_array($qid, $answeredIds)) {
                $unansweredIds[] = [
                    'no' => $index + 1, // index+1 untuk nomor soal
                    'id' => $qid
                ];
            }
        }

        // ganti $userId dengan $user->id saat sudah integrasi
        foreach ($unansweredIds as $arrayNoAndId) {
            CompetitionAnswer::create([
                'competition_attempt_id' => $competititonAttempt->id,
                'question_id'    => $arrayNoAndId['id'],
                'answer_key'         => null, // atau '-'
                'question_number' => $arrayNoAndId['no'],
            ]);
        }

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

}
