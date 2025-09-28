<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * Список доверенных прокси-серверов.
     * Если null → доверяем всем прокси.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;

    /**
     * Заголовки, используемые для определения исходного клиента через прокси.
     * Например, X-Forwarded-For, X-Forwarded-Proto.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}
