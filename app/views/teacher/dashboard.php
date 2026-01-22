<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #0b0b0b;
            color: #eee;
            margin: 0;
        }

        .wrap {
            max-width: 1000px;
            margin: 0 auto;
            padding: 24px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .card {
            background: #151515;
            border: 1px solid #2a2a2a;
            border-radius: 14px;
            padding: 16px;
            margin-top: 16px;
        }

        .muted {
            opacity: .75;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
            margin-top: 12px;
        }

        a.btn,
        button.btn {
            display: block;
            text-align: center;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #2a2a2a;
            background: #101010;
            color: #eee;
            text-decoration: none;
            cursor: pointer;
        }

        a.btn:hover,
        button.btn:hover {
            border-color: #444;
        }

        .row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .pill {
            font-size: 12px;
            border: 1px solid #333;
            border-radius: 999px;
            padding: 6px 10px;
            background: #0f0f0f;
        }
    </style>
</head>

<body>
    <div class="wrap">

        <div class="top">
            <div>
                <h1 style="margin:0;">Teacher Dashboard</h1>
                <div class="muted" style="margin-top:6px;">
                    Welcome, <strong><?= htmlspecialchars($user['name'] ?? 'Teacher') ?></strong>
                </div>
            </div>

            <form method="POST" action="<?= BASE_URL ?>/logout" style="margin:0;">
                <button class="btn" type="submit">Logout</button>
            </form>
        </div>

        <div class="card">
            <div class="row">
                <span class="pill">Role: <?= htmlspecialchars($user['role'] ?? 'teacher') ?></span>
                <span class="pill">Email: <?= htmlspecialchars($user['email'] ?? '') ?></span>
                <span class="pill">User ID: <?= htmlspecialchars((string)($user['id'] ?? '')) ?></span>
            </div>

            <p class="muted" style="margin:12px 0 0;">
                This is your control center. Use the shortcuts below.
            </p>

            <div class="grid">
                <a class="btn" href="<?= BASE_URL ?>/teacher/classes">Manage Classes</a>
                <a class="btn" href="<?= BASE_URL ?>/teacher/works">Works (Create/Assign)</a>
                <a class="btn" href="<?= BASE_URL ?>/teacher/attendance">Attendance</a>
                <a class="btn" href="<?= BASE_URL ?>/teacher/stats">Statistics</a>
                <a class="btn" href="<?= BASE_URL ?>/teacher/chat">Class Chat</a>
            </div>
        </div>

        <div class="card">
            <h3 style="margin:0 0 8px;">Quick status (placeholder)</h3>
            <div class="muted">
                Later we’ll replace this with:
                number of classes, pending submissions, attendance rate, average grades…
            </div>
        </div>

    </div>
</body>

</html>