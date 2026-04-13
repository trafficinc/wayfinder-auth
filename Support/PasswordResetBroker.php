<?php

declare(strict_types=1);

namespace Modules\Auth\Support;

use Wayfinder\Database\Database;

final class PasswordResetBroker
{
    public function __construct(
        private readonly Database $db,
        private readonly int $ttl = 3600,
    ) {
    }
}
