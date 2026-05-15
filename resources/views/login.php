<?php
/**
 * @var \Wayfinder\View\FormState $form
 * @var string|null $status
 */
ob_start();
?>
<div class="auth-shell">
    <section class="auth-grid">
        <aside class="brand-panel">
            <div>
                <span class="brand-mark">A</span>
                <div class="eyebrow">Stackmint Auth</div>
                <h1>Sign in to your workspace.</h1>
                <p class="brand-copy">A clean authentication module for Wayfinder applications, ready to connect to your app dashboard.</p>
            </div>
            <p class="muted">Keep authentication focused: login, registration, redirects, logout, and a safe signed-in entry point.</p>
        </aside>

        <div class="form-column">
            <div class="card form-card">
                <h2>Welcome back</h2>
                <p class="subtitle">Use your account email and password to continue.</p>

                <?php if (is_string($status) && $status !== ''): ?>
                    <div class="flash"><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>
                <?php if ($form->error('email', 'login')): ?>
                    <div class="error-summary">
                        <?= htmlspecialchars((string) $form->error('email', 'login'), ENT_QUOTES, 'UTF-8') ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="/login">
                    <?= $form->csrfField() ?>
                    <input type="hidden" name="_redirect" value="/login">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" value="<?= htmlspecialchars((string) $form->old('email', '', 'login'), ENT_QUOTES, 'UTF-8') ?>" autocomplete="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit">Sign in</button>
                        <a class="button button-secondary" href="/register">Create account</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?php
$bodyContent = ob_get_clean();
$title = 'Sign in';
include __DIR__ . '/_layout.php';
