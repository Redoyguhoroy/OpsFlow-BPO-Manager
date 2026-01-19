<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../config/auth.php";
require_login();

$result = mysqli_query($conn, "SELECT * FROM clients ORDER BY id DESC");

include __DIR__ . "/../partials/header.php";
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Clients</h3>
  <a class="btn btn-primary" href="add.php">+ Add Client</a>
</div>

<div class="card p-3 shadow-sm">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th><th>Company</th><th>Contact</th><th>Email</th><th>Phone</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php while($c = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?php echo $c["id"]; ?></td>
        <td><?php echo htmlspecialchars($c["company_name"]); ?></td>
        <td><?php echo htmlspecialchars($c["contact_person"]); ?></td>
        <td><?php echo htmlspecialchars($c["email"]); ?></td>
        <td><?php echo htmlspecialchars($c["phone"]); ?></td>
        <td class="d-flex gap-2">
          <a class="btn btn-sm btn-warning" href="edit.php?id=<?php echo $c["id"]; ?>">Edit</a>
          <a class="btn btn-sm btn-danger" href="delete.php?id=<?php echo $c["id"]; ?>" onclick="return confirm('Delete client?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>
<?php include __DIR__ . "/../partials/footer.php"; ?>
