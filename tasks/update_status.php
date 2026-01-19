<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../config/auth.php";
require_login();

$id = (int)($_POST["id"] ?? 0);
$status = $_POST["status"] ?? "Pending";

$allowed = ["Pending","In Progress","Completed"];
if (!in_array($status, $allowed, true)) $status = "Pending";

$stmt = mysqli_prepare($conn, "UPDATE tasks SET status=? WHERE id=?");
mysqli_stmt_bind_param($stmt, "si", $status, $id);
mysqli_stmt_execute($stmt);

header("Location: index.php");
exit;
