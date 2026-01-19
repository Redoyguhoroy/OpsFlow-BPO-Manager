<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../config/auth.php";
require_login();

$id = (int)($_GET["id"] ?? 0);
$client = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM clients WHERE id=$id"));
if (!$client) { die("Client not found"); }

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $company = trim($_POST["company_name"]);
  $contact = trim($_POST["contact_person"]);
  $email = trim($_POST["email"]);
  $phone = trim($_POST["phone"]);

  $stmt = mysqli_prepare($conn, "UPDATE clients SET company_name=?, contact_person=?, email=?, phone=? WHERE id=?");
  mysqli_stmt_bind_param($stmt, "ssssi", $company, $contact, $email, $phone, $id);
  mysqli_stmt_execute($stmt);

  header("Location: index.php");
  exit;
}

include __DIR__ . "/../partials/header.php";
?>
<h3 class="mb-3">Edit Client</h3>
<div class="card p-4 shadow-sm">
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Company Name</label>
      <input class="form-control" name="company_name" value="<?php echo htmlspecialchars($client["company_name"]); ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Contact Person</label>
      <input class="form-control" name="contact_person" value="<?php echo htmlspecialchars($client["contact_person"]); ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input class="form-control" name="email" value="<?php echo htmlspecialchars($client["email"]); ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Phone</label>
      <input class="form-control" name="phone" value="<?php echo htmlspecialchars($client["phone"]); ?>">
    </div>
    <button class="btn btn-success">Update</button>
    <a class="btn btn-secondary" href="index.php">Back</a>
  </form>
</div>
<?php include __DIR__ . "/../partials/footer.php"; ?>
