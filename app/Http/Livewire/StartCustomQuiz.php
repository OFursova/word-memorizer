<?php

namespace App\Http\Livewire;

use App\Models\QuizHistory;
use Livewire\Component;

class StartCustomQuiz extends Component
{
    public $words = [];
    public $word;

    protected $listeners = ['addedToQuiz'];

    public function render()
    {
        return view('livewire.start-custom-quiz');
    }

    public function addedToQuiz($word)
    {
        $this->words[] = $word['id'];
    }

    public function sendWords()
    {
        $quiz = QuizHistory::create([
                'user_id' => auth()->id(),
                'words' => json_encode($this->words)
            ]);
        return redirect()->route('training.index', ['custom' => true, 'quiz' => $quiz->id]);
    }
}
