<?php

use Illuminate\Support\Facades\Route;


Route::prefix('products')->group(function () {
    Route::get('/')
});