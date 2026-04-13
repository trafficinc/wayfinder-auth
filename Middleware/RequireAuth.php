<?php

declare(strict_types=1);

namespace Modules\Auth\Middleware;

use Wayfinder\Auth\AuthManager;
use Wayfinder\Contracts\Middleware;
use Wayfinder\Http\Request;
use Wayfinder\Http\Response;

final class RequireAuth implements Middleware
{
    public function __construct(
        private readonly AuthManager $auth,
    ) {
    }

    public function handle(Request $request, callable $next): Response
    {
        if ($this->auth->guest()) {
            if ($request->hasSession()) {
                $request->session()->put('auth.intended', $request->path());
            }

            return Response::redirect('/login');
        }

        return $next($request);
    }
}
