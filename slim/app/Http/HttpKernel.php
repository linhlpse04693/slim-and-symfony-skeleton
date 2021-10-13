<?php

namespace App\Http;

use App\Http\Middleware\HandleCors;
use App\Http\Middleware\RouteContextMiddleware;
use Boot\Foundation\HttpKernel as Kernel;

class HttpKernel extends Kernel
{
    /**
     * Injectable Request Input Form Request Validators
     * @var array
     */
    public array $requests = [
        Requests\LoginRequest::class,
    ];
    
    /**
     * Global Middleware
     *
     * @var array
     */
    public array $middleware = [
        RouteContextMiddleware::class,
    ];

    /**
     * Route Group Middleware
     */
    public array $middlewareGroups = [
        'api' => [],
    ];
}
