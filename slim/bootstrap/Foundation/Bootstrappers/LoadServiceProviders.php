<?php

namespace Boot\Foundation\Bootstrappers;

use App\Providers\RouteServiceProvider;
use App\Providers\ServiceProvider;

class LoadServiceProviders extends Bootstrapper
{
    public function boot()
    {
        $app = $this->app;
        $providers = config('app.providers');
        $providers = [...$providers, RouteServiceProvider::class];

        ServiceProvider::setup($app, $providers);
    }
}
