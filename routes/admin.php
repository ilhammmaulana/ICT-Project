<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
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
        Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('admin.courses.edit');
        Route::put('/{id}', [CourseController::class, 'update'])->name('admin.courses.update');
        Route::delete('/{id}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');
    });

    Route::prefix('course-modules')->group(function () {
        Route::get('/', [ModuleController::class, 'index'])->name('admin.course-modules.index');
        Route::post('/', [ModuleController::class, 'store'])->name('admin.course-modules.store');
        Route::get('/edit/{id}', [ModuleController::class, 'edit'])->name('admin.course-modules.edit');
        Route::put('/{course}', [ModuleController::class, 'update'])->name('admin.course-modules.update');
        Route::delete('/{id}', [ModuleController::class, 'destroy'])->name('admin.course-modules.destroy');
    });

    Route::prefix('course-categories')->group(function () {
        Route::get('/', [CourseCategoryController::class, 'index'])->name('admin.course-categories.index');
        Route::get('/{course_category}', [CourseCategoryController::class, 'show'])->name('admin.course-categories.edit');
        Route::delete('/{course_category}', [CourseCategoryController::class, 'show'])->name('admin.course-categories.edit');
    });
})->middleware(['auth']);
