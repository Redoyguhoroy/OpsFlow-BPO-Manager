<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../config/auth.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email=? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($res);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["name"] = $user["name"];
        $_SESSION["role"] = $user["role"];
        header("Location: /bpo_system/dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | BPO System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
  min-height: 100vh;
  background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto;
}

.login-card {
  background: #ffffff;
  width: 100%;
  max-width: 420px;
  border-radius: 14px;
  padding: 32px;
  box-shadow: 0 20px 40px rgba(0,0,0,.25);
}

.login-card h1 {
  font-size: 26px;
  font-weight: 700;
  margin-bottom: 5px;
}

.login-card p {
  color: #6c757d;
  margin-bottom: 25px;
}

.form-control {
  height: 48px;
  border-radius: 10px;
}

.btn-login {
  height: 48px;
  border-radius: 10px;
  font-weight: 600;
}

.brand {
  text-align: center;
  margin-bottom: 20px;
  color: #ffffff;
}

.brand h2 {
  font-weight: 700;
}

.brand span {
  opacity: .8;
}

.demo {
  text-align: center;
  font-size: 13px;
  color: #6c757d;
  margin-top: 15px;
}
</style>
</head>

<body>

<div>
  <div class="brand mb-4">
    <h2>BPO System</h2>
    <span>Operations Dashboard</span>
  </div>

  <div class="login-card">
    <h1>Sign in</h1>
    <p>Use your admin credentials</p>

    <?php if ($error): ?>
      <div class="alert alert-danger py-2"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="admin@bpo.com" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
      </div>

      <button class="btn btn-primary w-100 btn-login" type="submit">
        Login
      </button>
    </form>

    <div class="demo">
      Demo: <b>admin@bpo.com</b> / <b>admin123</b>
    </div>
  </div>
</div>

</body>
</html>
