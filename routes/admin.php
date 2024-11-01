<?php

use App\Http\Controllers\Admin\ArticleController;
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
});
