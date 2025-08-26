<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\QuestionAnswer;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    //

    public function show(Request $request) {
        try {
            //aktifkan code jika terintegrasi semua
            // $user = Auth::user();
            // $participant = Participant::where('user_id', $user->id)->first();
            // $competitionId = $participant->competition_id;
            // $token = $participant->token;
            
            //ini hanya untuk testing, matikan jika sudah terintegrasi
            $competitionId = 1;
            $token = 12345;

    
            $validated = $request->validate([
                'question' => 'nullable|numeric'
            ]);

            $questions = Question::where('competition_id', $competitionId)->get();
            $countQuestion = $questions->count();
            $questions = $questions->toArray();

            $questionNo = $validated['question'] ?? null;

            if ($questionNo !== null && ($questionNo > $countQuestion || $questionNo < 1)) {
                abort(404, 'soal tidak ditemukan');
            }

            $noSoal = $questionNo ?? 1;

            $randomQestions = seeded_shuffle($questions, $token);

            $selectQuestion = $randomQestions[$noSoal - 1];

            $answer = QuestionAnswer::where('question_id', $selectQuestion['id'])->get();

            return response()->json([
                'success' => true,
                'question' => $selectQuestion,
                'answer' => $answer
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() 
            ], 500);
        }


    }
}
