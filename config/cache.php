<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | Определяет кэш-хранилище по умолчанию, которое будет использоваться
    | при работе с кэшированием, если явно не указано другое.
    |
    */
    'default' => env('CACHE_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Здесь можно определить все кэш-хранилища ("stores") для приложения
    | и указать для них драйверы. Можно создать несколько хранилищ для
    | одного и того же драйвера, чтобы группировать разные типы кэшируемых данных.
    |
    | Поддерживаемые драйверы: "apc", "array", "database", "file",
    | "memcached", "redis", "dynamodb", "octane", "null"
    |
    */
    'stores' => [

        'apc' => [
            'driver' => 'apc', // Использует APC расширение PHP
        ],

        'array' => [
            'driver' => 'array',    // Кэш хранится в массиве (не сохраняется между запросами)
            'serialize' => false,   // Не сериализовать данные
        ],

        'database' => [
            'driver' => 'database', // Кэш хранится в таблице базы данных
            'table' => 'cache',     // Таблица для кэша
            'connection' => null,   // Использовать подключение по умолчанию
            'lock_connection' => null, // Подключение для блокировок (по умолчанию)
        ],

        'file' => [
            'driver' => 'file', 
            'path' => storage_path('framework/cache/data'), // Путь для файлов кэша
            'lock_path' => storage_path('framework/cache/data'), // Путь для блокировок
        ],

        'memcached' => [
            'driver' => 'memcached', 
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'), // ID постоянного подключения
            'sasl' => [
                env('MEMCACHED_USERNAME'), // Пользователь
                env('MEMCACHED_PASSWORD'), // Пароль
            ],
            'options' => [
                // Дополнительные опции Memcached
                // Memcached::OPT_CONNECT_TIMEOUT => 2000,
            ],
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'), // Хост
                    'port' => env('MEMCACHED_PORT', 11211),       // Порт
                    'weight' => 100,                              // Вес сервера
                ],
            ],
        ],

        'redis' => [
            'driver' => 'redis',        // Драйвер Redis
            'connection' => 'cache',    // Подключение Redis для кэша
            'lock_connection' => 'default', // Подключение Redis для блокировок
        ],

        'dynamodb' => [
            'driver' => 'dynamodb', 
            'key' => env('AWS_ACCESS_KEY_ID'),           // AWS ключ доступа
            'secret' => env('AWS_SECRET_ACCESS_KEY'),   // AWS секретный ключ
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'), // Регион
            'table' => env('DYNAMODB_CACHE_TABLE', 'cache'),    // Таблица кэша
            'endpoint' => env('DYNAMODB_ENDPOINT'),             // URL эндпоинта (опционально)
        ],

        'octane' => [
            'driver' => 'octane', // Использует Laravel Octane для кэширования в памяти
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | Префикс для ключей кэша, чтобы избежать конфликтов с другими
    | приложениями, использующими то же кэш-хранилище.
    |
    */
    'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_cache_'),

];
