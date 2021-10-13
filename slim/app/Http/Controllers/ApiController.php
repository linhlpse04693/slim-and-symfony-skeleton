<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\Auth;

class ApiController
{
    public function index($response, User $user)
    {
        Auth::user();
        $response->getBody()->write(json_encode($user->get(), JSON_PRETTY_PRINT));

        return $response;
    }
}
