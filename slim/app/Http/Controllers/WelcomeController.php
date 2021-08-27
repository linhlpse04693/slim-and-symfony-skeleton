<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ResponseInterface as Response;

class WelcomeController
{
    public function index(Response $response): Response
    {
        $response->getBody()->write('welcome');

        return $response;
    }

    public function name(Response $response, $name): Response
    {
        $response->getBody()->write('welcome ' . $name);

        return $response;
    }
}