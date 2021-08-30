<?php

namespace Boot\Foundation\Bootstrapers;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

class LoadEnv extends Bootstraper
{
    public function boot()
    {
        try {
            $env = Dotenv::createImmutable(base_path());

            $env->load();
        } catch (InvalidPathException $exception) {
        }
    }
}