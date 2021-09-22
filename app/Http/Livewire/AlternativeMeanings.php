<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AlternativeMeanings extends Component
{
    public $currentWord;
    public $meanings = [];

    public function mount()
    {
        if ($this->currentWord){
            $this->meanings = $this->currentWord->other_meanings ? json_decode($this->currentWord->other_meanings) : [''];
        } else {
            $this->meanings = [''];
        }
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
