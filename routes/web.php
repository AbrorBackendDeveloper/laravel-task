<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [MainController::class, 'main'])->name('main');
    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');

    Route::get('applications/{application}/answer', [AnswerController::class, 'create'])->name('answer.create')->middleware('checkManager');
    Route::post('applications/{application}/answer', [AnswerController::class, 'store'])->name('answer.store');

    Route::resource('application', ApplicationController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
