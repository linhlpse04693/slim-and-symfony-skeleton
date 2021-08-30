<?php

namespace App\Providers;

use Psr\Container\ContainerInterface;
use Slim\App;

abstract class ServiceProvider
{
    protected App $app;
    protected ContainerInterface $container;

    final public function __construct(App &$app)
    {
        $this->app = $app;
        $this->container = $app->getContainer();
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

    public function bind($key, callable $resolvable)
    {
        $this->container->set($key, $resolvable);
    }

    public function resolve($key)
    {
        return $this->container->get($key);
    }
}