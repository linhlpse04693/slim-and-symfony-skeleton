<?php

namespace App\Providers;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->addErrorMiddleware(
            config('middleware.error.displayErrorDetails'),
            config('middleware.error.logErrors'),
            config('middleware.error.logErrorDetails'),
        );
    }

    public function boot()
    {
    }
}