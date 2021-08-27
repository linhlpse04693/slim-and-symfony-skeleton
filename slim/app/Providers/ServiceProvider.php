<?php

namespace App\Providers;

use Slim\App;

abstract class ServiceProvider
{
    protected App $app;

    final public function __construct(App &$app)
    {
        $this->app = $app;
    }

    abstract public function register();

    abstract public function boot();

    final static function setup(App &$app, array $providers)
    {
        $providers = array_map(function ($provider) use ($app) {
            return new $provider($app);
        }, $providers);

        array_walk($providers, function (ServiceProvider $provider) {
            $provider->register();
        });

        array_walk($providers, function (ServiceProvider $provider) {
            $provider->boot();
        });
    }
}