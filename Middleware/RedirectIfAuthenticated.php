<?php

declare(strict_types=1);

namespace Modules\Auth\Middleware;

use Wayfinder\Auth\AuthManager;
use Wayfinder\Contracts\Middleware;
use Wayfinder\Http\Request;
use Wayfinder\Http\Response;
use Wayfinder\Support\Config;

final class RedirectIfAuthenticated implements Middleware
{
    public function __construct(
        private readonly AuthManager $auth,
        private readonly Config $config,
    ) {
    }

    public function handle(Request $request, callable $next): Response
    {
        if ($this->auth->check()) {
            return Response::redirect((string) $this->config->get('auth.home_route', '/dashboard'));
        }

        return $next($request);
    }
}
