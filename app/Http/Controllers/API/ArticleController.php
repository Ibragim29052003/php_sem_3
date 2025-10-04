<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ArticleCreatedMail;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        $articles = Article::with('user')->withCount('comments')->get();
        return response()->json($articles);
    }

    public function show(Article $article)
    {
        $article->load('user', 'comments.user');
        return response()->json($article);
    }

    public function store(Request $request)
    {
        // Только админ
        if (Auth::user()->role_id != 1) {
            return response()->json(['message' => 'Доступ запрещён'], 403);
        }

        $request->validate([
            'title'        => 'required|string|max:255',
            'body'         => 'required|string',
            'published_at' => 'required|date',
        ]);

        $article = Article::create([
            'title'        => $request->title,
            'body'         => $request->body,
            'user_id'      => Auth::id(),
            'published_at' => $request->published_at,
            'preview_image'=> 'placeholder_preview.png',
            'full_image'   => 'placeholder_full.png',
        ]);

        // Отправка письма модератору
        try {
            Mail::to(config('mail.moderator'))->send(new ArticleCreatedMail($article));
        } catch (\Exception $e) {
            \Log::error('Ошибка отправки письма: ' . $e->getMessage());
        }

        return response()->json([
            'message' => 'Статья успешно создана!',
            'article' => $article
        ], 201);
    }

    public function update(Request $request, Article $article)
    {
        if (Auth::user()->role_id != 1) {
            return response()->json(['message' => 'Доступ запрещён'], 403);
        }

        $request->validate([
            'title'        => 'required|string|max:255',
            'body'         => 'required|string',
            'published_at' => 'required|date',
        ]);

        $article->update($request->only(['title', 'body', 'published_at']));

        return response()->json([
            'message' => 'Статья успешно обновлена!',
            'article' => $article
        ]);
    }

    public function destroy(Article $article)
    {
        if (Auth::user()->role_id != 1) {
            return response()->json(['message' => 'Доступ запрещён'], 403);
        }

        $article->delete();
        return response()->json(['message' => 'Статья удалена.']);
    }
}
