<?php

return [
    'name' => env('APP_NAME', 'Slim 4 Auth App'),
    'env' => env('APP_ENV', 'production'),
    'url' => env('APP_URL', 'http://slim.auth'),
    'timezone' => 'UTC',
    'locale' => 'cn',
    'key' => env('APP_KEY', 'base64:uynE8re8ybt2wabaBjqMwQvLczKlDSQJHCepqxmGffE='),

    'providers' => [
        \Boot\Foundation\Providers\FileSystemServiceProvider::class,
        \Boot\Foundation\Providers\TranslatorServiceProvider::class,
        \Boot\Foundation\Providers\ValidatorServiceProvider::class,

        \App\Providers\DatabaseServiceProvider::class,
        \App\Providers\RepositoryServiceProvider::class,
    ],
    'aliases' => [
        'Auth' => \App\Support\Auth::class,
        'DB' => \Illuminate\Database\Capsule\Manager::class,
    ]
];
