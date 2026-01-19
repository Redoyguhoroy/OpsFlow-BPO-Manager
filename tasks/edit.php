<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../config/auth.php";
require_login();

$id = (int)($_GET["id"] ?? 0);
$task = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tasks WHERE id=$id"));
if (!$task) die("Task not found");

$clients = mysqli_query($conn, "SELECT id, company_name FROM clients ORDER BY company_name");
$staff = mysqli_query($conn, "SELECT id, name FROM users ORDER BY name");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $client_id = (int)$_POST["client_id"];
  $assigned_to = (int)$_POST["assigned_to"];
  $title = trim($_POST["title"]);
  $description = trim($_POST["description"]);
  $due_date = $_POST["due_date"] ?: null;

  $stmt = mysqli_prepare($conn, "UPDATE tasks SET client_id=?, assigned_to=?, title=?, description=?, due_date=? WHERE id=?");
  mysqli_stmt_bind_param($stmt, "iisssi", $client_id, $assigned_to, $title, $description, $due_date, $id);
  mysqli_stmt_execute($stmt);

  header("Location: index.php");
  exit;
}

include __DIR__ . "/../partials/header.php";
?>
<h3 class="mb-3">Edit Task</h3>
<div class="card p-4 shadow-sm">
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Client</label>
      <select class="form-select" name="client_id" required>
        <?php while($c = mysqli_fetch_assoc($clients)): ?>
          <option value="<?php echo $c["id"]; ?>" <?php echo ($task["client_id"]==$c["id"])?"selected":""; ?>>
            <?php echo htmlspecialchars($c["company_name"]); ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Assign To</label>
      <select class="form-select" name="assigned_to" required>
        <?php while($u = mysqli_fetch_assoc($staff)): ?>
          <option value="<?php echo $u["id"]; ?>" <?php echo ($task["assigned_to"]==$u["id"])?"selected":""; ?>>
            <?php echo htmlspecialchars($u["name"]); ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Title</label>
      <input class="form-control" name="title" value="<?php echo htmlspecialchars($task["title"]); ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea class="form-control" name="description" rows="3"><?php echo htmlspecialchars($task["description"]); ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Due Date</label>
      <input class="form-control" type="date" name="due_date" value="<?php echo htmlspecialchars($task["due_date"]); ?>">
    </div>

    <button class="btn btn-success">Update</button>
    <a class="btn btn-secondary" href="index.php">Back</a>
  </form>
</div>
<?php include __DIR__ . "/../partials/footer.php"; ?>
