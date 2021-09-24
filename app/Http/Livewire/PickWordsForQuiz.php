<?php

namespace App\Http\Livewire;

use App\Models\Word;
use Livewire\Component;

class PickWordsForQuiz extends Component
{
    public Word $word;

    public function render()
    {
        return view('livewire.pick-words-for-quiz');
    }

    public function addWordInList()
    {
        $this->emit('addedToQuiz', $this->word);
    }
}
