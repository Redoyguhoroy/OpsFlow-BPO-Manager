<?php
if (session_status() === PHP_SESSION_NONE) session_start();

function require_login() {
  if (!isset($_SESSION["user_id"])) {
    header("Location: /bpo_system/auth/login.php");
    exit;
  }
}

function is_admin() {
  return (isset($_SESSION["role"]) && $_SESSION["role"] === "admin");
}
?>
