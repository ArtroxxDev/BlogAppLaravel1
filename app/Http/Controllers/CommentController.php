<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Article;
use App\Models\Comment;
use Auth;
use DB;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //SELECT c.value, a.title, u.full_name
        // FROM comments c
        // JOIN articles a ON c.article_id = a.id
        // JOIN users u ON c.user_id = u.id;

        $comments = DB::table('comments as c')
                ->join('articles as a', 'c.article_id', '=', 'a.id')
                ->join('users as u', 'c.user_id', '=', 'u.id')
                ->select('c.value', 'a.title', 'u.full_name')
                ->where('a.user_id', '=', Auth::user()->id)
                ->orderBy('a.id', 'desc')
                ->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        //Verificar si en el articulo ya existe un comentario del usuario
        $result = Comment::where('user_id', Auth::user()->id)
                ->where('article_id', $request->article_id)->exists();
        //Consulta para obtener el slug y estado del articulo comentado
        $article = Article::select('status', 'slug')->find($request->article_id);

        if(!$result and $article->status == 1){
            Comment::create([
                'value'       => $request->value,
                'description' => $request->description,
                'user_id'     => Auth::user()->id,
                'article_id'  => $request->article_id,
            ]);
            return redirect()->action([ArticleController::class, 'show'], [$article->slug]);
        } else {
            return redirect()->action([ArticleController::class, 'show'], [$article->slug])
                    ->with('success-error', 'Solo puedes comentar una vez');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->action([CommentController::class, 'index'], compact('comment'))
                ->with('success-delete', 'Comentario eliminado con exito');
    }
}
