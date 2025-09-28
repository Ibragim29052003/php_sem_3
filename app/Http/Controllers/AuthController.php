<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Показ формы регистрации
     */
    public function showRegisterForm()
    {
        return view('auth.signin');
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

        // Создание пользователя с ролью reader по умолчанию
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
        return view('auth.login');
    }

    /**
     * Обработка входа
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Создаем Sanctum-токен
            $user  = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            // Сохраняем токен в сессии для фронтенда
            session(['auth_token' => $token]);

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
        // Удаляем все токены пользователя
        $request->user()?->tokens()->delete();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Вы вышли из системы.');
    }
}
