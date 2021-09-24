<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use App\Models\Word;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;

class TrainingController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('words.training');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function seedVariants()
    {
        $words = Word::where('grammar_class_id', '!=', 8)->get(['id', 'other_meanings', 'grammar_class_id']);

        foreach ($words as $word) {
            $vars = $word->other_meanings;

            if (!is_null($vars)) {
                for ($i = 0; $i < count($vars); $i++) {
                    try {
                        Variant::create([
                            'name' => $vars[$i],
                            'grammar_class_id' => $word->grammar_class_id,
                            'word_id' => $word->id
                        ]);
                    } catch (QueryException $e) {
                        continue;
                    }
                }
            }
        }

        return redirect()->route('words.index')->with('message', 'Variants seeded succesfully!');
    }
}
