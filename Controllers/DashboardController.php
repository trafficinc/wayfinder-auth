<?php

declare(strict_types=1);

namespace Modules\Auth\Controllers;

use Wayfinder\Auth\AuthManager;
use Wayfinder\Database\Database;
use Wayfinder\Http\CsrfTokenManager;
use Wayfinder\Http\Request;
use Wayfinder\Http\Response;
use Wayfinder\Support\Config;
use Wayfinder\View\View;

final class DashboardController
{
    public function __construct(
        private readonly View $view,
        private readonly CsrfTokenManager $csrf,
        private readonly AuthManager $auth,
        private readonly Database $db,
        private readonly Config $config,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $user = $this->auth->user();
        $userId = (int) ($user['id'] ?? 0);
        $summary = $this->db->firstResult(
            'SELECT
                COUNT(*) AS total,
                SUM(CASE WHEN is_complete = 1 THEN 1 ELSE 0 END) AS completed,
                SUM(CASE WHEN is_complete = 0 THEN 1 ELSE 0 END) AS open,
                SUM(CASE WHEN is_complete = 0 AND due_date IS NOT NULL AND due_date <> ? AND due_date < ? THEN 1 ELSE 0 END) AS overdue
             FROM tasks
             WHERE user_id = ?',
            ['', date('Y-m-d'), $userId],
        );
        $projectCount = $this->db->firstResult(
            'SELECT COUNT(*) AS total FROM projects WHERE user_id = ?',
            [$userId],
        );
        $recentTasks = $this->db->query(
            'SELECT t.id, t.title, t.is_complete, t.due_date, p.name AS project_name
             FROM tasks t
             LEFT JOIN projects p ON p.id = t.project_id
             WHERE t.user_id = ? ORDER BY t.id DESC LIMIT 5',
            [$userId],
        );

        return $this->view->response('auth::dashboard', [
            'request' => $request,
            'csrfToken' => $this->csrf->token($request->session()),
            'cssFramework' => (string) $this->config->get('auth.css_framework', 'custom'),
            'status' => $request->session()->pull('status'),
            'user' => $user,
            'summary' => is_array($summary) ? $summary : ['total' => 0, 'completed' => 0],
            'projectCount' => is_array($projectCount) ? (int) ($projectCount['total'] ?? 0) : 0,
            'recentTasks' => is_array($recentTasks) ? $recentTasks : [],
        ]);
    }
}
