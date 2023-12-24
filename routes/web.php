<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;
use Illuminate\Support\Facades\Auth;



 Route::group(['prefix'=> 'page'], function(){
     Route::get('/', [PageController::class, 'index'])->name('index');
     Route::get('/about', [PageController::class, 'about'])->name('about');
     Route::get('/contact', [PageController::class, 'contact'])->name('contact');
 });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/all', [HomeController::class, 'all'])->name('home.all');
