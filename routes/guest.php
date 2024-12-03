<?php

use App\Http\Controllers\Guest\ArticleController;
use App\Http\Controllers\Guest\CourseController as GuestCourseController;
use App\Http\Controllers\Guest\PageController;
use Illuminate\Support\Facades\Route;


Route::prefix('/')->group(function () {

    Route::get('/', [PageController::class, 'home'])->name('home.index');
    Route::get('/about', [PageController::class, 'about'])->name('about.index');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact.index');

    Route::prefix('articles')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
        Route::get('/{slug}', [ArticleController::class, 'show'])->name('articles.show');
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
