<?php

use App\Providers\DatabaseServiceProvider;
use App\Providers\RepositoryServiceProvider;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Capsule\Manager;

return [
    'providers' => [
        DatabaseServiceProvider::class,
        RepositoryServiceProvider::class,
        RouteServiceProvider::class,
    ],
    'aliases' => [
        'DB' => Manager::class
    ],
];
