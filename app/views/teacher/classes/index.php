<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage Classes</title>
  <style>
    body { font-family: Arial, sans-serif; background:#0b0b0b; color:#eee; margin:0; }
    .wrap { max-width: 1000px; margin: 0 auto; padding: 24px; }
    .top { display:flex; justify-content:space-between; align-items:center; gap:12px; }
    .card { background:#151515; border:1px solid #2a2a2a; border-radius:14px; padding:16px; margin-top:16px; }
    a.btn, button.btn { display:inline-block; padding:10px 12px; border-radius:10px; border:1px solid #2a2a2a; background:#101010; color:#eee; text-decoration:none; cursor:pointer; }
    a.btn:hover, button.btn:hover { border-color:#444; }
    .flash { background:#113015; border:1px solid #1f6a2b; padding:10px; border-radius:10px; margin-top:14px; }
    table { width:100%; border-collapse:collapse; margin-top:10px; }
    th, td { padding:10px; border-bottom:1px solid #2a2a2a; text-align:left; }
    .muted { opacity:.75; }
  </style>
</head>
<body>
  <div class="wrap">
    <div class="top">
      <div>
        <h1 style="margin:0;">Classes</h1>
        <div class="muted">Teacher: <?= htmlspecialchars($user['name'] ?? '') ?></div>
      </div>

      <div style="display:flex; gap:10px; align-items:center;">
        <a class="btn" href="<?= BASE_URL ?>/teacher/dashboard">Back</a>
        <a class="btn" href="<?= BASE_URL ?>/teacher/classes/create">+ Create Class</a>
        <form method="POST" action="<?= BASE_URL ?>/logout" style="margin:0;">
          <button class="btn" type="submit">Logout</button>
        </form>
      </div>
    </div>

    <?php if (!empty($flash)): ?>
      <div class="flash"><?= htmlspecialchars($flash) ?></div>
    <?php endif; ?>

    <div class="card">
      <?php if (empty($classes)): ?>
        <div class="muted">No classes yet. Create your first one.</div>
      <?php else: ?>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Created</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($classes as $c): ?>
              <tr>
                <td><?= (int)$c['id'] ?></td>
                <td><?= htmlspecialchars($c['name']) ?></td>
                <td class="muted"><?= htmlspecialchars($c['created_at']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
