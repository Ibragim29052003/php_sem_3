<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered; // Событие "пользователь зарегистрирован"
use Illuminate\Auth\Listeners\SendEmailVerificationNotification; // Слушатель для отправки письма подтверждения
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Маппинг событий на слушатели (event → listeners).
     * Здесь мы определяем, какие слушатели должны реагировать на конкретные события.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // Когда срабатывает событие Registered (новая регистрация),
        // вызывается слушатель SendEmailVerificationNotification
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Регистрация любых событий для приложения.
     * Обычно используется для ручной регистрации событий или динамических слушателей.
     */
    public function boot(): void
    {
        // Здесь можно добавлять дополнительную логику при загрузке событий
    }

    /**
     * Определяет, следует ли автоматически обнаруживать события и слушатели.
     * Если true → Laravel сканирует папку App/Events и App/Listeners для авто-регистрации.
     *
     * @return bool
     */
    public function shouldDiscoverEvents(): bool
    {
        return false; // отключено, используется ручное указание listen[]
    }
}
