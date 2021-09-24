<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class UserWordsController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $words = auth()->user()->words()
            ->with(['categories', 'grammarClass'])
            ->withCount('tries')
            ->paginate(20)
            ->withQueryString();

        return view('user.words', compact('words'));
    }

    /**
     * @param Word $word
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Word $word)
    {
        $word->users()->detach(auth()->id());

        return redirect()->route('user.words.index');
    }
}
