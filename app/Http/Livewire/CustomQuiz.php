<?php

namespace App\Http\Livewire;

use App\Models\QuizHistory;
use App\Models\Variant;
use App\Models\Word;
use App\Models\WordTry;
use Livewire\Component;

class CustomQuiz extends Component
{
    public $words = [];
    public $quizStarted = false;
    public $round = 0;
    public $maxRounds = 5;
    public $set = [];
    public $quizId;

    public function mount() {
        $this->quizId ?? auth()->user()->quizHistory()->latest()->first()->id;
        $this->words = json_decode(QuizHistory::where('id', $this->quizId)->value('words'));
        $this->maxRounds = count($this->words);
    }

    public function render()
    {
        $tries = auth()->user()->tries()->latest()->whereIn('word_id', $this->words)->limit($this->maxRounds)->get();
        $lastResults = $tries->where('result', 1)->count();
        $freshResult = $tries->first() ? $tries->first()->created_at > now()->subMinutes(5) : false;

        return view('livewire.custom-quiz', compact('lastResults', 'freshResult'));
    }

    public function startCustomQuiz()
    {
        $this->quizStarted = true;
        $words = Word::whereIn('id', $this->words)->get(['id', 'name', 'translation', 'grammar_class_id']);
        $variants = Variant::get(['name', 'grammar_class_id']);

        for ($i = 0; $i < count($words); $i++) {
            if ($words[$i]->grammar_class_id == 8) {
                $words[$i]->grammar_class_id = rand(1,3);
            }
            $vars = $variants->where('word_id', '!=', $words[$i]->id)->where('grammar_class_id', $words[$i]->grammar_class_id)->toArray();
            shuffle($vars);
;
            $arr = [$words[$i]->translation, $vars[0]['name'], $vars[1]['name'], $vars[2]['name']];
            shuffle($arr);

            $this->set[] = [
                'word' => $words[$i]->name,
                'vars' => $arr
            ];
        }
        return view('livewire.random-quiz');
    }

    public function chooseWord(string $variant)
    {
        $this->quizStarted = true;
        $result = false;

        $word = Word::where('name', $this->set[$this->round]['word'])->first();
        $meanings = json_decode($word->other_meanings);

        if ($word->translation == $variant || ($meanings && in_array($variant, $meanings))) {
            $result = true;
        }

        WordTry::create([
            'user_id' => auth()->id(),
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
