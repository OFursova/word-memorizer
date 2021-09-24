<?php

namespace App\Http\Livewire;

use App\Models\QuizHistory;
use App\Models\Word;
use Livewire\Component;

class StartCustomQuiz extends Component
{
    public array $words = [];
    public Word $word;

    protected $listeners = ['addedToQuiz'];

    public function render()
    {
        return view('livewire.start-custom-quiz');
    }

    public function addedToQuiz(Word $word)
    {
        $this->words[] = $word['id'];
    }

    public function sendWords()
    {
        $quiz = QuizHistory::create([
            'words' => $this->words,
            'quiz_type' => 'custom'
        ]);
        return redirect()->route('training.index', ['custom' => true, 'quiz' => $quiz->id]);
    }
}
