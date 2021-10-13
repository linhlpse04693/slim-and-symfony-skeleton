<?php

namespace Boot\Foundation\Bootstrappers;

class LoadDebuggingPage extends Bootstrapper
{
    public function boot()
    {
        $this->app->addErrorMiddleware(
            config('middleware.error.displayErrorDetails'),
            config('middleware.error.logErrors'),
            config('middleware.error.logErrorDetails'),
        );
    }
}
