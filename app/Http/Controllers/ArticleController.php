<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Auth;
use File;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mostrar los articulos en el admin
        $user = Auth::user();
        $articles = Article::where('user_id', $user->id) //SELECT * FROM ARTICLES WHERE USER_ID = id_usuario autenticado
            ->orderBy('id', 'desc')
            ->simplePaginate(10);
            return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Obtener categorias publicas
        $categories = Category::select('id', 'name')
                ->where('status', '1')
                ->get();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        //

        $request->merge([
            'user_id' => Auth::user()->id,
        ]);

        //creamos una variable para guardar la solicitud
        $article = $request->all();

        //validar si hay una imagen en el request
        if ($request->hasFile('image')){
            $article['image'] = $request->file('image')->store('articles');
        }

        Article::create('article');

        return redirect()->action([ArticleController::class, 'index'])
                ->with('success-create', 'Articulo creado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $comments = $article->comments()->simplePaginate(5);
        return view('subscriber.articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Category::select('id', 'name')
                ->where('status', '1')
                ->get();
        return view('admin.articles.edit', compact('categories', 'article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        //Si el usuario sube una nueva imagen
        if ($request->hasFile('image')){
            //eliminar la anterior ya existente
            File::delete(public_path('/storage'. $article->image));
            //y lo actualizamos con la nueva imagen
            $article['image'] = $request->file('image')->store('articles');
        }

        //logica para actualizar los datos
        $article->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'introduction' => $request->introduction,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'status' => $request->status
        ]);

        return redirect()->action([ArticleController::class, 'index'])
                ->with('success-update', 'Articulo modificado con exito');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //Eliminar la imagen del articulo
        if($article->image){
            //indicamos la ubicacion de la imagen
            File::delete(public_path('storage/' . $article->image));

        }
        //eliminar articulo
        $article->delete();

        return redirect()->action([ArticleController::class, 'index'], compact('article'))
                ->with('success-delete', 'Articulo eliminado con exito');
    }
}
