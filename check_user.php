<?php
require_once __DIR__ . "/config/db.php";

$email = "admin@bpo.com";

$stmt = mysqli_prepare($conn, "SELECT id, name, email, password, role FROM users WHERE email=? LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($res);

echo "<pre>";
var_dump($user);
echo "</pre>";
