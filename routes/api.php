<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('problems')->group(function () {
    Route::name('problems.')->group(function () {
        Route::post('/first', [\App\Http\Controllers\Api\ProblemController::class, 'first'])->name('first');
        Route::get('/second/{start}/{end}', [\App\Http\Controllers\Api\ProblemController::class, 'second'])->name('second');
        Route::get('/third/{str}', [\App\Http\Controllers\Api\ProblemController::class, 'third'])->name('third');
        Route::post('/fourth', [\App\Http\Controllers\Api\ProblemController::class, 'fourth'])->name('fourth');
//        Route::get('/{id}', [\App\Http\Controllers\Api\SeatController::class, 'show'])->name('show');
    });
});


Route::prefix('login')->group(function () {
    Route::name('login.')->group(function () {
        Route::post('/', [\App\Http\Controllers\Api\LoginController::class, 'login'])->name('');
    });
});


