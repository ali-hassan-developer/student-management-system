<?php
require 'db.php';
require 'functions.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// 🚀 Audit log
log_audit($conn, $_SESSION['user_id'], 'Admin', 'Dashboard Access', 'Admin opened dashboard', 'info');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">Admin Panel</a>
    <div class="d-flex">
      <span class="navbar-text me-3 text-white">
        Welcome, <?= htmlspecialchars($_SESSION['username']) ?>
      </span>
      <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
  </div>
</nav>

<!-- Main Content -->
<div class="container my-5">
    <h3 class="mb-4">Dashboard Controls</h3>
    <div class="row g-4">

        <!-- Manage Users -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Manage Users</h5>
                    <p class="card-text text-muted">Add, edit or remove users</p>
                    <a href="manage_users.php" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>

        <!-- Manage Students -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Manage Students</h5>
                    <p class="card-text text-muted">View and update student records</p>
                    <a href="manage_students.php" class="btn btn-success">Go</a>
                </div>
            </div>
        </div>

        <!-- Manage Classes -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Manage Classes</h5>
                    <p class="card-text text-muted">Create and manage class schedules</p>
                    <a href="manage_classes.php" class="btn btn-warning">Go</a>
                </div>
            </div>
        </div>

        <!-- Audit Logs -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Audit Logs</h5>
                    <p class="card-text text-muted">Track user activities</p>
                    <a href="audit_logs.php" class="btn btn-danger">Go</a>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```
