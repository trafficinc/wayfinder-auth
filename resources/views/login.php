<?php
/**
 * @var \Wayfinder\View\FormState $form
 * @var string|null $status
 */
ob_start();
?>
<main>
    <div class="card">
        <h1>Sign in</h1>
        <p class="subtitle">Log in to manage your tasks.</p>

        <?php if (is_string($status) && $status !== ''): ?>
            <div class="flash"><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
        <?php if ($form->error('email', 'login')): ?>
            <div class="flash" style="background:#fff2f2;border-color:#e7b9b9;color:#8f2d2d;">
                <?= htmlspecialchars((string) $form->error('email', 'login'), ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form method="post" action="/login">
            <?= $form->csrfField() ?>
            <input type="hidden" name="_redirect" value="/login">
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="<?= htmlspecialchars((string) $form->old('email', '', 'login'), ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required>
            </div>
            <button type="submit">Sign in</button>
        </form>

        <div class="links">
            <a href="/register">Create account</a>
        </div>
    </div>
</main>
<?php
$bodyContent = ob_get_clean();
$title = 'Sign in';
include __DIR__ . '/_layout.php';
