<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Миграция для таблицы неудачных заданий очереди.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id(); // ID задания
            $table->string('uuid')->unique(); // Уникальный UUID задания
            $table->text('connection'); // Название подключения к очереди
            $table->text('queue'); // Имя очереди
            $table->longText('payload'); // Сериализованные данные задания
            $table->longText('exception'); // Сообщение об исключении
            $table->timestamp('failed_at')->useCurrent(); // Время ошибки
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');
    }
};
