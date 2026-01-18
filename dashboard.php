<?php
require_once __DIR__ . "/config/db.php";
require_once __DIR__ . "/config/auth.php";
require_login();

$clients = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM clients"))["c"];
$tasks = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM tasks"))["c"];
$pending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM tasks WHERE status='Pending'"))["c"];
$completed = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM tasks WHERE status='Completed'"))["c"];

include __DIR__ . "/partials/header.php";
?>

<div class="row g-3 mb-3">
  <div class="col-md-3">
    <div class="cardx metric">
      <div class="label">Total Clients</div>
      <div class="value"><?php echo $clients; ?></div>
      <div class="hint">Active client records</div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="cardx metric">
      <div class="label">Total Tasks</div>
      <div class="value"><?php echo $tasks; ?></div>
      <div class="hint">All task entries</div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="cardx metric">
      <div class="label">Pending</div>
      <div class="value"><?php echo $pending; ?></div>
      <div class="hint">Need attention</div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="cardx metric">
      <div class="label">Completed</div>
      <div class="value"><?php echo $completed; ?></div>
      <div class="hint">Delivered tasks</div>
    </div>
  </div>
</div>

<div class="row g-3">
  <div class="col-lg-7">
    <div class="cardx p-4">
      <h5 class="fw-bold mb-2">Quick Actions</h5>
      <div class="small-muted mb-3">Do common operations faster</div>

      <div class="d-flex flex-wrap gap-2">
        <a class="btn btn-dark" href="/bpo_system/clients/add.php">
          <i class="bi bi-plus-circle"></i> Add Client
        </a>
        <a class="btn btn-primary" href="/bpo_system/tasks/add.php">
          <i class="bi bi-plus-circle"></i> Add Task
        </a>
        <a class="btn btn-success" href="/bpo_system/tasks/index.php">
          <i class="bi bi-list-check"></i> View Tasks
        </a>
        <a class="btn btn-warning" href="/bpo_system/reports/export_tasks_csv.php" download="tasks_report.csv">
          <i class="bi bi-download"></i> Export CSV
        </a>
      </div>
    </div>
  </div>

  <div class="col-lg-5">
    <div class="cardx p-4">
      <h5 class="fw-bold mb-2">Tips</h5>
      <ul class="small-muted mb-0">
        <li>Add 2–3 clients and 5–10 tasks for demo.</li>
        <li>Update task statuses to show workflow.</li>
        <li>Export CSV to prove reporting feature.</li>
      </ul>
    </div>
  </div>
</div>

<?php include __DIR__ . "/partials/footer.php"; ?>
