<?php

use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UserWordsController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('/words', WordController::class);

    Route::prefix('user')->name('user.')->group(function () {
        Route::resource('/words', UserWordsController::class);
    });

    Route::get('/training', [TrainingController::class, 'index'])->name('training.index');
    Route::get('/seed-variants', [TrainingController::class, 'seedVariants'])->name('seed-variants');
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics');
});
