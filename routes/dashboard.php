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
        Route::get('/', [CourseController::class, 'index'])->name('courses.index');
    });

    Route::prefix('course-categories')->group(function () {
        Route::get('/', [CourseCategoryController::class, 'index'])->name('course-categories.index');
        Route::get('/{course_category}', [CourseCategoryController::class, 'show'])->name('course-categories.edit');
        Route::delete('/{course_category}', [CourseCategoryController::class, 'show'])->name('course-categories.edit');
    });
})->middleware('auth');
