<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

// ---------- Главная ----------
Route::get('/', [MainController::class, 'index'])->name('home');

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

// -------------------- 9 ЛАБА (Web-версии) закомментирована --------------------
// Здесь кнопки входа/регистрации, CRUD через Blade можно вернуть при необходимости
/*
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;

// Вход и регистрация через Blade
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// CRUD статей через web-интерфейс
Route::resource('articles', ArticleController::class)->middleware('auth');
*/
// -------------------- КОНЕЦ 9 ЛАБЫ --------------------
