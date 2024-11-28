<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Guest\CourseController as GuestCourseController;
use App\Http\Controllers\Guest\HomeController;
use Illuminate\Support\Facades\Route;


Route::prefix('/')->group(function () {

    Route::get('/', [HomeController::class, 'index']);
    Route::prefix('articles')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
        Route::get('/{id}', [ArticleController::class, 'show'])->name('articles.show');
    });
    Route::prefix('courses')->group(function () {
        Route::get('/', [GuestCourseController::class, 'index']);
        Route::get('/{id}', [GuestCourseController::class, 'show']);
    });
    Route::prefix('abouts')->group(function () {
        Route::get('/', [GuestCourseController::class, 'index']);
    });
});
