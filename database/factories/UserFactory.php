<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Фабрика для генерации тестовых пользователей.
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Статический пароль, используемый фабрикой.
     * Позволяет всем тестовым пользователям иметь один и тот же хэшированный пароль.
     */
    protected static ?string $password;

    /**
     * Определяет стандартное состояние модели.
     * Возвращает массив атрибутов для нового пользователя.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(), // Генерирует случайное имя
            'email' => fake()->unique()->safeEmail(), // Генерирует уникальный безопасный email
            'email_verified_at' => now(), // Устанавливает текущее время валидации email
            'password' => static::$password ??= Hash::make('password'), // Хэшированный пароль
            'remember_token' => Str::random(10), // Случайный токен "remember me"
        ];
    }

    /**
     * Состояние "не подтвержденный email".
     * Используется для тестов, когда email пользователя не верифицирован.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
