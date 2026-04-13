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
            --bg: #f4f7f5;
            --card: #ffffff;
            --ink: #183028;
            --muted: #5a6f67;
            --accent: #2f7d5c;
            --line: #d6e4dc;
            --danger: #9b2c2c;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            background:
                radial-gradient(circle at top right, rgba(47, 125, 92, 0.10), transparent 25%),
                linear-gradient(180deg, #f8fbf9 0%, var(--bg) 100%);
            color: var(--ink);
        }
        main {
            max-width: 560px;
            margin: 80px auto;
            padding: 24px;
        }
        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 32px;
            box-shadow: 0 18px 50px rgba(24, 48, 40, 0.08);
        }
        h1 { margin: 0 0 10px; font-size: 2rem; }
        .subtitle { margin: 0 0 24px; color: var(--muted); }
        .form-group { margin-bottom: 16px; }
        label { display: block; margin-bottom: 6px; font-weight: 700; color: var(--accent); }
        input { width: 100%; padding: 12px 14px; border: 1px solid var(--line); border-radius: 12px; font: inherit; }
        button { padding: 12px 18px; border: 0; border-radius: 12px; background: var(--accent); color: #fff; font: inherit; cursor: pointer; }
        .flash { margin-bottom: 16px; padding: 12px 14px; border-radius: 12px; background: #edf9f3; border: 1px solid #b7dfc9; color: #16543b; }
        .error { margin-top: 6px; color: var(--danger); font-size: .9rem; }
        .links { margin-top: 18px; display: flex; gap: 14px; }
        .links a { color: var(--accent); text-decoration: none; }
        .links a:hover { text-decoration: underline; }
        dl { display: grid; grid-template-columns: auto 1fr; gap: 12px 16px; margin: 20px 0 0; }
        dt { font-weight: 700; color: var(--accent); }
        dd { margin: 0; }
    </style>
</head>
<body>
<?php echo $bodyContent; ?>
</body>
</html>
