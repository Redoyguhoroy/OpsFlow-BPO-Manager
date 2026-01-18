<?php
require_once __DIR__ . "/config/db.php";

$newPass = "admin123";
$hash = password_hash($newPass, PASSWORD_DEFAULT);

$stmt = mysqli_prepare($conn, "UPDATE users SET password=? WHERE email='admin@bpo.com'");
mysqli_stmt_bind_param($stmt, "s", $hash);
mysqli_stmt_execute($stmt);

echo "Password reset done. New password: admin123";

