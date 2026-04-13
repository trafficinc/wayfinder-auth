<?php

declare(strict_types=1);

use Modules\Auth\Controllers\DashboardController;
use Modules\Auth\Controllers\LoginController;
use Modules\Auth\Controllers\LogoutController;
use Modules\Auth\Controllers\RegisterController;

$router->group([
    'middleware' => ['web', 'guest'],
], static function ($router): void {
    $router->get('/login', [LoginController::class, 'show'], 'auth.login');
    $router->post('/login', [LoginController::class, 'store']);
    $router->get('/register', [RegisterController::class, 'show'], 'auth.register');
    $router->post('/register', [RegisterController::class, 'store']);
});

$router->group([
    'middleware' => ['auth.web'],
], static function ($router): void {
    $router->get('/dashboard', DashboardController::class, 'auth.dashboard');
    $router->post('/logout', [LogoutController::class, 'store'], 'auth.logout');
});
