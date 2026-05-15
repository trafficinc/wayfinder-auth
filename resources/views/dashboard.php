<?php
/**
 * @var \Wayfinder\View\FormState $form
 * @var array<string, mixed>|null $user
 * @var string|null $status
 */
ob_start();
?>
<main>
    <section class="dashboard-grid">
        <article class="card">
            <div class="dashboard-header">
                <div>
                    <div class="eyebrow">Authenticated</div>
                    <h1>Dashboard</h1>
                    <p class="subtitle">You are signed in and the auth module is working.</p>
                </div>
                <form method="post" action="/logout">
                    <?= $form->csrfField() ?>
                    <button type="submit">Log out</button>
                </form>
            </div>

            <?php if (is_string($status) && $status !== ''): ?>
                <div class="flash"><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>

            <dl>
                <div class="data-row">
                    <dt>Name</dt>
                    <dd><?= htmlspecialchars((string) ($user['name'] ?? 'Unknown'), ENT_QUOTES, 'UTF-8') ?></dd>
                </div>
                <div class="data-row">
                    <dt>Email</dt>
                    <dd><?= htmlspecialchars((string) ($user['email'] ?? ''), ENT_QUOTES, 'UTF-8') ?></dd>
                </div>
            </dl>
        </article>

        <aside class="card">
            <h2>Module scope</h2>
            <p class="subtitle">This page stays intentionally generic so each host app can replace it with its own authenticated landing page.</p>
            <ul class="scope-list">
                <li>Login and registration views are package-owned.</li>
                <li>The host app controls the final authenticated route.</li>
                <li>Product-specific dashboards belong in the application or feature modules.</li>
            </ul>
        </aside>
    </section>
</main>
<?php
$bodyContent = ob_get_clean();
$title = 'Dashboard';
include __DIR__ . '/_layout.php';
