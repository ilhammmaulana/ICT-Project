<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ArticleCategoryController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\ModuleContentController;
use App\Http\Controllers\ModuleController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::prefix('articles')->group(function () {
        Route::prefix('categories')->group(function () {
            Route::get('/', [ArticleCategoryController::class, 'index'])->name('admin.article-categories.index');
            Route::get('/create', [ArticleCategoryController::class, 'create'])->name('admin.article-categories.create');
            Route::get('/{id}/edit', [ArticleCategoryController::class, 'edit'])->name('admin.article-categories.edit');
            Route::post('/', [ArticleCategoryController::class, 'store'])->name('admin.article-categories.store');
            Route::put('/{id}', [ArticleCategoryController::class, 'update'])->name('admin.article-categories.update');
            Route::delete('/{id}', [ArticleCategoryController::class, 'destroy'])->name('admin.article-categories.destroy');
        });
        Route::get('/', [ArticleController::class, 'index'])->name('admin.articles.index');
        Route::get('/create', [ArticleController::class, 'create'])->name('admin.articles.create');
        Route::post('/', [ArticleController::class, 'store'])->name('admin.articles.store');
        Route::get('/{id}/edit', [ArticleController::class, 'edit'])->name('admin.articles.edit');
        Route::put('/{id}', [ArticleController::class, 'update'])->name('admin.articles.udpate');
        Route::delete('/{id}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');
    });


    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('admin.courses.index');
        Route::get('/create', [CourseController::class, 'create'])->name('admin.courses.create');
        Route::post('/', [CourseController::class, 'store'])->name('admin.courses.store');
        // Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('admin.courses.edit');
        Route::get('/{course}', [CourseController::class, 'show'])->name('admin.courses.show');
        Route::put('/{course}', [CourseController::class, 'update'])->name('admin.courses.update');
        Route::delete('/{id}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');
    });

    Route::prefix('course-modules')->group(function () {
        Route::get('/', [ModuleController::class, 'index'])->name('admin.course-modules.index');
        Route::post('/', [ModuleController::class, 'store'])->name('admin.course-modules.store');
        Route::get('/edit/{id}', [ModuleController::class, 'edit'])->name('admin.course-modules.edit');
        Route::put('/{module}', [ModuleController::class, 'update'])->name('admin.course-modules.update');
        Route::delete('/{module}', [ModuleController::class, 'destroy'])->name('admin.course-modules.destroy');
    });

    Route::prefix('module-contents')->group(function () {
        Route::get('/', [ModuleContentController::class, 'index'])->name('admin.module-contents.index');
        Route::post('/', [ModuleContentController::class, 'store'])->name('admin.module-contents.store');
        Route::get('/edit/{id}', [ModuleContentController::class, 'edit'])->name('admin.module-contents.edit');
        Route::put('/{module_content}', [ModuleContentController::class, 'update'])->name('admin.module-contents.update');
        Route::delete('/{module_content}', [ModuleContentController::class, 'destroy'])->name('admin.module-contents.destroy');
    });

    Route::prefix('course-categories')->group(function () {
        Route::get('/', [CourseCategoryController::class, 'index'])->name('admin.course-categories.index');
        Route::post('/', [CourseCategoryController::class, 'store'])->name('admin.course-categories.store');
        Route::put('/{course_category}', [CourseCategoryController::class, 'update'])->name('admin.course-categories.update');
        Route::get('/{course_category}', [CourseCategoryController::class, 'show'])->name('admin.course-categories.edit');
        Route::delete('/{course_category}', [CourseCategoryController::class, 'destroy'])->name('admin.course-categories.destroy');
    });
});
