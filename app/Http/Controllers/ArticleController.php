<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Mail\ArticleCreatedMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Jobs\VeryLongJob;

class ArticleController extends Controller
{
    /**
     * Список всех статей
     */
    // public function index()
    // {
    //     // Eager load автора статьи
    //     $articles = Article::with('user')->get();
    //     $articles = Article::with('user')->withCount('comments')->get();
    //     return view('articles.index', compact('articles'));
    // }




        public function index()
    {
        // Загружаем статьи с автором и количеством комментариев
        $articles = Article::with('user')->withCount('comments')->get();

        return view('articles.index', compact('articles'));
    }


    /**
     * Форма создания статьи
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Сохраняем новую статью
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'body'         => 'required|string',
            'published_at' => 'required|date',
        ]);

        $data = [
            'title'        => $request->title,
            'body'         => $request->body,
            'user_id'      => Auth::id(),
            'published_at' => $request->published_at,
            // всегда ставим дефолтную картинку
            'preview_image'=> 'placeholder_preview.png',
            'full_image'   => 'placeholder_full.png',
        ];

        $article = Article::create($data);

        // // Отправляем письмо модератору 8 ЛАБА
        // Mail::to(config('mail.moderator'))->send(new ArticleCreatedMail($article));
        

        // Отправляем письмо через очередь
        VeryLongJob::dispatch($article);

        return redirect()->route('articles.index')->with('success', 'Статья успешно создана!');
    }

       


    /**
     * Просмотр отдельной статьи
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Форма редактирования статьи
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Обновляем статью
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'body'         => 'required|string',
            'published_at' => 'required|date',
        ]);

        $article->update($validated);

        return redirect()->route('articles.index')->with('success', 'Статья успешно обновлена!');
    }

    /**
     * Удаляем статью
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Статья успешно удалена!');
    }

    public function __construct()
    {
        // Только зарегистрированные пользователи могут создавать, редактировать и удалять статьи
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
}