<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        $successRate = auth()->user()->successRate();

        return view('words.statistics', compact('successRate'));
    }
}
