<?php
namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap сервисов вещания (broadcast)
     */
    public function boot(): void
    {
        // Подключение маршрутов вещания
        Broadcast::routes();

        require base_path('routes/channels.php'); // маршруты каналов
    }
}
