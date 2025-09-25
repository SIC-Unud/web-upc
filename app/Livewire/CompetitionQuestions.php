<?php

namespace App\Livewire;

use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompetitionQuestions extends Component
{
    use WithFileUploads;

    public $competition;
    public $questionNumber;
    public $question;
    
    public $questionText = '';
    public $questionImage;
    public $options = [];
    public $correctAnswerIndex = null;
    public $questionScore = 1;
    public $isHot = false;
    public $optionCount = 5;
    
    public $duration = 90;
    
    public $isDirty = false;
    public $isSaving = false;
    public $isImageDeleted = false;
    public $showNotification = false;
    public $showConfirmDialog = false;
    public $pendingUrl = '';
    public $pendingAction = null;

    protected $listeners = [
        'confirmNavigation' => 'handleConfirmNavigation',
        'cancelNavigation' => 'handleCancelNavigation'
    ];

    protected $rules = [
        'questionText' => 'required|string|max:5000',
        'questionImage' => 'nullable|image|mimes:jpg,png|max:1024',
        'options' => 'required|array|min:3',
        'options.*' => 'required|string|max:100',
        'correctAnswerIndex' => 'required|integer|min:0',
        'questionScore' => 'required|integer|min:1',
        'isHot' => 'boolean',
        'duration' => 'required|integer|min:1'
    ];

    protected $messages = [
        'questionText.required' => 'Teks pertanyaan wajib diisi.',
        'questionText.string' => 'Teks pertanyaan harus berupa teks.',
        'questionText.max' => 'Teks pertanyaan maksimal 5000 karakter.',

        'questionImage.image' => 'File harus berupa gambar.',
        'questionImage.max' => 'Ukuran gambar maksimal 1MB.',
        'questionImage.mimes' => 'Gambar harus berformat jpg atau png.',

        'options.required' => 'Pilihan jawaban wajib diisi.',
        'options.array' => 'Pilihan jawaban harus berupa array.',
        'options.min' => 'Minimal harus ada 3 pilihan jawaban.',
        'options.*.required' => 'Setiap pilihan jawaban wajib diisi.',
        'options.*.string' => 'Pilihan jawaban harus berupa teks.',
        'options.*.max' => 'Pilihan jawaban maksimal 100 karakter.',

        'correctAnswerIndex.required' => 'Kunci jawaban wajib ditentukan.',
        'correctAnswerIndex.integer' => 'Indeks Kunci jawaban harus berupa angka.',
        'correctAnswerIndex.min' => 'Indeks Kunci jawaban minimal 0.',

        'questionScore.required' => 'Skor soal wajib diisi.',
        'questionScore.integer' => 'Skor soal harus berupa angka.',
        'questionScore.min' => 'Skor soal minimal 1.',

        'isHot.boolean' => 'Format soal hot harus berupa true/false.',

        'duration.required' => 'Durasi wajib diisi.',
        'duration.integer' => 'Durasi harus berupa angka (menit).',
        'duration.min' => 'Durasi minimal 1 menit.',
    ];

    public function mount($competition, $questionNumber = 1)
    {
        // $this->competition = Competition::findOrFail($competition);
        $this->questionNumber = (int) $questionNumber;
        $this->duration = $this->competition->duration ?? 90;
        
        $this->options = array_fill(0, $this->optionCount, '');

        if($competition->slug == 'sains-sd') {
            $this->optionCount = 4;
        }

        $this->loadQuestion();
    }

    public function loadQuestion()
    {
        $this->question = Question::where('competition_id', $this->competition->id)
            ->orderBy('id')
            ->skip($this->questionNumber - 1)
            ->first();

        if ($this->question) {
            $this->questionText = $this->question->question ?? '';
            $this->questionScore = $this->question->question_score ?? 1;
            $this->isHot = $this->question->is_hot ?? false;
            
            $questionAnswers = QuestionAnswer::where('question_id', $this->question->id)
                ->orderBy('id')
                ->get();
            
            $this->optionCount = max($this->optionCount, $questionAnswers->count());
            $this->options = array_pad($questionAnswers->pluck('answer_value')->toArray(), $this->optionCount, '');
            
            if ($this->question->question_answer_key) {
                $correctAnswer = $questionAnswers->where('id', $this->question->question_answer_key)->first();
                if ($correctAnswer) {
                    $this->correctAnswerIndex = $questionAnswers->search(function ($item) use ($correctAnswer) {
                        return $item->id === $correctAnswer->id;
                    });
                }
            }
        } else {
            $this->resetForm();
        }
    }

    private function resetForm()
    {
        $this->questionText = '';
        $this->questionImage = null;
        $this->options = array_fill(0, $this->optionCount, '');
        $this->correctAnswerIndex = null;
        $this->questionScore = 1;
        $this->isHot = false;
        $this->isDirty = false;
    }

    public function updatedOptionCount($value)
    {
        $this->isDirty = true;
        $value = max($this->optionCount, min(6, (int) $value));
        
        $oldOptions = $this->options;
        $this->options = array_pad(array_slice($oldOptions, 0, $value), $value, '');
        
        if ($this->correctAnswerIndex !== null && $this->correctAnswerIndex >= $value) {
            $this->correctAnswerIndex = null;
        }
    }

    public function updatedQuestionText()
    {
        $this->isDirty = true;
    }

    public function updatedOptions()
    {
        $this->isDirty = true;
    }

    public function updatedCorrectAnswerIndex()
    {
        $this->isDirty = true;
    }

    public function updatedQuestionScore()
    {
        $this->isDirty = true;
    }

    public function updatedIsHot()
    {
        $this->isDirty = true;
    }

    public function updatedDuration()
    {
        $this->isDirty = true;
    }

    public function updatedQuestionImage()
    {
        $this->isDirty = true;
    }

    public function deleteImage()
    {
        $this->questionImage = null;
        $this->isImageDeleted = true;
    }

    public function save()
    {
        $this->isSaving = true;
        try {
            $this->validate();
            
            if ($this->correctAnswerIndex >= count(array_filter($this->options))) {
                throw new \Exception('Pilihan jawaban yang benar tidak valid.');
            }

            DB::beginTransaction();

            $questionData = [
                'competition_id' => $this->competition->id,
                'question' => $this->questionText,
                'question_score' => $this->questionScore,
                'is_hot' => $this->isHot,
            ];

            if ($this->questionImage) {
                if ($this->question && $this->question->question_image) {
                    Storage::disk('public')->delete($this->question->question_image);
                }
                $questionData['question_image'] = fileUpload($this->questionImage, 'question-images');
            } else if($this->isImageDeleted) {
                if ($this->question && $this->question->question_image) {
                    Storage::disk('public')->delete($this->question->question_image);
                }
                $questionData['question_image'] = null;
            }

            if ($this->question) {
                $this->question->update($questionData);
            } else {
                $this->question = Question::create($questionData);
            }

            QuestionAnswer::where('question_id', $this->question->id)->delete();
            
            $correctAnswerId = null;
            $filteredOptions = array_filter($this->options, function($option) {
                return trim($option) !== '';
            });

            foreach ($filteredOptions as $index => $option) {
                $answer = QuestionAnswer::create([
                    'question_id' => $this->question->id,
                    'answer_value' => trim($option),
                ]);
                
                if ($index == $this->correctAnswerIndex) {
                    $correctAnswerId = $answer->id;
                }
            }

            if ($correctAnswerId) {
                $this->question->update(['question_answer_key' => $correctAnswerId]);
            }

            $this->competition->update(['duration' => $this->duration]);

            DB::commit();

            $this->isDirty = false;
            $this->showNotification = true;
            $this->questionImage = null;
            
            $this->dispatch('question-saved');
            $this->dispatch('show-notification');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal menyimpan: ' . $e->getMessage());
        } finally {
            $this->isSaving = false;
        }
    }

    public function deleteQuestion()
    {
        $this->isSaving = true;
        if (!$this->question) {
            session()->flash('error', 'Tidak ada soal untuk dihapus.');
            $this->isSaving = false;
            return;
        }
        
        try {
            DB::beginTransaction();
            
            if ($this->question->question_image) {
                Storage::disk('public')->delete($this->question->question_image);
            }
            
            QuestionAnswer::where('question_id', $this->question->id)->delete();
            
            $this->question->delete();
            
            DB::commit();
            
            $totalQuestions = $this->competition->questions()->count();
            $nextQuestionNumber = $this->questionNumber;
            
            if ($nextQuestionNumber > $totalQuestions && $totalQuestions > 0) {
                $nextQuestionNumber = $totalQuestions;
            }
            
            session()->flash('success', 'Soal berhasil dihapus.');
            
            return redirect()->route('admin.competition.question.edit', [
                'competition' => $this->competition->slug,
                'questionNumber' => $nextQuestionNumber
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal menghapus soal: ' . $e->getMessage());
        }
    }

    public function goToQuestion($questionNumber)
    {
        if ($this->isDirty) {
            $this->pendingUrl = route('admin.competition.question.edit', [
                'competition' => $this->competition->slug,
                'questionNumber' => $questionNumber
            ]);
            $this->showConfirmDialog = true;
            $this->dispatch('show-confirm-dialog');
            return;
        }

        return redirect()->route('admin.competition.question.edit', [
            'competition' => $this->competition->slug,
            'questionNumber' => $questionNumber
        ]);
    }

    public function addQuestion($questionNumber)
    {
        if ($this->isDirty) {
            $this->pendingUrl = route('admin.competition.question.edit', [
                'competition' => $this->competition->slug,
                'questionNumber' => $questionNumber
            ]);
            $this->pendingAction = 'addQuestion';
            $this->showConfirmDialog = true;
            $this->dispatch('show-confirm-dialog');
            return;
        }

        return $this->createAndRedirect($questionNumber);
    }

    private function createAndRedirect($questionNumber)
    {
        try {
            DB::beginTransaction();

            Question::create([
                'competition_id' => $this->competition->id
            ]);

            DB::commit();

            $this->isDirty = false;
            $this->questionImage = null;

            return redirect()->route('admin.competition.question.edit', [
                'competition' => $this->competition->slug,
                'questionNumber' => $questionNumber
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal menyimpan: ' . $e->getMessage());
        } finally {
            $this->isSaving = false;
        }
    }

    public function handleConfirmNavigation()
    {
        $this->isDirty = false;
        $this->showConfirmDialog = false;

        if ($this->pendingAction === 'addQuestion') {
            $params = request()->route()->parameters();
            $questionNumber = $params['questionNumber'] ?? 1;

            $this->pendingAction = null;
            return $this->createAndRedirect($questionNumber);
        }

        $this->pendingAction = null;
        return redirect($this->pendingUrl);
    }

    public function handleCancelNavigation()
    {
        $this->showConfirmDialog = false;
        $this->pendingUrl = '';
    }

    public function render()
    {
        $totalQuestions = $this->competition->questions()->count();
        
        return view('livewire.competition-questions', [
            'totalQuestions' => $totalQuestions
        ]);
    }
}