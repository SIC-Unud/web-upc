<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Models\CompetitionAnswer;
use App\Models\ForbiddenUser;
use Carbon\Carbon;
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
        if($competition->is_simulation) {
            $this->attempt = $participant->simulation_attempt;
        } else {
            $this->attempt = $participant->real_attempt;
        }
        $this->confirmFinish = false;
    }

    public function render()
    {
        return view('livewire.participant-competition');
    }
    
    public function selectOption($answerId)
    {
        $this->selectedOption = $answerId;
        $this->dispatch('start-autosave');
    }

    public function saveAnswer()
    {
        if ($this->selectedOption) {
            CompetitionAnswer::where('competition_attempt_id', $this->attempt->id)->where('question_id', $this->question->id)->update(['answer_key' => $this->selectedOption]);
            session()->flash('showNotification', true);
        }
    }

    public function recordViolation()
    {
        ForbiddenUser::updateOrCreate(
            ['user_id' => Auth::user()->id],
            ['expired_at' => now()->addMinutes(3)]
        );

        if($this->competition->is_simulation) {
            $type = 'simulation';
        } else {
            $type = 'real';
        }
        return redirect()->route('forbidden.countdown', [
            'competitionType' => $type,
            'number' => $this->question_number
        ]);
    }

    public function finishAttempt()
    {
        $correct = 0;
        $score = 0;
        $correctHots = 0;

        $this->attempt->load('competition_answers', 'competition_answers.question');
        foreach ($this->attempt->competition_answers as $compAnswer) {
            $question = $compAnswer->question;
            if (!empty($compAnswer->answer_key) && $compAnswer->answer_key == $question->question_answer_key) {
                $correct += 1;
                $score += $question->question_score;
                if ($question->is_hot) {
                    $correctHots += 1;
                }
            }
        }

        $this->attempt->update([
            "correct_answer" => $correct,
            "wrong_answer" => $this->count - $correct,
            "score" => $score,
            "correct_hots_question" => $correctHots,
            "finish_at" => Carbon::now()
        ]);

        return redirect()->route('participants.index');
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
