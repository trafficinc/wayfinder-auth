<?php

declare(strict_types=1);

namespace Modules\Auth\Controllers;

use Wayfinder\Auth\AuthManager;
use Wayfinder\Http\Request;
use Wayfinder\Http\Response;

final class LogoutController
{
    public function __construct(
        private readonly AuthManager $auth,
    ) {
    }

    public function store(Request $request): Response
    {
        $this->auth->logout();

        return Response::redirect('/login')
            ->withFlash($request->session(), 'status', 'You have been logged out.');
    }
}
