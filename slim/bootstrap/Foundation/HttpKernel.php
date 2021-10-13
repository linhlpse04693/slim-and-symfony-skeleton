<?php


namespace Boot\Foundation;


use App\Http\Requests\LoginRequest;

class HttpKernel extends Kernel
{
    /**
     * Injectable Request Input Form Request Validators
     * @var array
     */
    public array $requests = [];

    /**
     * Global Middleware
     *
     * @var array
     */
    public array $middleware = [];

    /**
     * Route Group Middleware
     */
    public array $middlewareGroups = [
        'api' => [],
    ];

    public array $bootstrappers = [
        Bootstrappers\LoadEnvironmentDetector::class,
        Bootstrappers\LoadEnvironmentVariables::class,
        Bootstrappers\LoadConfiguration::class,

        Bootstrappers\LoadDebuggingPage::class,
        Bootstrappers\LoadAliases::class,
        Bootstrappers\LoadHttpMiddleware::class,
        Bootstrappers\LoadServiceProviders::class,
    ];
}
