<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

/**
 * Трейт, который создает экземпляр приложения для тестов.
 * Используется классом TestCase для инициализации Laravel до запуска тестов.
 */
trait CreatesApplication
{
    /**
     * Создает и возвращает экземпляр приложения Laravel.
     */
    public function createApplication(): Application
    {
        // Подключаем основной bootstrap файл приложения
        $app = require __DIR__.'/../bootstrap/app.php';

        // Запускаем bootstrap консольного ядра
        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
