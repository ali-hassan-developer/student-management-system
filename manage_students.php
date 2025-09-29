<?php
session_start();
include 'db.php';
require 'functions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Add Student
if (isset($_POST['add_student'])) {
    $student_name = trim($_POST['student_name']);
    $roll_no      = trim($_POST['roll_no']);
    $class        = trim($_POST['class']);
    $email        = trim($_POST['email']);

    if (!empty($student_name) && !empty($roll_no) && !empty($class)) {
        $stmt = $conn->prepare("INSERT INTO students (student_name, roll_no, class, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $student_name, $roll_no, $class, $email);

        if ($stmt->execute()) {
            log_audit($conn, $_SESSION['user_id'], 'Student', 'Add', "Student '$student_name' (Roll: $roll_no)", 'success');
        } else {
            log_audit($conn, $_SESSION['user_id'], 'Student', 'Add', "Failed to add student '$student_name'", 'error');
        }
    }
    header("Location: manage_students.php");
    exit();
}

// Delete Student
if (isset($_GET['delete_id'])) {
    $sid = (int) $_GET['delete_id'];

    // ✅ Soft delete: sirf is_deleted ko yes set karo
    $stmt = $conn->prepare("UPDATE students SET is_deleted='yes' WHERE id=?");
    $stmt->bind_param("i", $sid);

    if ($stmt->execute()) {
        log_audit($conn, $_SESSION['user_id'], 'Student', 'Delete', "Student ID $sid marked as deleted", 'success');
    } else {
        log_audit($conn, $_SESSION['user_id'], 'Student', 'Delete', "Failed to mark Student ID $sid deleted", 'error');
    }
    header("Location: manage_students.php");
    exit();
}


// Fetch students
$result = $conn->query("SELECT id, student_name, roll_no, class, email FROM students where is_deleted='no' ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Manage Students</h2>
    <a href="admin_dashboard.php" class="btn btn-secondary mb-3">Back</a>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addStudentModal">+ Add Student</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Roll No</th><th>Class</th><th>Email</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['student_name']) ?></td>
                <td><?= htmlspecialchars($row['roll_no']) ?></td>
                <td><?= htmlspecialchars($row['class']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td>
                    <a href="manage_students.php?delete_id=<?= $row['id'] ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure to delete this student?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="student_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Roll No</label>
            <input type="text" name="roll_no" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Class</label>
            <input type="text" name="class" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="add_student" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
