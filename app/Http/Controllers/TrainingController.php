<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use App\Models\Word;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('words.training');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function seedVariants()
    {
        $words = Word::where('grammar_class_id', '!=', 8)->get(['other_meanings', 'grammar_class_id']);

        foreach ($words as $word) {
            $vars = json_decode($word->other_meanings);

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
