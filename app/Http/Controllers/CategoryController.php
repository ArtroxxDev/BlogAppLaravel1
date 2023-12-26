<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Article;
use App\Models\Category;
use File;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mostramos las categorias como administrador
        $categories = Category::orderBy('id', 'desc')
                ->simplePaginate(8);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = $request->all();
        //validacion de archivos para categories
        if($request->hasFile('image')){
            $category['image'] = $request->file('image')->store('categories');
        }

        //Guardado de la informacion
        Category::create($category);

        //redireccion al index de categoria con un mensaje de exito
        return redirect()->action([CategoryController::class, 'index'])
                ->with('success-create', 'categoria creada con exito');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        //si el usuario sube una imagen eliminar la anterior y almacenar la nueva
        if($request->hasFile('image')){
            File::delete(public_path('storage/'). $category->image);
            $category['image'] = $request->file('image')->store('categories');
        }

        //logica para actualizar los datos
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'is_featured' => $request->is_featured
        ]);

        return redirect()->action([CategoryController::class, 'index'], compact('category'))
                ->with('success-update', 'Categoria actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //Funcion para eliminar imagen de la categoria
        if($category->image){
            //si la categoria posee imagen, eliminar
            File::delete(public_path('storage/' . $category->image));
        }

        //luego de eliminar la imagen si es que esta existe, eliminar
        $category->delete();

        //luego de eliminar la categoria, redirigir al index con un mensaje
        return redirect()->action([CategoryController::class, 'index'], compact('category'))
                ->with('success-delete', 'Categoria eliminada con exitos');
    }

    //funcion para filtrar por categoria
    public function detail(Category $category){
        //
        $articles = Article::where([
            ['category_id', $category->id], //este select es como: select * where category_id = id ingresado
            ['status', '1']// similar al anterior pero filtra el status que sea igual a true
        ])
        ->orderBy('id', 'desc')
        ->simplePaginate(5);

        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1']
        ])->paginate(3);

        return view('subscriber.categories.detail', compact('category', 'articles', 'navbar'));
    }
}
