<?php

namespace App\Exceptions;

use Slim\Exception\HttpException;
use Throwable;

class TokenNotfoundException extends HttpException
{
    protected $code = 401;
    protected $message = 'Not found.';
    protected $title = '404 Not Found';
    protected $description = 'The requested resource could not be found. Please verify the URI and try again.';
}