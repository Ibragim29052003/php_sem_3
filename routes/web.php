<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

// ---------- Главная ----------
Route::get('/', [MainController::class, 'index'])->name('home');

// ---------- Авторизация ----------
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');

// Выход
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ---------- Статьи ----------
Route::resource('articles', ArticleController::class);

// ---------- Комментарии ----------
Route::middleware('auth')->group(function () {
    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Редактирование комментариев
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
});

// ---------- Статические страницы ----------
Route::get('/full_image/{img}', [MainController::class, 'show'])->name('full_image');
Route::get('/about', fn() => view('main.about'))->name('about');
Route::get('/contact', fn() => view('main.contact', [
    'contact' => [
        'name'  => 'Moscow Polytech',
        'adres' => 'B. Semenovskaya h.38',
        'email' => '..@maspolytech.ru',
        'phone' => '8(499)232-2222'
    ]
]))->name('contact');
