<?php


/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Здесь создается основной объект приложения Laravel. Он является
| "контейнером IoC" (Inversion of Control) и связывает все компоненты.
|
*/

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Привязываем важные интерфейсы к конкретным классам приложения.
| Эти интерфейсы отвечают за обработку HTTP-запросов, консольных команд
| и обработку исключений.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class, // HTTP Kernel
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class, // Console Kernel
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class, // Обработчик ошибок
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| Возвращаем объект приложения. Скрипт, который вызывает этот файл,
| будет использовать его для запуска приложения.
|
*/

return $app;
