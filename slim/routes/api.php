<?php

use App\Support\Route;
use App\Http\Controllers\WelcomeController;
use Slim\Routing\RouteCollectorProxy;

Route::group('/abc', function (RouteCollectorProxy $group) {
    Route::group('/def', function (RouteCollectorProxy $group) {
        Route::get('', [WelcomeController::class, 'index']);
    });
});

