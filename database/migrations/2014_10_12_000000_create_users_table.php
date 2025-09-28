<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Миграция для создания таблицы пользователей.
 */
return new class extends Migration
{
    /**
     * Запуск миграции: создаёт таблицу users с основными полями.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Автоинкрементный ID
            $table->string('name'); // Имя пользователя
            $table->string('email')->unique(); // Email, уникальный
            $table->timestamp('email_verified_at')->nullable(); // Дата подтверждения email
            $table->string('password'); // Пароль
            $table->rememberToken(); // Токен "remember me"
            $table->timestamps(); // created_at и updated_at
        });
    }

    /**
     * Откат миграции: удаляет таблицу users.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
