<?php
session_start();
include 'db.php';
require 'functions.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch logs
$result = $conn->query("SELECT id, user_id, action, details, created_at FROM audit_logs ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Audit Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Audit Logs</h2>
    <a href="admin_dashboard.php" class="btn btn-secondary mb-3">Back</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>User ID</th><th>Action</th><th>Details</th><th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['user_id'] ?></td>
                <td><?= htmlspecialchars($row['action']) ?></td>
                <td><?= htmlspecialchars($row['details']) ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
