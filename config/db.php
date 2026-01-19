<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "bpo_system";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
  die("DB Connection Failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");
?>
