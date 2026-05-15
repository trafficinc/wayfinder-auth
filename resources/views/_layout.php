<?php
/**
 * @var string $title
 * @var string $bodyContent
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
    <style>
        :root {
            --bg: #f6f8fb;
            --surface: #ffffff;
            --surface-soft: #f9fbfd;
            --ink: #1f2937;
            --muted: #64748b;
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-soft: #e8f0ff;
            --success: #0f766e;
            --success-soft: #e6f6f3;
            --danger: #b42318;
            --danger-soft: #fff1f0;
            --line: #dbe3ef;
            --shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-width: 320px;
            font-family: Inter, Roboto, "Helvetica Neue", Arial, sans-serif;
            color: var(--ink);
            background: var(--bg);
        }

        a { color: inherit; }

        main {
            width: min(100%, 1120px);
            margin: 0 auto;
            padding: 56px 24px;
        }

        .auth-shell {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .auth-grid {
            width: min(100%, 1040px);
            display: grid;
            grid-template-columns: minmax(0, 0.96fr) minmax(360px, 0.74fr);
            gap: 24px;
            align-items: stretch;
        }

        .brand-panel,
        .card {
            border: 1px solid var(--line);
            border-radius: 8px;
            background: var(--surface);
            box-shadow: var(--shadow);
        }

        .brand-panel {
            padding: 36px;
            display: grid;
            align-content: space-between;
            gap: 48px;
        }

        .brand-mark {
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: var(--primary);
            color: #fff;
            font-weight: 900;
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.24);
        }

        .eyebrow {
            width: fit-content;
            min-height: 32px;
            display: inline-flex;
            align-items: center;
            margin: 22px 0 18px;
            padding: 0 12px;
            border-radius: 8px;
            background: var(--primary-soft);
            color: var(--primary-dark);
            font-size: 0.84rem;
            font-weight: 900;
        }

        h1,
        h2,
        p {
            margin-top: 0;
            letter-spacing: 0;
        }

        h1 {
            margin-bottom: 10px;
            font-size: clamp(2rem, 5vw, 3.5rem);
            line-height: 1.04;
        }

        h2 {
            margin-bottom: 12px;
            font-size: 1.4rem;
            line-height: 1.3;
        }

        .subtitle,
        .brand-copy,
        .muted {
            color: var(--muted);
            line-height: 1.6;
        }

        .card {
            padding: 30px;
        }

        .form-card {
            align-self: center;
        }

        .form-column {
            width: 100%;
            display: grid;
            align-items: center;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: var(--ink);
            font-size: 0.9rem;
            font-weight: 800;
        }

        input {
            width: 100%;
            min-height: 46px;
            padding: 12px 14px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #fff;
            color: var(--ink);
            font: inherit;
            outline: none;
        }

        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        button,
        .button {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 18px;
            border-radius: 8px;
            border: 1px solid transparent;
            background: var(--primary);
            color: #fff;
            font: inherit;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 8px 16px rgba(37, 99, 235, 0.18);
        }

        button:hover,
        .button:hover {
            background: var(--primary-dark);
        }

        .button-secondary {
            border-color: var(--line);
            background: #fff;
            color: var(--primary-dark);
            box-shadow: none;
        }

        .button-secondary:hover {
            background: var(--primary-soft);
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
            margin-top: 20px;
        }

        .flash,
        .error-summary,
        .error {
            border-radius: 8px;
            font-weight: 700;
        }

        .flash,
        .error-summary {
            margin-bottom: 16px;
            padding: 12px 14px;
        }

        .flash {
            border: 1px solid #9fd7ce;
            background: var(--success-soft);
            color: var(--success);
        }

        .error-summary {
            border: 1px solid #f3b4ae;
            background: var(--danger-soft);
            color: var(--danger);
        }

        .error {
            margin-top: 7px;
            color: var(--danger);
            font-size: 0.88rem;
        }

        .links {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .links a {
            min-height: 36px;
            display: inline-flex;
            align-items: center;
            padding: 0 10px;
            border-radius: 8px;
            color: var(--primary-dark);
            font-weight: 800;
            text-decoration: none;
        }

        .links a:hover {
            background: var(--primary-soft);
        }

        .dashboard-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 22px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(280px, 0.7fr);
            gap: 18px;
        }

        dl {
            display: grid;
            gap: 10px;
            margin: 20px 0 0;
        }

        .data-row {
            display: grid;
            grid-template-columns: 96px minmax(0, 1fr);
            gap: 14px;
            padding: 14px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: var(--surface-soft);
        }

        dt {
            color: var(--muted);
            font-size: 0.78rem;
            font-weight: 900;
            text-transform: uppercase;
        }

        dd {
            margin: 0;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .scope-list {
            display: grid;
            gap: 10px;
            margin: 18px 0 0;
            padding: 0;
            list-style: none;
        }

        .scope-list li {
            padding: 12px 14px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: var(--surface-soft);
            color: var(--muted);
            line-height: 1.5;
        }

        @media (max-width: 860px) {
            .auth-grid,
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 620px) {
            main,
            .auth-shell {
                padding: 18px;
            }

            .brand-panel,
            .card {
                padding: 22px;
            }

            .dashboard-header {
                flex-direction: column;
            }

            .data-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<?php echo $bodyContent; ?>
</body>
</html>
