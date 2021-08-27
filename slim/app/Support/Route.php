<?php

namespace App\Support;

use Slim\App;

class Route
{
    protected static App $app;

    public static function setup(App &$app): App
    {
        self::$app = $app;

        return $app;
    }

    public static function __callStatic($verb, $parameters)
    {
        $app = self::$app;

        [$route, $action] = $parameters;

        self::validation($route, $verb, $action);

        return $app->$verb($route, $action);
    }

    protected static function validation($route, $verb, $action)
    {
        $exception = "Unresolvable Route Callback/Controller action";
        $context = json_encode(compact('route', 'action', 'verb'));
        $fails = !((is_callable($action)) or is_string($action) or (is_array($action) and count($action) == 2));

        throw_when($fails, $exception . $context);
    }
}