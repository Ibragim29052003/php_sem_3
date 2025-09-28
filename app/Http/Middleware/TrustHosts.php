<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    /**
     * Возвращает шаблоны хостов, которым можно доверять.
     * Используется для защиты от Host Header атаки.
     *
     * @return array<int, string|null>
     */
    public function hosts(): array
    {
        // Доверяем всем поддоменам приложения
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}
