<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\CompetitionAnswer;
use App\Models\ForbiddenUser;
use Illuminate\Support\Facades\Auth;

class ParticipantCompetition extends Component
{
    public Competition $competition;
    public $end, $questions, $question, $answers, $pilihan, $count, $question_number, $selectedOption, $attempt, $confirmFinish;
    protected $listeners = ['moveQuestion' => 'moveQuestion'];

    public function mount(Competition $competition, $questions, $answers, $question_number, $participant, Request $request)
    {
        $this->questions = $questions;
        $this->answers = $answers;
        $this->question_number = $question_number;
        $this->question = $questions[$question_number-1]; 
        $this->pilihan = $questions[$question_number-1]->answers;
        $this->count = count($questions);
        $this->attempt = $participant->real_attempt;
        $this->confirmFinish = false;
    }

    public function render()
    {
        return view('livewire.participant-competition');
    }
    
    public function selectOption($answerId)
    {
        $this->selectedOption = $answerId;
    }

    public function recordViolation()
    {
        ForbiddenUser::updateOrCreate(
            ['user_id' => Auth::user()->id],
            ['expired_at' => now()->addMinutes(3)]
        );

        return redirect()->route('forbidden.countdown');
    }

    public function moveQuestion($number)
    {
        if ($number != $this->question_number) {
            if ($this->selectedOption) {
                CompetitionAnswer::where('competition_attempt_id', $this->attempt->id)->where('question_id', $this->question->id)->update(['answer_key' => $this->selectedOption]);
                session()->flash('showNotification', true);
            }
            return redirect("/competitions/".$this->competition->slug."?question=$number");
        }
    }
}
