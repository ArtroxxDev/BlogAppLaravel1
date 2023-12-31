<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;
use Illuminate\Support\Facades\Auth;



//  Route::group(['prefix'=> 'page'], function(){
//      Route::get('/', [PageController::class, 'index'])->name('index');
//      Route::get('/about', [PageController::class, 'about'])->name('about');
//      Route::get('/contact', [PageController::class, 'contact'])->name('contact');
//  });



//Principal routes
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/all', [HomeController::class, 'all'])->name('home.all');

/**
 * Se comenta las routes de articles por refactorizacion de codigo por medio de la herramienta de laravel Route::resource
 */
//Routes of  articles
// Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
// Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
// Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store'); //Enviamos el articulo en el formulario

// Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
// //para los updates se usan put o path
// Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('article.update');
// //para los deletes existe el propio metodo delete:
// Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');

//Routes refactorizadas de articles con la funcion de laravel de resource

Route::resource('articles', ArticleController::class)
        ->except('show')
        ->names('articles');

//Routes de categories con la funcion resource
Route::resource('categories', CategoryController::class)
        ->except('show') //indicamos que cree las rutas para todos los metodos menos para el show
        ->names('categories');

//ver articulos por categorias
Route::get('category/{category}', [CategoryController::class, 'detail'])->name('categories.detail');

//Routes de comentarios
Route::resource('comments', CommentController::class)
        ->only('index', 'destroy') //El metodo de store lo haremos en otra url
        ->names('comments');

//metodo para la store de comentarios

Route::get('/comment', [CommentController::class, 'store'])->name('comments.store');

//ruta para profiles
Route::resource('profiles', ProfileController::class)
        ->only('edit', 'update', 'show')
        ->names('profiles');


//ver articulos
Route::get('article/{article}', [ArticleController::class, 'show'])->name('articles.show');


Auth::routes();
