<?php

namespace App\Console;

// schedule() → управление CRON-подобным расписанием задач.

// commands() → регистрация всех artisan-команд приложения.

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * Этот метод позволяет задавать расписание для консольных команд Laravel.
     * Можно запускать команды автоматически, например раз в час, ежедневно и т.д.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Пример: запуск команды inspire каждый час
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * Здесь регистрируются все консольные команды, которые есть в приложении.
     * $this->load() загружает все команды из папки App\Console\Commands.
     * require подключает файл routes/console.php, где можно определять дополнительные команды.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
