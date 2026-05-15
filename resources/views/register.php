<?php
/**
 * @var \Wayfinder\View\FormState $form
 */
ob_start();
?>
<div class="auth-shell">
    <section class="auth-grid">
        <aside class="brand-panel">
            <div>
                <span class="brand-mark">A</span>
                <div class="eyebrow">New workspace</div>
                <h1>Create your account.</h1>
                <p class="brand-copy">Start with a simple account and let the host application decide what happens after registration.</p>
            </div>
            <p class="muted">This module owns authentication only. Your application owns product workflows, billing, teams, and domain features.</p>
        </aside>

        <div class="form-column">
            <div class="card form-card">
                <h2>Account details</h2>
                <p class="subtitle">Enter the first user details for this application.</p>

                <form method="post" action="/register">
                    <?= $form->csrfField() ?>
                    <input type="hidden" name="_redirect" value="/register">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" name="name" type="text" value="<?= htmlspecialchars((string) $form->old('name', ''), ENT_QUOTES, 'UTF-8') ?>" autocomplete="name" required>
                        <?php if ($form->error('name')): ?><div class="error"><?= htmlspecialchars((string) $form->error('name'), ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" value="<?= htmlspecialchars((string) $form->old('email', ''), ENT_QUOTES, 'UTF-8') ?>" autocomplete="email" required>
                        <?php if ($form->error('email')): ?><div class="error"><?= htmlspecialchars((string) $form->error('email'), ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required>
                        <?php if ($form->error('password')): ?><div class="error"><?= htmlspecialchars((string) $form->error('password'), ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit">Create account</button>
                        <a class="button button-secondary" href="/login">Sign in</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?php
$bodyContent = ob_get_clean();
$title = 'Register';
include __DIR__ . '/_layout.php';
