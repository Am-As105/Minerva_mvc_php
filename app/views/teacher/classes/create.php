<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Class</title>
  <style>
    body { font-family: Arial, sans-serif; background:#0b0b0b; color:#eee; display:flex; min-height:100vh; align-items:center; justify-content:center; }
    .card { width:380px; background:#151515; border:1px solid #2a2a2a; border-radius:14px; padding:24px; }
    label { display:block; margin-top:12px; opacity:.9; }
    input { width:100%; padding:10px; margin-top:6px; border-radius:8px; border:1px solid #333; background:#0f0f0f; color:#fff; }
    .row { display:flex; gap:10px; margin-top:16px; }
    a.btn, button.btn { flex:1; padding:12px; border-radius:10px; border:1px solid #2a2a2a; background:#101010; color:#eee; text-decoration:none; text-align:center; cursor:pointer; }
    a.btn:hover, button.btn:hover { border-color:#444; }
    .err { background:#3b1212; border:1px solid #7a2a2a; padding:10px; border-radius:10px; margin-bottom:10px; }
  </style>
</head>
<body>
  <div class="card">
    <h2 style="margin:0 0 8px;">Create Class</h2>

    <?php if (!empty($error)): ?>
      <div class="err"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/teacher/classes/create">
      <label>Class name</label>
      <input type="text" name="name" placeholder="e.g. DWWM 2026" required />

      <div class="row">
        <a class="btn" href="<?= BASE_URL ?>/teacher/classes">Cancel</a>
        <button class="btn" type="submit">Create</button>
      </div>
    </form>
  </div>
</body>
</html>
