<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #0b0b0b;
      color: #eee;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card {
      width: 380px;
      background: #151515;
      border: 1px solid #2a2a2a;
      border-radius: 14px;
      padding: 24px;
    }

    h2 {
      margin-top: 0;
      margin-bottom: 16px;
    }

    label {
      display: block;
      margin-top: 12px;
      font-size: 14px;
      opacity: 0.9;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 6px;
      border-radius: 8px;
      border: 1px solid #333;
      background: #0f0f0f;
      color: #fff;
    }

    input:focus, select:focus {
      outline: none;
      border-color: #555;
    }

    button {
      width: 100%;
      margin-top: 18px;
      padding: 12px;
      border-radius: 10px;
      border: 1px solid #2a2a2a;
      background: #101010;
      color: #eee;
      cursor: pointer;
      font-size: 15px;
    }

    button:hover {
      border-color: #444;
      background: #141414;
    }

    .hint {
      margin-top: 14px;
      font-size: 12px;
      opacity: 0.7;
      text-align: center;
    }
  </style>
</head>

<body>

  <div class="card">
    <h2>Register Teacher</h2>

    <form method="POST" action="registerController.php">
      
      <label for="name">Name</label>
      <input type="text" id="name" name="name" required />

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required />

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required />

      <label for="role">Role</label>
      <select id="role" name="role">
        <option value="teacher">Teacher</option>
        <!-- <option value="student">Student</option> -->
      </select>

      <button type="submit">Register</button>
    </form>

    <div class="hint">
      Teacher accounts only
    </div>
  </div>

</body>
</html>
