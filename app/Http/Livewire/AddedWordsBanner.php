<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddedWordsBanner extends Component
{
    protected $listeners = ['wordAdded' => 'render'];

    public function render()
    {
        $addedAmount = auth()->user()->words()->count();

        return view('livewire.added-words-banner', compact('addedAmount'));
    }
}
