<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Сохранение нового комментария
     */
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $article->comments()->create([
            'user_id' => Auth::id(),
            'body'    => $request->body,
        ]);

        return redirect()->route('articles.show', $article)
                         ->with('success', 'Комментарий добавлен!');
    }

    // Форма редактирования
    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);
        return view('comments.edit', compact('comment'));
    }

    // Обновление комментария
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment->update($validated);

        return redirect()->route('articles.show', $comment->article_id)
                        ->with('success', 'Комментарий обновлён!');
    }


    /**
     * Удаление комментария
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Комментарий удалён!');
    }
}
