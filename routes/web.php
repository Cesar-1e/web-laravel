<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('questions', [QuestionController::class, 'index'])->name('questions.index');

Route::get('questions/create', [QuestionController::class, 'create'])->name('questions.create')->middleware('auth');
Route::post('questions', [QuestionController::class, 'store'])->name('questions.store')->middleware('auth');

Route::get('questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit')->middleware('auth');
Route::put('questions/{question}', [QuestionController::class, 'update'])
    ->name('questions.update')
    ->middleware('auth', 'can:update,question');

Route::get('questions/{question}', [QuestionController::class, 'show'])->name('questions.show');
Route::delete('questions/{question}', [QuestionController::class, 'destroy'])
    ->name('questions.destroy')
    ->middleware('auth', 'can:delete,question');

Route::get('blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit')->middleware('auth');
Route::put('blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update')->middleware('auth');
Route::delete('blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy')->middleware('auth');

Route::post('/answers/{question}', [AnswerController::class, 'store'])->name('answers.store')->middleware('auth');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
