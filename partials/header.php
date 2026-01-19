<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$current = $_SERVER['REQUEST_URI'] ?? "";
function nav_active($needle, $current){
  return (strpos($current, $needle) !== false) ? "active" : "";
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BPO System</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- ✅ Bootstrap Icons (fix broken icons) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- App CSS -->
  <link href="/bpo_system/assets/style.css" rel="stylesheet">
</head>
<body>

<?php if (isset($_SESSION["user_id"])): ?>
<div class="app">

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="brand">
      <div class="logo">B</div>
      <div class="title">
        <b>BPO System</b>
        <span>Ops Dashboard</span>
      </div>
    </div>

    <nav class="side-nav">
      <a class="navlink <?php echo nav_active('dashboard.php', $current); ?>" href="/bpo_system/dashboard.php">
        <i class="bi bi-speedometer2"></i><span>Dashboard</span>
      </a>

      <a class="navlink <?php echo nav_active('/clients/', $current); ?>" href="/bpo_system/clients/index.php">
        <i class="bi bi-building"></i><span>Clients</span>
      </a>

      <a class="navlink <?php echo nav_active('/tasks/', $current); ?>" href="/bpo_system/tasks/index.php">
        <i class="bi bi-list-check"></i><span>Tasks</span>
      </a>

      <!-- Export CSV: open confirmation modal -->
      <button type="button" class="navlink navbtn"
              data-bs-toggle="modal" data-bs-target="#exportCsvModal">
        <i class="bi bi-download"></i><span>Export CSV</span>
      </button>
    </nav>

    <div class="sidebar-footer">
      <div class="who">
        <div class="muted">Logged in as</div>
        <div class="fw-bold"><?php echo htmlspecialchars($_SESSION["name"] ?? "User"); ?></div>
        <div class="chip"><?php echo htmlspecialchars($_SESSION["role"] ?? ""); ?></div>
      </div>
      <a class="btn btn-danger w-100 mt-3" href="/bpo_system/auth/logout.php">
        <i class="bi bi-box-arrow-right me-1"></i> Logout
      </a>
    </div>
  </aside>

  <!-- Main -->
  <main class="main">
    <div class="topbar">
      <div>
        <div class="top-title">Dashboard</div>
        <div class="top-sub">Manage clients, tasks, and reports</div>
      </div>

      <div class="top-actions">
        <div class="searchbox d-none d-md-flex">
          <i class="bi bi-search"></i>
          <input class="form-control" placeholder="Search (UI only)" disabled>
        </div>
      </div>
    </div>

    <!-- Export Modal -->
    <div class="modal fade" id="exportCsvModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Download Tasks CSV?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            This will export your current tasks list as a CSV file.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <a class="btn btn-warning"
               href="/bpo_system/reports/export_tasks_csv.php"
               download="tasks_report.csv">
              Yes, Download
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid p-0">
<?php else: ?>
  <div class="container my-4">
<?php endif; ?>
