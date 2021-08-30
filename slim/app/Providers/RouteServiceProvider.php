<?php

namespace App\Providers;

use App\Support\Route;
use Slim\Routing\RouteCollectorProxy;

class RouteServiceProvider extends ServiceProvider
{
    protected function registerApiRoutes()
    {
        $middlewares = $this->app->getContainer()->get('middleware');
        Route::group('/api', function (RouteCollectorProxy $group) {
            require routes_path('api.php');
        })->middleware([
            ...$middlewares['global'],
            ...$middlewares['api'],
        ]);
    }

    public function register()
    {
        Route::setup($this->app);
    }

    public function boot()
    {
        $this->registerApiRoutes();
    }
}