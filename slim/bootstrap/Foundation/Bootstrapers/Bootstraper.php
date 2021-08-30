<?php

namespace Boot\Foundation\Bootstrapers;

use Slim\App;

class Bootstraper
{
    protected App $app;

    final public function __construct(App &$app)
    {
        $this->app = $app;
    }

    final public static function setup(App &$app, array $loaders)
    {
        $loaders = array_map(function ($loader) use ($app) {
            return new $loader($app);
        }, $loaders);

        array_walk($loaders, function (Bootstraper $bootstraper) {
            $bootstraper->boot();
        });
    }

    public function boot()
    {
        //
    }
}
