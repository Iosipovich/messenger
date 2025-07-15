<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/chat/{user}', [MessageController::class, 'index'])->name('chat');
    Route::post('/chat/{user}', [MessageController::class, 'store']);
});

Route::get('/users', function () {
    $users = \App\Models\User::where('id', '!=', auth()->id())->get();
    return view('users', compact('users'));
})->middleware('auth')->name('users');

require __DIR__.'/auth.php';
