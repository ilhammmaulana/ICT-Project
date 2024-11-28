<?php

use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('profile')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
})->middleware(['auth']);
