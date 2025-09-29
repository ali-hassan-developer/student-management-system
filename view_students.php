<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit();
}

// Fetch students
$result = $conn->query("SELECT id, student_name, roll_no, class, email FROM students WHERE is_deleted='no' ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Student List</h2>
    <a href="teacher_dashboard.php" class="btn btn-secondary mb-3">Back</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Roll No</th><th>Class</th><th>Email</th>
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
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
