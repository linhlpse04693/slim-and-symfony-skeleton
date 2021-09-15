<?php

namespace App\Http;

use App\Http\Middleware\TestMiddleware;
use Boot\Foundation\Bootstrapers\LoadAliases;
use Boot\Foundation\Bootstrapers\LoadEnv;
use Boot\Foundation\Bootstrapers\LoadHttpMiddleware;
use Boot\Foundation\Bootstrapers\LoadServiceProviders;
use Boot\Foundation\Kernel as AppKernel;

class Kernel extends AppKernel
{
    public array $middleware = [];

    public array $middlewareGroups = [
        'api' => [
            TestMiddleware::class,
        ],
    ];

    public array $bootstrap = [
        LoadEnv::class,
        LoadAliases::class,
        LoadHttpMiddleware::class,
        LoadServiceProviders::class,
    ];
}