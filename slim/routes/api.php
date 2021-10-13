<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ApiController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\Guest;
use App\Support\Route;
use Slim\Routing\RouteCollectorProxy;

Route::get('/example', [ApiController::class, 'index',]);

Route::group('/authtest', function (RouteCollectorProxy $group) {
    Route::get('/', [UserController::class, 'index']);
})->middleware(
    [Authenticate::class,]
);

Route::group('/auth', function (RouteCollectorProxy $group) {
    Route::post('/login', [AuthController::class, 'login']);
})->middleware(
    [Guest::class,]
);
