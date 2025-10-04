<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // -------------------- 10 ЛАБА (API-версия) --------------------
    public function apiRegister(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'message' => 'Регистрация прошла успешно!',
            'user'    => $user,
        ], 201);
    }

    public function apiLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Неверный логин или пароль'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'message' => 'Вы успешно вошли!',
            'token'   => $token,
            'user'    => $user,
        ]);
    }

    public function apiLogout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Вы вышли из системы.']);
    }
}
