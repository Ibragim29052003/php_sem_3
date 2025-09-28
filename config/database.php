<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Определяет подключение к базе данных по умолчанию, которое будет
    | использоваться для всех операций с базой данных. При необходимости
    | можно использовать несколько подключений одновременно.
    |
    */
    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Здесь определены все подключения к базам данных для вашего приложения.
    | Примеры конфигурации популярных платформ (MySQL, PostgreSQL, SQLite, SQL Server)
    | приведены ниже для удобства разработки.
    |
    | Все работы с базой данных в Laravel выполняются через PDO, поэтому
    | убедитесь, что соответствующий драйвер установлен на вашем сервере.
    |
    */
    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite', // Использует SQLite
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true), // Включение внешних ключей
        ],

        'mysql' => [
            'driver' => 'mysql', // Использует MySQL
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,   // Включение строгого режима
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'), // SSL для MySQL
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql', // Использует PostgreSQL
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public', // Схема поиска
            'sslmode' => 'prefer',      // Режим SSL
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv', // Использует SQL Server
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => env('DB_ENCRYPT', 'yes'), // Включение шифрования
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | Таблица, которая хранит информацию о выполненных миграциях.
    | Используется для отслеживания, какие миграции уже были применены.
    |
    */
    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis — это быстрый key-value стор, который поддерживает множество
    | дополнительных команд. Laravel упрощает работу с Redis через
    | конфигурацию здесь.
    |
    */
    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'), // Выбор клиента: phpredis или predis

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'), // Использование кластера Redis
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'), // Основная база Redis
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'), // База Redis для кэша
        ],

    ],

];
