<?php

namespace App\Http\Middleware;

use Auth;
use Psr\Http\Server\RequestHandlerInterface as Handle;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpForbiddenException;
use Slim\Exception\HttpUnauthorizedException;

class Guest
{
    public function __invoke(Request $request, Handle $handler)
    {
        if (Auth::check()) {
            throw new HttpForbiddenException($request, 'route for guest');
        }

        return $handler->handle($request);
    }
}
