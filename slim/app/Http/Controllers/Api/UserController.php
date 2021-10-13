<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class UserController
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index($response)
    {
        $data = array('name' => 'Bob', 'age' => 40);
        $payload = json_encode($this->userRepository->all());

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
