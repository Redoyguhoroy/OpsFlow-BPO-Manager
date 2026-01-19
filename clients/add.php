<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../config/auth.php";
require_login();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $company = trim($_POST["company_name"]);
  $contact = trim($_POST["contact_person"]);
  $email = trim($_POST["email"]);
  $phone = trim($_POST["phone"]);

  $stmt = mysqli_prepare($conn, "INSERT INTO clients(company_name, contact_person, email, phone) VALUES (?,?,?,?)");
  mysqli_stmt_bind_param($stmt, "ssss", $company, $contact, $email, $phone);
  mysqli_stmt_execute($stmt);

  header("Location: index.php");
  exit;
}

include __DIR__ . "/../partials/header.php";
?>
<h3 class="mb-3">Add Client</h3>
<div class="card p-4 shadow-sm">
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Company Name</label>
      <input class="form-control" name="company_name" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Contact Person</label>
      <input class="form-control" name="contact_person">
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input class="form-control" name="email">
    </div>
    <div class="mb-3">
      <label class="form-label">Phone</label>
      <input class="form-control" name="phone">
    </div>
    <button class="btn btn-success">Save</button>
    <a class="btn btn-secondary" href="index.php">Back</a>
  </form>
</div>
<?php include __DIR__ . "/../partials/footer.php"; ?>
