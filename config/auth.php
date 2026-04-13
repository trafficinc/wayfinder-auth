<?php

declare(strict_types=1);

return [
    'css_framework' => $_ENV['AUTH_CSS_FRAMEWORK'] ?? 'custom',
    'home_route' => $_ENV['AUTH_HOME_ROUTE'] ?? '/dashboard',
    'password_reset_ttl' => (int) ($_ENV['AUTH_RESET_TTL'] ?? 3600),
    'verify_email_ttl' => (int) ($_ENV['AUTH_VERIFY_TTL'] ?? 86400),
];
