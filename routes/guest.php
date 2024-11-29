<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Guest\CourseController as GuestCourseController;
use App\Http\Controllers\Guest\HomeController;
use Illuminate\Support\Facades\Route;


Route::prefix('/')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::prefix('articles')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
        Route::get('/{id}', [ArticleController::class, 'show'])->name('articles.show');
    });
    Route::prefix('courses')->group(function () {
        Route::get('/', [GuestCourseController::class, 'index'])->name('courses.index');
        Route::get('/{slug}', [GuestCourseController::class, 'show'])->name('courses.show');
        Route::post('{id}/join', [GuestCourseController::class, 'join'])->name('courses.join');
    });
    Route::prefix('abouts')->group(function () {
        Route::get('/', [GuestCourseController::class, 'index']);
    });
});
