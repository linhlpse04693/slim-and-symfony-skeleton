<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Support\Auth;

class AuthController
{
    public function login(LoginRequest $loginRequest, $response)
    {
        if ($loginRequest->failed()) {
            $response->getBody()->write(json_encode($loginRequest->validator()->errors()));;

            return $response
                ->withStatus(422)
                ->withHeader('Content-Type', 'application/json');
        }
        $token = Auth::attempt($loginRequest->email, $loginRequest->password);

        if (!$token) {
            $response->getBody()->write(json_encode('credential not match'));

            return $response
                ->withStatus(422)
                ->withHeader('Content-Type', 'application/json');
        }

        $payload = json_encode(['token' => $token,]);

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
