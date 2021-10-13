<?php

use Boot\Foundation\AppFactoryBridge;
use DI\Container;
use App\Http\HttpKernel;
use Slim\Exception\HttpNotFoundException;

$app = AppFactoryBridge::create(new Container);

$http_kernel = new HttpKernel($app);

$app->bind(HttpKernel::class, $http_kernel);

$_SERVER['app'] = &$app;

if (!function_exists('app'))
{
    function app()
    {
        return $_SERVER['app'];
    }
}

$app->addRoutingMiddleware();

return $app;
