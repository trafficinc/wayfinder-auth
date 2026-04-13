<?php

declare(strict_types=1);

namespace Modules\Auth\Controllers;

use Modules\Auth\Requests\RegisterRequest;
use Wayfinder\Auth\AuthManager;
use Wayfinder\Database\Database;
use Wayfinder\Http\CsrfTokenManager;
use Wayfinder\Http\Request;
use Wayfinder\Http\Response;
use Wayfinder\Support\Config;
use Wayfinder\View\View;

final class RegisterController
{
    public function __construct(
        private readonly View $view,
        private readonly CsrfTokenManager $csrf,
        private readonly AuthManager $auth,
        private readonly Database $db,
        private readonly Config $config,
    ) {
    }

    public function show(Request $request): Response
    {
        return $this->view->response('auth::register', [
            'request' => $request,
            'csrfToken' => $this->csrf->token($request->session()),
            'cssFramework' => (string) $this->config->get('auth.css_framework', 'custom'),
        ]);
    }

    public function store(RegisterRequest $request): Response
    {
        $data = $request->validated();

        $this->db->statement(
            'INSERT INTO users (name, email, password, is_admin) VALUES (?, ?, ?, 0)',
            [$data['name'], $data['email'], password_hash($data['password'], PASSWORD_BCRYPT)],
        );

        $this->auth->login((int) $this->db->lastInsertId());

        return Response::redirect((string) $this->config->get('auth.home_route', '/dashboard'))
            ->withFlash($request->session(), 'status', 'Account created.');
    }
}
