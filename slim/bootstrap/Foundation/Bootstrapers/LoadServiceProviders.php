<?php

namespace Boot\Foundation\Bootstrapers;

use App\Providers\ServiceProvider;

class LoadServiceProviders extends Bootstraper
{
    public function boot()
    {
        ServiceProvider::setup($this->app, config('app.providers'));
    }
}