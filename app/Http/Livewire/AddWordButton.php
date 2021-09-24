<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddWordButton extends Component
{
    public int $wordId;

    public function render()
    {
        $alreadyAdded = auth()->user()->words()->whereId($this->wordId)->exists();

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
