<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ResultsReport extends Component
{
    public array $words = [];

    public function mount() {
        $this->quizId  = $this->quizId ?? auth()->user()->quizHistory()->where('quiz_type', 'custom')->latest()->value('id');
        $this->words = QuizHistory::where('id', $this->quizId)->value('words');
        $this->maxRounds = count($this->words);
    }

    public function render()
    {
        return view('livewire.results-report');
    }
}
