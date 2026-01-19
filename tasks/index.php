<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../config/auth.php";
require_login();

$sql = "SELECT t.*, c.company_name, u.name AS staff_name
        FROM tasks t
        JOIN clients c ON t.client_id=c.id
        JOIN users u ON t.assigned_to=u.id
        ORDER BY t.id DESC";
$result = mysqli_query($conn, $sql);

include __DIR__ . "/../partials/header.php";
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Tasks</h3>
  <a class="btn btn-primary" href="add.php">+ Add Task</a>
</div>

<div class="card p-3 shadow-sm">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th><th>Client</th><th>Title</th><th>Assigned</th><th>Status</th><th>Due</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php while($t = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?php echo $t["id"]; ?></td>
        <td><?php echo htmlspecialchars($t["company_name"]); ?></td>
        <td><?php echo htmlspecialchars($t["title"]); ?></td>
        <td><?php echo htmlspecialchars($t["staff_name"]); ?></td>
        <td>
          <form method="POST" action="update_status.php" class="d-flex gap-2">
            <input type="hidden" name="id" value="<?php echo $t["id"]; ?>">
            <select name="status" class="form-select form-select-sm">
              <?php foreach(["Pending","In Progress","Completed"] as $s): ?>
                <option value="<?php echo $s; ?>" <?php echo ($t["status"]===$s)?"selected":""; ?>>
                  <?php echo $s; ?>
                </option>
              <?php endforeach; ?>
            </select>
            <button class="btn btn-sm btn-outline-primary">Save</button>
          </form>
        </td>
        <td><?php echo htmlspecialchars($t["due_date"]); ?></td>
        <td class="d-flex gap-2">
          <a class="btn btn-sm btn-warning" href="edit.php?id=<?php echo $t["id"]; ?>">Edit</a>
          <a class="btn btn-sm btn-danger" href="delete.php?id=<?php echo $t["id"]; ?>" onclick="return confirm('Delete task?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . "/../partials/footer.php"; ?>
