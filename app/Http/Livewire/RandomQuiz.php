<?php

namespace App\Http\Livewire;

use App\Models\QuizHistory;
use App\Models\Variant;
use App\Models\Word;
use App\Models\WordTry;
use Livewire\Component;

class RandomQuiz extends Component
{
    public $quizStarted = false;
    public $round = 0;
    public $maxRounds = 5;
    public $set = [];

    public function render()
    {
        $lastResults = auth()->user()->tries()->latest()->limit($this->maxRounds)->get()->where('result', 1)->count();

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
            'user_id' => auth()->id(),
            'words' => json_encode($words->pluck('id')->toArray()),
            'quiz_type' => 'random'
        ]);

        $variants = Variant::get(['name', 'grammar_class_id']);

        for ($i = 0; $i < $this->maxRounds; $i++) {
            if ($words[$i]->grammar_class_id == 8) {
                $words[$i]->grammar_class_id = rand(1,3);
            }
            $vars = $variants->where('grammar_class_id', $words[$i]->grammar_class_id)->toArray();
            shuffle($vars);

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
