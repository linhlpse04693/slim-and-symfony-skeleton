<?php

namespace App\Support;

use Slim\App;
use Slim\Interfaces\RouteGroupInterface;
use Slim\Interfaces\RouteInterface;
use Slim\Routing\RouteCollectorProxy;

class Route
{
    /**
     * @var App|RouteCollectorProxy
     */
    protected static $app;

    /**
     * @var App|RouteCollectorProxy
     */
    protected $group;

    protected RouteGroupInterface $routeGroup;

    public static function setup(&$app)
    {
        self::$app = $app;

        return $app;
    }

    protected static function validation(string &$route, string $verb, $action)
    {
        $exception = "Unresolvable Route Callback/Controller action";
        $context = json_encode(compact('route', 'action', 'verb'));
        $fails = !((is_callable($action)) || is_string($action) || (is_array($action) && count($action) == 2));
        $route = preg_replace('/^(.*)\/$/i', '$1', $route);

        throw_when($fails, $exception . $context);
    }

    public static function get(string $route, $action): RouteInterface
    {
        self::validation($route, 'get', $action);

        return self::$app->get($route, $action);
    }

    public static function post(string $route, $action): RouteInterface
    {
        self::validation($route, 'post', $action);

        return self::$app->post($route, $action);
    }

    public static function put(string $route, $action): RouteInterface
    {
        self::validation($route, 'put', $action);

        return self::$app->put($route, $action);
    }

    public static function patch(string $route, $action): RouteInterface
    {
        self::validation($route, 'patch', $action);

        return self::$app->patch($route, $action);
    }

    public static function delete(string $route, $action): RouteInterface
    {
        self::validation($route, 'delete', $action);

        return self::$app->delete($route, $action);
    }

    public static function group(string $path, $action): Route
    {
        $outerGroup = self::$app;
        $router = new static();
        $router->routeGroup = self::$app->group($path, function (RouteCollectorProxy $group) use ($action, $router, $path) {
            $router->setGroup($group);
            Route::setup($group);

            $action($group);
        });

        Route::setup($outerGroup);

        return $router;
    }

    public function setGroup(RouteCollectorProxy $group)
    {
        $this->group = $group;
    }

    public function middleware(array $middlewares)
    {
        array_walk($middlewares, function ($middleware) {
            $this->routeGroup->add(new $middleware);
        });
    }
}