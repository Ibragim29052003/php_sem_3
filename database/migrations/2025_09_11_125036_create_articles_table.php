<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Запуск миграции — создаём таблицу articles
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); // автоинкрементный id
            $table->string('title'); // заголовок статьи
            $table->text('body'); // текст статьи
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); 
            // связь с таблицей users, при удалении пользователя статьи удаляются
            $table->dateTime('published_at')->nullable(); // дата публикации (может быть пустая)
            $table->string('preview_image')->nullable();
            $table->string('full_image')->nullable();
            $table->timestamps(); // created_at и updated_at
        });
    }

    /**
     * Откат миграции
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
