<?php

namespace App\Exceptions;

// dontFlash → защита конфиденциальных данных при ошибках валидации.

// register() → точка для настройки кастомной обработки исключений.

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Список полей, которые никогда не сохраняются в сессии при ошибках валидации.
     * Обычно это пароли и их подтверждения.
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Регистрация колбэков для обработки исключений.
     * Можно добавлять кастомную логику логирования, уведомления и др.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Здесь можно логировать или отправлять уведомления об ошибках
        });
    }
}
