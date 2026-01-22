<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Work</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #0b0b0b;
            color: #eee;
            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .card {
            width: 460px;
            background: #151515;
            border: 1px solid #2a2a2a;
            border-radius: 14px;
            padding: 24px;
        }

        label {
            display: block;
            margin-top: 12px;
            opacity: .9;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 8px;
            border: 1px solid #333;
            background: #0f0f0f;
            color: #fff;
        }

        textarea {
            min-height: 90px;
            resize: vertical;
        }

        .row {
            display: flex;
            gap: 10px;
            margin-top: 16px;
        }

        a.btn,
        button.btn {
            flex: 1;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #2a2a2a;
            background: #101010;
            color: #eee;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
        }

        a.btn:hover,
        button.btn:hover {
            border-color: #444;
        }

        .err {
            background: #3b1212;
            border: 1px solid #7a2a2a;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .muted {
            opacity: .75;
            font-size: 12px;
            margin-top: 8px;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2 style="margin:0 0 8px;">Create Work</h2>

        <?php if (!empty($error)): ?>
            <div class="err"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (empty($classes)): ?>
            <div class="err">You must create a class first.</div>
            <a class="btn" href="<?= BASE_URL ?>/teacher/classes/create">Create Class</a>
        <?php else: ?>
            <form method="POST" action="<?= BASE_URL ?>/teacher/works/create" enctype="multipart/form-data">
                <label>Class</label>
                <select name="class_id" required>
                    <?php foreach ($classes as $c): ?>
                        <option value="<?= (int)$c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Title</label>
                <input type="text" name="title" required placeholder="e.g. Lesson 1 - MVC" />

                <label>Description (optional)</label>
                <textarea name="description" placeholder="Instructions..."></textarea>

                <label>File (optional)</label>
                <input type="file" name="file" />

                <div class="muted">Allowed: pdf, png, jpg, jpeg, doc, docx, txt</div>

                <div class="row">
                    <a class="btn" href="<?= BASE_URL ?>/teacher/works">Cancel</a>
                    <button class="btn" type="submit">Create</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>