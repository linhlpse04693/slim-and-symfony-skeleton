<?php

namespace App\Providers;

use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->bind(UserRepositoryInterface::class, function (UserRepository $userRepository) {
            return $userRepository;
        });
    }

    public function boot()
    {
        //
    }
}