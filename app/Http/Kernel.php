<?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Глобальные HTTP middleware → выполняются на каждом запросе.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class, // защита host header
        \App\Http\Middleware\TrustProxies::class, // доверенные прокси
        \Illuminate\Http\Middleware\HandleCors::class, // CORS
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class, // режим обслуживания
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class, // лимит POST
        \App\Http\Middleware\TrimStrings::class, // обрезка строк
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class, // пустые строки → null
    ];

    /**
     * Группы middleware → применяются к роутам web и api
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class, // шифрование cookies
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, // добавление cookies в ответ
            \Illuminate\Session\Middleware\StartSession::class, // запуск сессии
            \Illuminate\View\Middleware\ShareErrorsFromSession::class, // ошибки в сессии
            \App\Http\Middleware\VerifyCsrfToken::class, // CSRF защита
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // подстановка route model binding
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api', // лимит запросов
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Алиасы middleware → удобно использовать в роутерах.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
