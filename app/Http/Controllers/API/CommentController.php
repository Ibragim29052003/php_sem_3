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
        // Только аутентифицированные пользователи могут создавать, обновлять и удалять
        $this->middleware('auth:sanctum')->only(['store', 'update', 'destroy']);
    }

    /**
     * Добавление комментария к статье
     */
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'body' => 'required|string|max:1000'
        ]);

        $comment = $article->comments()->create([
            'user_id' => Auth::id(),
            'body'    => $request->body,
        ]);

        return response()->json([
            'message' => 'Комментарий добавлен!',
            'comment' => $comment
        ], 201);
    }

    /**
     * Обновление комментария
     * Только автор комментария или админ
     */
    public function update(Request $request, Comment $comment)
    {
        // Проверка прав
        if (Auth::id() !== $comment->user_id && Auth::user()->role_id != 1) {
            return response()->json(['message' => 'Доступ запрещён'], 403);
        }

        $request->validate([
            'body' => 'required|string|max:1000'
        ]);

        $comment->update($request->only('body'));

        return response()->json([
            'message' => 'Комментарий обновлён!',
            'comment' => $comment
        ]);
    }

    /**
     * Удаление комментария
     * Только автор комментария или админ
     */
    public function destroy(Comment $comment)
    {
        // Проверка прав
        if (Auth::id() !== $comment->user_id && Auth::user()->role_id != 1) {
            return response()->json(['message' => 'Доступ запрещён'], 403);
        }

        $comment->delete();

        return response()->json([
            'message' => 'Комментарий удалён!'
        ]);
    }

    /**
     * Просмотр комментария
     */
    public function show(Comment $comment)
    {
        return response()->json($comment);
    }
}
