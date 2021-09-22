<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PickWordsForQuiz extends Component
{
    public $word;

    public function render()
    {
        return view('livewire.pick-words-for-quiz');
    }

    public function addWordInList()
    {
        $this->emit('addedToQuiz', $this->word);
    }
}
