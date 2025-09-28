<?php
namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Обработка входящего запроса.
     * Если пользователь уже аутентифицирован, перенаправляем на домашнюю страницу.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // Если не указаны guards, используем null (default guard)
        $guards = empty($guards) ? [null] : $guards;

        // Проверяем каждый guard
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Пользователь уже аутентифицирован → редирект на домашнюю страницу
                return redirect(RouteServiceProvider::HOME);
            }
        }

        // Иначе продолжаем обработку запроса
        return $next($request);
    }
}
