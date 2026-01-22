<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion</title>
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
            width: 360px;
            background: #151515;
            border: 1px solid #2a2a2a;
            padding: 22px;
            border-radius: 12px;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #333;
            background: #0f0f0f;
            color: #fff;
            margin-top: 8px;
        }

        button {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 0;
            margin-top: 14px;
            cursor: pointer;
        }

        .err {
            background: #3b1212;
            border: 1px solid #7a2a2a;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .hint {
            opacity: .75;
            font-size: 12px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Connexion</h2>

        <?php if (!empty($error)): ?>
            <div class="err"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>/login">

            <label>Email</label>
            <input type="email" name="email" required />

            <label>Mot de passe</label>
            <input type="password" name="password" required />

            <button type="submit">Se connecter</button>
        </form>

        <div class="hint">
            Test: teacher@school.com / password<br>
            Test: student@school.com / password
        </div>
    </div>
</body>
<p>BASE_URL = <?= htmlspecialchars(BASE_URL) ?></p>


</html>