<?php

namespace App\Http\Middleware;

// Все cookie по умолчанию шифруются для безопасности.

// Исключения можно задать здесь, если нужно, чтобы cookie оставались открытыми.

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * Список имен cookie, которые не нужно шифровать.
     */
    protected $except = [
        //
    ];
}
