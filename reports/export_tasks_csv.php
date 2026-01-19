<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../config/auth.php";
require_login();

// Force download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="tasks_report.csv"');
header('Pragma: no-cache');
header('Expires: 0');

$output = fopen('php://output', 'w');

// CSV header
fputcsv($output, ['Task ID','Client','Title','Assigned To','Status','Due Date','Created At']);

$sql = "SELECT t.id, c.company_name, t.title, u.name AS staff, t.status, t.due_date, t.created_at
        FROM tasks t
        JOIN clients c ON t.client_id = c.id
        JOIN users u ON t.assigned_to = u.id
        ORDER BY t.id DESC";

$res = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($res)) {
    fputcsv($output, [
        $row['id'],
        $row['company_name'],
        $row['title'],
        $row['staff'],
        $row['status'],
        $row['due_date'],
        $row['created_at']
    ]);
}

fclose($output);
exit;
