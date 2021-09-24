<?php

namespace App\Http\Livewire;

use App\Models\QuizHistory;
use App\Models\Variant;
use App\Models\Word;
use App\Models\WordTry;
use Livewire\Component;

class CustomQuiz extends Component
{
    public array $words = [];
    public bool $quizStarted = false;
    public int $round = 0;
    public int $maxRounds = 5;
    public array $set = [];
    public $quizId;

    public function mount() {
        $this->quizId  = $this->quizId ?? auth()->user()->quizHistory()->where('quiz_type', 'custom')->latest()->value('id');
        $this->words = QuizHistory::where('id', $this->quizId)->value('words');
        $this->maxRounds = count($this->words);
    }

    public function render()
    {
        $tries = auth()->user()->tries()->whereIn('word_id', $this->words)->latest()->limit($this->maxRounds)->get();
        $lastResults = $tries->where('result', 1)->count('id');
        $freshResult = $tries->first() ? $tries->first()->created_at > now()->subMinutes(5) : false;

        return view('livewire.custom-quiz', compact('lastResults', 'freshResult'));
    }

    public function startCustomQuiz()
    {
        $this->quizStarted = true;
        $words = Word::whereIn('id', $this->words)->get(['id', 'name', 'translation', 'grammar_class_id']);
        $variants = Variant::get(['name', 'grammar_class_id']);

        $this->set = $words->map(function($word) use ($variants) {
            if ($word->grammar_class_id == 8) {
                $word->grammar_class_id = rand(1,3);
            }
            $vars = $variants->where('word_id', '!=', $word->id)->where('grammar_class_id', $word->grammar_class_id)->toArray();
            shuffle($vars);

            $arr = [$word->translation, $vars[0]['name'], $vars[1]['name'], $vars[2]['name']];
            shuffle($arr);

            return ['word' => $word->name, 'vars' => $arr];
        })->toArray();

        return view('livewire.random-quiz');
    }

    public function chooseWord(string $variant)
    {
        $this->quizStarted = true;
        $result = false;

        $word = Word::where('name', $this->set[$this->round]['word'])->first();
        $meanings = $word->other_meanings;

        if ($word->translation == $variant || ($meanings && in_array($variant, $meanings))) {
            $result = true;
        }

        WordTry::create([
            'word_id' => $word->id,
            'result' => $result,
        ]);

        $this->round++;

        if ($this->round == 5) {
            $this->quizStarted = false;
            $this->round = 0;
            return view('livewire.random-quiz');
        }

        return view('livewire.random-quiz', compact('result'));
    }

}
