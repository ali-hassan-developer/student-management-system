<?php
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'teacher' && $_SESSION['role'] !== 'admin')) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">Teacher Panel</a>
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
    <h3 class="mb-4">Dashboard Options</h3>
    <div class="row g-4">

        <!-- View Students -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 text-center">
                <div class="card-body">
                    <i class="bi bi-people display-4 text-primary mb-3"></i>
                    <h5 class="card-title">View Students</h5>
                    <p class="card-text text-muted">Check list of students in your class</p>
                    <a href="view_students.php" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>

        <!-- Update Marks -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 text-center">
                <div class="card-body">
                    <i class="bi bi-pencil-square display-4 text-success mb-3"></i>
                    <h5 class="card-title">Update Marks</h5>
                    <p class="card-text text-muted">Enter and update student grades</p>
                    <a href="update_marks.php" class="btn btn-success">Go</a>
                </div>
            </div>
        </div>

        <!-- Attendance -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 text-center">
                <div class="card-body">
                    <i class="bi bi-check2-square display-4 text-warning mb-3"></i>
                    <h5 class="card-title">Mark Attendance</h5>
                    <p class="card-text text-muted">Track daily student attendance</p>
                    <a href="attendance.php" class="btn btn-warning">Go</a>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```
