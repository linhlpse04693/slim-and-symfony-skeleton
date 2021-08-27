<?php

use App\Providers\MiddlewareServiceProvider;
use App\Providers\RouteServiceProvider;

return [
    'providers' => [
        RouteServiceProvider::class,
        MiddlewareServiceProvider::class,
    ]
];
