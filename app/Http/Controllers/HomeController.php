<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //obtener los articulos publicos(1)
        $articles = Article::where('status', '1')
            ->orderBy('id', 'desc') //SELECT * FROM articles WHERE STATUS  = 1 ORDER BY DESC
            ->simplePaginate(10);

        //obtener las categorias con estado publicos(1) y destacadas(1)
        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1']
        ])->paginate(3);

        //el compact en la view de home envia los resultados de las querys realizadas arriba a la home para renderizarlas

        return view('home', compact('articles', 'navbar'));
        //return view('index');
    }

    //funcion para mostrar todas las categorias
    public function all(){
        $categories = Category::where('status', 1)
            ->simplePaginate(20);

        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1']
        ])->paginate(3);

        return view('home.all-categories', compact('categories', 'navbar'));
    }
}
