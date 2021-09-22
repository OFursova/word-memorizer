<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddWordButton extends Component
{
    public $wordId;

    public function render()
    {
        $alreadyAdded = auth()->user()->words()->get()->contains($this->wordId);

        return view('livewire.add-word-button', compact('alreadyAdded'));
    }

    public function addWord()
    {
        auth()->user()->words()->attach($this->wordId);
        $this->emit('wordAdded');
    }

    public function removeWord()
    {
        auth()->user()->words()->detach($this->wordId);
        $this->emit('wordAdded');
    }
}
