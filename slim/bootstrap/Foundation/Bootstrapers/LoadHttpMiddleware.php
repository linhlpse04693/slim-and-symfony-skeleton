<?php

namespace Boot\Foundation\Bootstrapers;

use Boot\Foundation\Kernel;

class LoadHttpMiddleware extends Bootstraper
{
    public function boot()
    {
        $container = $this->app->getContainer();

        $kernel = $container->get(Kernel::class);

        $this->app->addErrorMiddleware(
            config('middleware.error.displayErrorDetails'),
            config('middleware.error.logErrors'),
            config('middleware.error.logErrorDetails'),
        );

        $container->set('middleware', function () use ($kernel) {
            return [
                'global' => $kernel->middleware,
                'api' => $kernel->middlewareGroups['api'],
            ];
        });
    }
}