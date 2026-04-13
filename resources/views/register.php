<?php
/**
 * @var \Wayfinder\View\FormState $form
 */
ob_start();
?>
<main>
    <div class="card">
        <h1>Create account</h1>
        <p class="subtitle">Start using the task app.</p>

        <form method="post" action="/register">
            <?= $form->csrfField() ?>
            <input type="hidden" name="_redirect" value="/register">
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" value="<?= htmlspecialchars((string) $form->old('name', ''), ENT_QUOTES, 'UTF-8') ?>" required>
                <?php if ($form->error('name')): ?><div class="error"><?= htmlspecialchars((string) $form->error('name'), ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="<?= htmlspecialchars((string) $form->old('email', ''), ENT_QUOTES, 'UTF-8') ?>" required>
                <?php if ($form->error('email')): ?><div class="error"><?= htmlspecialchars((string) $form->error('email'), ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required>
                <?php if ($form->error('password')): ?><div class="error"><?= htmlspecialchars((string) $form->error('password'), ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required>
            </div>
            <button type="submit">Create account</button>
        </form>
    </div>
</main>
<?php
$bodyContent = ob_get_clean();
$title = 'Register';
include __DIR__ . '/_layout.php';
