<?php

namespace App\Http\Controllers;

use App\Models\Article;

class MainController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')->get(); // ВСЕ статьи
        // Получаем статьи вместе с автором и количеством комментариев
        $articles = Article::with('user')->withCount('comments')->get();
        return view('welcome', compact('articles'));
    }

    public function show($img)
    {
        return view('main.full_image', compact('img'));
    }
}
