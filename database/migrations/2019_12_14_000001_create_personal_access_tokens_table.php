<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Миграция для таблицы персональных токенов (Laravel Sanctum).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id(); // ID токена
            $table->morphs('tokenable'); // Поля tokenable_type и tokenable_id (связь с моделью)
            $table->string('name'); // Имя токена
            $table->string('token', 64)->unique(); // Сам токен
            $table->text('abilities')->nullable(); // Разрешения токена
            $table->timestamp('last_used_at')->nullable(); // Последнее использование токена
            $table->timestamp('expires_at')->nullable(); // Срок жизни токена
            $table->timestamps(); // created_at и updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
