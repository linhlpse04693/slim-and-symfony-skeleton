<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

return [
    'paths' => [
        'migrations' => database_path('migrations'),
        'seeds' => database_path('seeders'),
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => env('DB_DATABASE'),
        'slim' => [
          'adapter' => 'mysql',
          'host' => env('DB_HOST', '127.0.0.1'),
          'name' => env('DB_DATABASE', 'default'),
          'user' => env('DB_USERNAME', 'root'),
          'pass' => env('DB_PASSWORD', ''),
          'port' => env('DB_PORT', '3306'),
          'charset' => 'utf8mb4',
        ],
    ],
];