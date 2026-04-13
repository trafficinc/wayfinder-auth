<?php
/**
 * @var \Wayfinder\View\FormState $form
 * @var array<string, mixed>|null $user
 * @var string|null $status
 * @var array<string, mixed> $summary
 * @var int $projectCount
 * @var list<array<string, mixed>> $recentTasks
 */
ob_start();
?>
<main>
    <div class="card" style="max-width:760px;margin:0 auto 24px;">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:16px;">
            <div>
                <h1>Dashboard</h1>
                <p class="subtitle">Welcome back. Keep your task list moving.</p>
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

    <div class="card" style="max-width:760px;margin:0 auto 24px;">
        <div style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:16px;">
            <div style="padding:18px;border:1px solid var(--line);border-radius:14px;background:#f7fbf8;">
                <div style="color:var(--muted);font-size:.9rem;">Total tasks</div>
                <div style="font-size:2rem;font-weight:700;"><?= (int) ($summary['total'] ?? 0) ?></div>
            </div>
            <div style="padding:18px;border:1px solid var(--line);border-radius:14px;background:#f7fbf8;">
                <div style="color:var(--muted);font-size:.9rem;">Open</div>
                <div style="font-size:2rem;font-weight:700;"><?= (int) ($summary['open'] ?? 0) ?></div>
            </div>
            <div style="padding:18px;border:1px solid var(--line);border-radius:14px;background:#f7fbf8;">
                <div style="color:var(--muted);font-size:.9rem;">Completed</div>
                <div style="font-size:2rem;font-weight:700;"><?= (int) ($summary['completed'] ?? 0) ?></div>
            </div>
            <div style="padding:18px;border:1px solid var(--line);border-radius:14px;background:#fff6f0;">
                <div style="color:var(--muted);font-size:.9rem;">Overdue</div>
                <div style="font-size:2rem;font-weight:700;"><?= (int) ($summary['overdue'] ?? 0) ?></div>
            </div>
            <div style="padding:18px;border:1px solid var(--line);border-radius:14px;background:#f7fbf8;">
                <div style="color:var(--muted);font-size:.9rem;">Projects</div>
                <div style="font-size:2rem;font-weight:700;"><?= $projectCount ?></div>
            </div>
        </div>

        <div class="links">
            <a href="/tasks">Open task board</a>
            <a href="/projects">Manage projects</a>
        </div>
    </div>

    <div class="card" style="max-width:760px;margin:0 auto;">
        <h2 style="margin:0 0 16px;">Recent tasks</h2>
        <?php if ($recentTasks === []): ?>
            <p class="subtitle" style="margin:0;">No tasks yet. Start with your first one.</p>
        <?php else: ?>
            <ul style="list-style:none;padding:0;margin:0;display:grid;gap:12px;">
                <?php foreach ($recentTasks as $task): ?>
                    <li style="display:flex;justify-content:space-between;gap:16px;padding:12px 0;border-bottom:1px solid var(--line);">
                        <div>
                            <span><?= htmlspecialchars((string) ($task['title'] ?? ''), ENT_QUOTES, 'UTF-8') ?></span>
                            <?php if (is_string($task['project_name'] ?? null) && $task['project_name'] !== ''): ?>
                                <div style="color:var(--muted);font-size:.9rem;"><?= htmlspecialchars((string) $task['project_name'], ENT_QUOTES, 'UTF-8') ?></div>
                            <?php endif; ?>
                            <?php if (is_string($task['due_date'] ?? null) && $task['due_date'] !== ''): ?>
                                <div style="color:var(--muted);font-size:.9rem;">Due <?= htmlspecialchars((string) $task['due_date'], ENT_QUOTES, 'UTF-8') ?></div>
                            <?php endif; ?>
                        </div>
                        <strong style="color:<?= (int) ($task['is_complete'] ?? 0) === 1 ? 'var(--accent)' : 'var(--muted)' ?>;">
                            <?= (int) ($task['is_complete'] ?? 0) === 1 ? 'Done' : 'Open' ?>
                        </strong>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</main>
<?php
$bodyContent = ob_get_clean();
$title = 'Dashboard';
include __DIR__ . '/_layout.php';
