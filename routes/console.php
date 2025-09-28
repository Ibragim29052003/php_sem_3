<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| Здесь можно регистрировать команды консоли, основанные на Closure.
| Каждая Closure привязана к экземпляру команды и позволяет легко
| взаимодействовать с вводом/выводом команд.
|
*/

// Пример команды artisan: php artisan inspire
Artisan::command('inspire', function () {
    // Выводит случайную вдохновляющую цитату
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote'); // Краткое описание команды
