<?php 

use Illuminate\Support\Facades\Route;

Route::name('questions.')
    //->middleware('auth')
    ->group(function() {
        Route::get('/questions', [\App\Http\Controllers\QuestionController::class, 'index'])   
            ->name('index');
        Route::get('/questions/{question}', [\App\Http\Controllers\QuestionController::class, 'show'])
            ->where('user', '[0-9]+')
            ->name('show');
        Route::post('/questions', [\App\Http\Controllers\QuestionController::class, 'store'])
            ->name('store');
        Route::patch('/questions/{question}', [\App\Http\Controllers\QuestionController::class, 'update'])
            ->where('user', '[0-9]+')
            ->name('update');
        Route::delete('/questions/{question}', [\App\Http\Controllers\QuestionController::class, 'destroy'])
            ->where('user', '[0-9]+')
            ->name('delete');
    });