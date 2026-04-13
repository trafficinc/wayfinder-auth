<?php

declare(strict_types=1);

namespace Modules\Auth\Controllers;

use Modules\Auth\Requests\LoginRequest;
use Wayfinder\Auth\AuthManager;
use Wayfinder\Database\DB;
use Wayfinder\Http\CsrfTokenManager;
use Wayfinder\Http\Request;
use Wayfinder\Http\Response;
use Wayfinder\Http\ValidationException;
use Wayfinder\Support\Config;
use Wayfinder\View\View;

final class LoginController
{
    public function __construct(
        private readonly View $view,
        private readonly CsrfTokenManager $csrf,
        private readonly AuthManager $auth,
        private readonly Config $config,
    ) {
    }

    public function show(Request $request): Response
    {
        return $this->view->response('auth::login', [
            'request' => $request,
            'csrfToken' => $this->csrf->token($request->session()),
            'cssFramework' => (string) $this->config->get('auth.css_framework', 'custom'),
            'status' => $request->session()->pull('status'),
        ]);
    }

    public function store(LoginRequest $request): Response
    {
        $data = $request->validated();
        $user = DB::table('users')->where('email', $data['email'])->first();

        if (
            ! is_array($user)
            || ! is_string($user['password'] ?? null)
            || ! password_verify($data['password'], $user['password'])
        ) {
            throw new ValidationException(
                ['email' => ['These credentials do not match our records.']],
                'Invalid credentials.',
                $request,
                'login',
            );
        }

        $this->auth->login((int) $user['id']);

        return Response::redirect((string) ($request->session()->pull('auth.intended')
            ?? $this->config->get('auth.home_route', '/dashboard')));
    }
}
