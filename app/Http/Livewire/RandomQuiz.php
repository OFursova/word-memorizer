<?php

namespace App\Http\Livewire;

use App\Models\QuizHistory;
use App\Models\Variant;
use App\Models\Word;
use App\Models\WordTry;
use Livewire\Component;

class RandomQuiz extends Component
{
    public bool $quizStarted = false;
    public int $round = 0;
    public int $maxRounds = 5;
    public array $set = [];
//    public bool $showDetails = false;
//    public array $details = [];

    public function render()
    {
        $lastResults = auth()->user()->tries()->latest()->limit($this->maxRounds)->get()->where('result', 1)->count('id');

        return view('livewire.random-quiz', compact('lastResults'));
    }

    public function startQuiz()
    {
        $this->quizStarted = true;
//        TODO uncomment when each grammar class will have 5 words
//        $type = rand(1, 7);
//        $words = auth()->user()->words()->where('grammar_class_id', $type)->limit(5)->get(['name', 'translation', 'grammar_class_id']);
        $words = Word::limit($this->maxRounds)->get(['id', 'name', 'translation', 'grammar_class_id']);

        QuizHistory::create([
            'words' => $words->pluck('id')->toArray(),
            'quiz_type' => 'random'
        ]);

        $variants = Variant::get(['name', 'grammar_class_id']);

        $this->set = $words->map(function($word) use ($variants) {
            if ($word->grammar_class_id == 8) {
                $word->grammar_class_id = rand(1,3);
            }
            $vars = $variants->where('grammar_class_id', $word->grammar_class_id)->toArray();
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

//        $this->details[] = ['word' => $word->name, 'result' => $result];

        $this->round++;

        if ($this->round == 5) {
            $this->quizStarted = false;
            $this->round = 0;
            return view('livewire.random-quiz');
        }

        return view('livewire.random-quiz', compact('result'));
    }
}
