<?php
/**
 * @var \Wayfinder\View\FormState $form
 * @var array<string, mixed>|null $user
 * @var string|null $status
 */
ob_start();
?>
<main>
    <div class="card" style="max-width:760px;margin:0 auto 24px;">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:16px;">
            <div>
                <h1>Dashboard</h1>
                <p class="subtitle">Welcome back. You are signed in and your auth module is working.</p>
            </div>
            <form method="post" action="/logout" style="margin:0;">
                <?= $form->csrfField() ?>
                <button type="submit">Log out</button>
            </form>
        </div>

        <?php if (is_string($status) && $status !== ''): ?>
            <div class="flash"><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <dl>
            <dt>Name</dt>
            <dd><?= htmlspecialchars((string) ($user['name'] ?? 'Unknown'), ENT_QUOTES, 'UTF-8') ?></dd>
            <dt>Email</dt>
            <dd><?= htmlspecialchars((string) ($user['email'] ?? ''), ENT_QUOTES, 'UTF-8') ?></dd>
        </dl>
    </div>

    <div class="card" style="max-width:760px;margin:0 auto;">
        <h2 style="margin:0 0 16px;">Module Scope</h2>
        <p class="subtitle" style="margin:0 0 12px;">
            This dashboard is intentionally generic. App-specific features like projects, tasks, billing, or reporting should live in your application or in separate feature modules.
        </p>
        <p class="subtitle" style="margin:0;">
            Keep `trafficinc/stackmint-auth` focused on authentication concerns: login, registration, guest/auth redirects, logout, and a simple signed-in landing page.
        </p>
    </div>
</main>
<?php
$bodyContent = ob_get_clean();
$title = 'Dashboard';
include __DIR__ . '/_layout.php';
