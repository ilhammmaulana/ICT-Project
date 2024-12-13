<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::prefix('dashboard')->group(function () {
    // Route::get('/', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('user.courses.index');
        Route::get('/create', [CourseController::class, 'create'])->name('user.courses.create');
        Route::post('/', [CourseController::class, 'store'])->name('user.courses.store');
        Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('user.courses.edit');
        Route::get('/{course}', [CourseController::class, 'show'])->name('user.courses.show');
        Route::put('/{course}', [CourseController::class, 'update'])->name('user.courses.update');
        Route::delete('/{id}', [CourseController::class, 'destroy'])->name('user.courses.destroy');
    });
    Route::prefix('articles')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('user.articles.index');
        Route::get('/create', [ArticleController::class, 'create'])->name('user.articles.create');
        Route::post('/', [ArticleController::class, 'store'])->name('user.articles.store');
        Route::get('/edit/{article}', [ArticleController::class, 'edit'])->name('user.articles.edit');
        Route::get('/{article}', [ArticleController::class, 'show'])->name('user.articles.show');
        Route::put('/{article}', [ArticleController::class, 'update'])->name('user.articles.update');
        Route::delete('/{id}', [ArticleController::class, 'destroy'])->name('user.courses.destroy');
    });
})->middleware(['auth']);
