<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\CompetitionAnswer;
use App\Models\CompetitionAttempt;
use Illuminate\Support\Facades\Auth;

class ParticipantCompetition extends Component
{
    public Competition $competition;
    public $end, $questions, $question, $answers, $pilihan, $count, $question_number, $selectedOption, $attempt, $confirmFinish;
    protected $listeners = ['moveQuestion' => 'moveQuestion'];
    public function mount(Competition $competition, $questions, $answers, $question_number, $participant, Request $request)
    {
        // $participant = Auth::user()->participant;
        // $participant->load(['real_attempt.competition_answers' => function($query) {
        //     $query->orderBy('question_id');
        // }]);
        // $questions = $competition->questions->all();
        // $answers = $participant->real_attempt->competition_answers->pluck('answer_key')->all();
        // $question_number = $request->get('question', 1);

        // mt_srand($participant->token);
        // $count = count($questions);
        // $question_number = $question_number > $count ? 1 : $question_number;
        // for ($i = $count - 1; $i > 0; $i--) {
        //     $j = mt_rand(0, $i);
        //     [$questions[$i], $questions[$j]] = [$questions[$j], $questions[$i]];
        //     [$answers[$i], $answers[$j]] = [$answers[$j], $answers[$i]];
        // }

        // $now = now();
        // $est_end = $now->addMinutes($competition->duration);
        // $this->end = ($est_end > $competition->end_competition) ? $competition->end_competition : $est_end;
        $this->questions = $questions;
        $this->answers = $answers;
        // dd($answers);
        $this->question_number = $question_number;
        $this->question = $questions[$question_number-1]; 
        $this->pilihan = $questions[$question_number-1]->answers;
        $this->count = count($questions);
        $this->attempt = $participant->real_attempt;
        // dd($this->attempt->competition_answers);
    }
    public function render()
    {
        return view('livewire.participant-competition');
    }
    public function selectOption($answerId)
    {
        $this->selectedOption = $answerId;
    }
    public function moveQuestion($number)
    {
        if ($number != $this->question_number) {
            if ($this->selectedOption) {
                // dd($this->question);
                CompetitionAnswer::where('competition_attempt_id', $this->attempt->id)->where('question_id', $this->question->id)->update(['answer_key' => $this->selectedOption]);
                // CompetitionAnswer::upsert([
                //     'competition_attempt_id' => $this->attempt->id,
                //     'question_id' => $this->questions[$this->question_number-1]->id,
                //     'answer_key' => $this->selectedOption,
                //     'question_number' => $this->question_number,
                // ], ['competition_attempt_id', 'question_id'], ['answer_key']);
            }
            return redirect("/competitions/".$this->competition->slug."?question=$number");
        }
    }
}
