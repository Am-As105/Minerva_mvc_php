<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Assign Work</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #0b0b0b;
            color: #eee;
            margin: 0;
        }

        .wrap {
            max-width: 900px;
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

        a.btn,
        button.btn {
            display: inline-block;
            padding: 10px 12px;
            border-radius: 10px;
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

        .flash {
            background: #113015;
            border: 1px solid #1f6a2b;
            padding: 10px;
            border-radius: 10px;
            margin-top: 14px;
        }

        .err {
            background: #3b1212;
            border: 1px solid #7a2a2a;
            padding: 10px;
            border-radius: 10px;
            margin-top: 14px;
        }

        .muted {
            opacity: .75;
        }

        .list {
            margin-top: 10px;
            display: grid;
            gap: 8px;
        }

        .item {
            display: flex;
            gap: 10px;
            align-items: center;
            border: 1px solid #2a2a2a;
            border-radius: 12px;
            padding: 10px;
            background: #0f0f0f;
        }

        .grow {
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="wrap">
        <div class="top">
            <div>
                <h1 style="margin:0;">Assign Work</h1>
                <div class="muted">
                    <strong><?= htmlspecialchars($work['title']) ?></strong> — Class: <?= htmlspecialchars($work['class_name']) ?>
                </div>
            </div>

            <div style="display:flex; gap:10px; align-items:center;">
                <a class="btn" href="<?= BASE_URL ?>/teacher/works">Back</a>
                <form method="POST" action="<?= BASE_URL ?>/logout" style="margin:0;">
                    <button class="btn" type="submit">Logout</button>
                </form>
            </div>
        </div>

        <?php if (!empty($flash)): ?><div class="flash"><?= htmlspecialchars($flash) ?></div><?php endif; ?>
        <?php if (!empty($error)): ?><div class="err"><?= htmlspecialchars($error) ?></div><?php endif; ?>

        <div class="card">
            <?php if (empty($students)): ?>
                <div class="muted">No students in this class yet. Assign students first.</div>
            <?php else: ?>
                <form method="POST" action="<?= BASE_URL ?>/teacher/works/assign">
                    <input type="hidden" name="work_id" value="<?= (int)$work['id'] ?>" />

                    <div style="margin-bottom:10px;">
                        <button class="btn" type="button" onclick="toggleAll(true)">Select all</button>
                        <button class="btn" type="button" onclick="toggleAll(false)">Unselect all</button>
                    </div>

                    <div class="list">
                        <?php foreach ($students as $s): ?>
                            <label class="item">
                                <input type="checkbox" name="student_ids[]" value="<?= (int)$s['id'] ?>" />
                                <div class="grow">
                                    <div><strong><?= htmlspecialchars($s['name']) ?></strong></div>
                                    <div class="muted"><?= htmlspecialchars($s['email']) ?></div>
                                </div>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <div style="margin-top:14px;">
                        <button class="btn" type="submit">Assign</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function toggleAll(state) {
            document.querySelectorAll('input[type="checkbox"][name="student_ids[]"]').forEach(cb => cb.checked = state);
        }
    </script>
</body>

</html>