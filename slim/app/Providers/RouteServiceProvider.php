<?php

namespace App\Providers;

use App\Support\Route;
use Slim\Routing\RouteCollectorProxy;
use App\Http\Middleware\HandleCors;

class RouteServiceProvider extends ServiceProvider
{
    protected function registerApiRoutes()
    {
        $middlewares = $this->app->getContainer()->get('middleware');
        $this->app->add(function ($request, $handler) {
            $response = $handler->handle($request);
            return $response
                ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        });

        Route::group('/api', function (RouteCollectorProxy $group) {
            require routes_path('api.php');
        })->middleware([
            ...$middlewares['global'],
            ...$middlewares['api'],
//             HandleCors::class,
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