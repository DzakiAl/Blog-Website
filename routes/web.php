<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home');

Route::middleware(['auth', 'verified'])->group(function(){
    // home
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::get('/home/{blog}', [HomeController::class, 'show'])->name('home.show');
    // dashboard
    Route::get('/dashboard', [BlogController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/create', [BlogController::class, 'create'])->name('dashboard.create');
    Route::post('/dashboard', [BlogController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/{blog}', [BlogController::class, 'show'])->name('dashboard.show');
    Route::delete('/dashboard/{blog}', [BlogController::class, 'destroy'])->name('dashboard.destroy');
    // comment
    Route::post('home/{blog}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
