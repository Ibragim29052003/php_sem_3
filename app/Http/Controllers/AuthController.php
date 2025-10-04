<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // -------------------- 9 ЛАБА (WEB-версия) --------------------
    // Отвечает за формы входа/регистрации через Blade
    // Сейчас активна, 10-я лаба закомментирована

    /**
     * Показ формы регистрации
     */
    public function showRegisterForm()
    {
        return view('auth.register'); // форма регистрации
    }

    /**
     * Обработка регистрации
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id'  => 2, // 1 = admin, 2 = reader
        ]);

        return redirect()->route('login.form')->with('success', 'Регистрация прошла успешно. Войдите.');
    }

    /**
     * Показ формы входа
     */
    public function showLoginForm()
    {
        return view('auth.login'); // форма входа
    }

    /**
     * Обработка входа
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'Вы успешно вошли!');
        }

        return back()->withErrors([
            'email' => 'Неверные данные для входа',
        ])->withInput();
    }

    /**
     * Выход из системы
     */
    public function logout(Request $request)
    {
        $request->user()?->tokens()->delete(); // удаляем Sanctum-токены
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Вы вышли из системы.');
    }

    // -------------------- КОНЕЦ 9 ЛАБЫ --------------------


    /*
    // -------------------- 10 ЛАБА (API-версия) --------------------
    // Закомментирована, чтобы не ломать web-версию
    public function apiRegister(Request $request) { ... }
    public function apiLogin(Request $request) { ... }
    public function apiLogout(Request $request) { ... }
    // -------------------- КОНЕЦ 10 ЛАБЫ --------------------
    */
}
