<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\PageController;

use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;



Route::group(['prefix'=> 'page'], function(){
    Route::get('/', [PageController::class, 'index'])->name('index');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
});
