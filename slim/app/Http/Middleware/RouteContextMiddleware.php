<?php

namespace App\Http\Middleware;

use App\Support\FormRequest;
use App\Support\Redirect;
use App\Support\RequestInput;
use Psr\Http\Message\ResponseInterface;
use Slim\Routing\RouteContext;
use Slim\Psr7\Factory\ResponseFactory;
use Psr\Http\Server\RequestHandlerInterface as Handle;
use Psr\Http\Message\ServerRequestInterface as Request;

class RouteContextMiddleware
{
    public function __invoke(Request $request, Handle $handler): ResponseInterface
    {
        $route = RouteContext::fromRequest($request)->getRoute();

        throw_when(empty($route), "Route not found in request");

        app()->bind(Redirect::class, fn(ResponseFactory $factory) => new Redirect($factory));

        $input = new RequestInput($request, $route);

        app()->bind(RequestInput::class, $input);

        app()->bind(Request::class, $request);

        $kernel = app()->resolve(\App\Http\HttpKernel::class);

        collect($kernel->requests)->each(
            function ($form) use ($request, $route) {
                app()->bind($form, function (ResponseFactory $factory) use ($form, $request, $route): FormRequest {
                    $input = new $form($request, $route, $factory);

                    $input->validate();

                    return $input;
                });
            }
        );

        return $handler->handle($request);
    }
}
