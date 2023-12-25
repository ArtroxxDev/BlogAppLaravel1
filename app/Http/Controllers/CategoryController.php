<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
