<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | Определяет драйвер вещания (broadcast driver), который будет использоваться
    | по умолчанию при отправке событий. Значение берется из переменной среды
    | BROADCAST_DRIVER. 
    |
    | Поддерживаемые драйверы: "pusher", "ably", "redis", "log", "null"
    |
    */
    'default' => env('BROADCAST_DRIVER', 'pusher'),

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Здесь можно определить все соединения для вещания (broadcast connections),
    | которые будут использоваться для отправки событий другим системам или
    | по WebSocket.
    |
    | Для каждого драйвера можно настроить свои параметры подключения.
    |
    */
    'connections' => [

        'pusher' => [
            'driver' => 'pusher',                // Драйвер Pusher
            'key' => env('PUSHER_APP_KEY'),      // Ключ приложения
            'secret' => env('PUSHER_APP_SECRET'),// Секретный ключ
            'app_id' => env('PUSHER_APP_ID'),    // ID приложения
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'), // Кластер Pusher
                // Дополнительные настройки можно раскомментировать при необходимости:
                // 'host' => env('PUSHER_HOST', '127.0.0.1'),
                // 'port' => env('PUSHER_PORT', 6001),
                // 'scheme' => env('PUSHER_SCHEME', 'http'),
                // 'encrypted' => false,
                'useTLS' => true, // Использовать TLS (https)
            ],
            'client_options' => [
                // Опции для Guzzle HTTP клиента: https://docs.guzzlephp.org/en/stable/request-options.html
            ],
        ],

        'ably' => [
            'driver' => 'ably',              // Драйвер Ably
            'key' => env('ABLY_KEY'),        // Ключ API
        ],

        'redis' => [
            'driver' => 'redis',             // Драйвер Redis
            'connection' => 'default',       // Подключение Redis по умолчанию
        ],

        'log' => [
            'driver' => 'log',               // Логирование событий вместо реального вещания
        ],

        'null' => [
            'driver' => 'null',              // Вещание отключено
        ],

    ],

];
