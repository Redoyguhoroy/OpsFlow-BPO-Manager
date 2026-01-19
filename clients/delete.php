<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../config/auth.php";
require_login();

$id = (int)($_GET["id"] ?? 0);
mysqli_query($conn, "DELETE FROM clients WHERE id=$id");
header("Location: index.php");
exit;
