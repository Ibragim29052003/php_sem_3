<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | Определяет лог-канал по умолчанию, который будет использоваться для записи
    | сообщений в логи. Название должно совпадать с одним из каналов,
    | определённых в массиве "channels".
    |
    */
    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Deprecations Log Channel
    |--------------------------------------------------------------------------
    |
    | Канал для логирования предупреждений о устаревших функциях PHP и библиотек.
    | Позволяет подготовить приложение к новым версиям зависимостей.
    |
    */
    'deprecations' => [
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
        'trace' => false, // Включение/отключение трассировки
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Настройка всех лог-каналов приложения. Laravel использует библиотеку
    | Monolog, которая предоставляет мощные обработчики и форматтеры логов.
    |
    | Доступные драйверы: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */
    'channels' => [

        'stack' => [
            'driver' => 'stack',          // Стек каналов
            'channels' => ['single'],     // Включенные каналы
            'ignore_exceptions' => false, // Не игнорировать исключения
        ],

        'single' => [
            'driver' => 'single',                          // Один лог-файл
            'path' => storage_path('logs/laravel.log'),    // Путь к файлу
            'level' => env('LOG_LEVEL', 'debug'),          // Минимальный уровень логирования
            'replace_placeholders' => true,               // Заменять плейсхолдеры в сообщениях
        ],

        'daily' => [
            'driver' => 'daily',                          // Ежедневные файлы логов
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14,                                 // Сколько дней хранить логи
            'replace_placeholders' => true,
        ],

        'slack' => [
            'driver' => 'slack',                          // Логирование в Slack
            'url' => env('LOG_SLACK_WEBHOOK_URL'),        // Webhook URL
            'username' => 'Laravel Log',                  // Имя бота
            'emoji' => ':boom:',                           // Emoji для сообщений
            'level' => env('LOG_LEVEL', 'critical'),      // Минимальный уровень
            'replace_placeholders' => true,
        ],

        'papertrail' => [
            'driver' => 'monolog',                        // Использует Monolog
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => env('LOG_PAPERTRAIL_HANDLER', SyslogUdpHandler::class),
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),          // Хост Papertrail
                'port' => env('PAPERTRAIL_PORT'),         // Порт Papertrail
                'connectionString' => 'tls://'.env('PAPERTRAIL_URL').':'.env('PAPERTRAIL_PORT'),
            ],
            'processors' => [PsrLogMessageProcessor::class], // Обработка сообщений по PSR
        ],

        'stderr' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr', // Вывод логов в STDERR
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'syslog' => [
            'driver' => 'syslog',           // Логирование в системный журнал
            'level' => env('LOG_LEVEL', 'debug'),
            'facility' => LOG_USER,          // Используемая facility
            'replace_placeholders' => true,
        ],

        'errorlog' => [
            'driver' => 'errorlog',         // Логирование в error_log PHP
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        'null' => [
            'driver' => 'monolog',          // Канал заглушка (не пишет логи)
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laravel.log'), // Файл для аварийного логирования
        ],
    ],

];
