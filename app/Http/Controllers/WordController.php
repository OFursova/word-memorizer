<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWordRequest;
use App\Http\Requests\UpdateWordRequest;
use App\Models\Category;
use App\Models\GrammarClass;
use App\Models\Word;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $words = Word::where('added_by', '!=', auth()->id())
            ->with(['categories', 'grammarClass'])
            ->withCount('tries')
            ->when(request('word'), function ($query) {
                $query->where('name', 'LIKE', '%' . request('word') . '%');
            })
            ->when(request('category'), function ($query) {
                $query->whereHas('categories', function ($query) {
                    $query->where('id', request('category'));
                });
            })
            ->when(request('grammarClass'), function ($query) {
                $query->whereHas('grammarClass', function ($query) {
                    $query->where('id', request('grammarClass'));
                });
            })
            ->paginate(10)
            ->withQueryString();

        $categories = Category::all();
        $grammarClasses = GrammarClass::all();

        return view('words.index', compact('words', 'categories', 'grammarClasses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $categories = Category::all();
        $grammarClasses = GrammarClass::all();

        return view('words.create', compact('categories', 'grammarClasses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(StoreWordRequest $request)
    {
        $word = Word::create($request->validated());
        $word->users()->attach(auth()->id());
        $word->categories()->attach(request()->categories);

        return redirect()->route('user.words.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Word $word
     * @return Application|Factory|View
     */
    public function edit(Word $word)
    {
        $categories = Category::all();
        $grammarClasses = GrammarClass::all();
        $wordCategories = optional($word->categories())->pluck('id')->toArray();

        return view('words.edit', compact('categories', 'grammarClasses', 'word', 'wordCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWordRequest $request
     * @param Word $word
     * @return RedirectResponse
     */
    public function update(UpdateWordRequest $request, Word $word)
    {
        $this->authorize('update', $word);

        $word->update($request->validated());
        $word->users()->sync(auth()->id());
        $word->categories()->sync(request()->categories);

        return redirect()->route('user.words.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Word $word
     * @return RedirectResponse
     */
    public function destroy(Word $word)
    {
        $this->authorize('delete', $word);
        $word->delete();

        return redirect()->route('user.words.index');
    }
}
