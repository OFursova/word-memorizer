<?php

namespace App\Http\Livewire;

use App\Models\Word;
use Livewire\Component;

class AlternativeMeanings extends Component
{
    public Word $currentWord;
    public array $meanings = [];

    public function mount()
    {
        $this->meanings = $this->currentWord->other_meanings ?? [''];
    }

    public function render()
    {
        return view('livewire.alternative-meanings');
    }

    public function addMeaning()
    {
        $this->meanings[] = '';
    }
}
