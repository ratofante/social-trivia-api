<?php 

use Illuminate\Support\Facades\Route;

Route::name('users.')
    //->middleware('auth')
    ->group(function() {
        Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])
            ->name('index');
        Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])
            ->where('user', '[0-9]+')
            ->name('show');
        Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])
            ->name('store');
        Route::patch('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])
            ->where('user','[0-9]+')
            ->name('update');
        Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])
            ->where('user', '[0-9]+')
            ->name('delete');
    });