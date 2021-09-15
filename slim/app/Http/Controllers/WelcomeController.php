<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserRepositoryInterface;
use Psr\Http\Message\ResponseInterface as Response;

class WelcomeController
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Response $response): Response
    {
        $response->getBody()->write('welcome???????????');

        return $response;
    }

    public function name(Response $response, $name): Response
    {
        $response->getBody()->write('welcome ' . $name);

        return $response;
    }
}