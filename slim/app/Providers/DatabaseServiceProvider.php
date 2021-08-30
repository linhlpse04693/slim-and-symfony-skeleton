<?php

namespace App\Providers;

use DB;

class DatabaseServiceProvider extends ServiceProvider
{

    public function register()
    {
        $options = data_get(config('database.connections'), config('database.default'));

        $capsule = new DB;
        $capsule->addConnection($options);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $this->bind(DB::class, function () use ($capsule) {
            return $capsule;
        });
    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }
}