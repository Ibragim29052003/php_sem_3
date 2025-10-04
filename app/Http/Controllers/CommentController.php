<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store', 'update', 'destroy']);
    }

    // Получить все комментарии конкретной статьи
    public function index(Article $article)
    {
        $comments = $article->comments()->with('user')->get();
        return response()->json($comments);
    }

    // Получить один комментарий
    public function show(Comment $comment)
    {
        return response()->json($comment->load('user'));
    }

    // Добавление комментария
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment = $article->comments()->create([
            'user_id' => Auth::id(),
            'body'    => $request->body,
        ]);

        return response()->json([
            'message' => 'Комментарий добавлен!',
            'comment' => $comment->load('user')
        ], 201);
    }

    // Редактирование комментария
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment->update($request->only('body'));

        return response()->json([
            'message' => 'Комментарий обновлён!',
            'comment' => $comment->load('user')
        ]);
    }

    // Удаление комментария
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return response()->json(['message' => 'Комментарий удалён!']);
    }
}
