<?php

use App\Support\Route;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/{name}', [WelcomeController::class, 'name']);
