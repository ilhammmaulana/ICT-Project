<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::prefix('articles')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('admin.articles.index');
        Route::get('/create', [ArticleController::class, 'create'])->name('admin.articles.create');
        Route::post('/', [ArticleController::class, 'store'])->name('admin.articles.store');
        Route::get('/{id}/edit', [ArticleController::class, 'edit'])->name('admin.articles.edit');
        Route::put('/{id}', [ArticleController::class, 'update'])->name('admin.articles.udpate');
        Route::delete('/{id}', [ArticleController::class, 'edit'])->name('admin.articles.edit');
    });

    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('admin.courses.index');
        Route::get('/create', [CourseController::class, 'create'])->name('admin.courses.create');
        Route::post('/', [CourseController::class, 'store'])->name('admin.courses.store');
    });

    Route::prefix('course-categories')->group(function () {
        Route::get('/', [CourseCategoryController::class, 'index'])->name('admin.course-categories.index');
        Route::get('/{course_category}', [CourseCategoryController::class, 'show'])->name('admin.course-categories.edit');
        Route::delete('/{course_category}', [CourseCategoryController::class, 'show'])->name('admin.course-categories.edit');
    });
});
