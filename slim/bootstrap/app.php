<?php

use App\Providers\ServiceProvider;
use DI\Container;
use DI\Bridge\Slim\Bridge as SlimFactory;

$container = new Container();

$app = SlimFactory::create($container);

ServiceProvider::setup($app, config('app.providers'));

return $app;
