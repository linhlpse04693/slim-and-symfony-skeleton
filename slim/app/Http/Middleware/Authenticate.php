<?php

namespace App\Http\Middleware;

use Auth;
use Psr\Http\Server\RequestHandlerInterface as Handle;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpUnauthorizedException;

class Authenticate
{
    public function __invoke(Request $request, Handle $handler)
    {
        if (!Auth::check()) {
            throw new HttpUnauthorizedException($request);
        }

        return $handler->handle($request);
    }
}
