<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | Здесь хранятся учетные данные сторонних сервисов, которые ваше приложение
    | может использовать для отправки писем, уведомлений или хранения данных.
    | Это стандартное место для конфигурации таких сервисов.
    |
    */

    'mailgun' => [
        // Домен Mailgun, с которого будут отправляться письма
        'domain' => env('MAILGUN_DOMAIN'),

        // Секретный ключ API Mailgun для аутентификации запросов
        'secret' => env('MAILGUN_SECRET'),

        // URL или endpoint API Mailgun. По умолчанию используется официальный API
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),

        // Схема подключения: https или http (обычно https для безопасности)
        'scheme' => 'https',
    ],

    'postmark' => [
        // Токен API Postmark, используется для аутентификации и отправки почты
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        // Ключ доступа AWS (AWS Access Key ID) для работы с SES
        'key' => env('AWS_ACCESS_KEY_ID'),

        // Секретный ключ AWS (AWS Secret Access Key)
        'secret' => env('AWS_SECRET_ACCESS_KEY'),

        // Регион AWS, где будет работать SES (например, us-east-1)
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
