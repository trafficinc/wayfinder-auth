<?php

declare(strict_types=1);

namespace Modules\Auth;

use Modules\Auth\Middleware\RedirectIfAuthenticated;
use Modules\Auth\Middleware\RequireAuth;
use Modules\Auth\Support\PasswordResetBroker;
use Wayfinder\Database\Database;
use Wayfinder\Module\Module;
use Wayfinder\Module\ServiceProvider;
use Wayfinder\Routing\Router;
use Wayfinder\Support\Config;
use Wayfinder\Support\Container;

final class ModuleServiceProvider extends ServiceProvider
{
    public function register(Container $container, Config $config, Module $module): void
    {
        $container->singleton(PasswordResetBroker::class, static fn (Container $c) => new PasswordResetBroker(
            $c->get(Database::class),
            (int) $config->get('auth.password_reset_ttl', 3600),
        ));
    }

    public function boot(Container $container, Router $router, Config $config, Module $module): void
    {
        $router->middlewareGroup('auth.web', ['web', RequireAuth::class, 'no-cache']);
        $router->aliasMiddleware('guest', RedirectIfAuthenticated::class);
    }
}
