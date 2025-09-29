<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

// Fetch student's attendance using user_id
$student_id = $_SESSION['user_id'];
$stmt = $conn->prepare("
    SELECT s.student_name, s.class, s.attendance
    FROM students s
    WHERE s.user_id = ? AND s.is_deleted='no'
");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>My Attendance</h2>
    <a href="students_dashboard.php" class="btn btn-secondary mb-3">Back</a>

    <?php if ($student): ?>
        <table class="table table-bordered">
            <tr><th>Name</th><td><?= htmlspecialchars($student['student_name']) ?></td></tr>
            <tr><th>Class</th><td><?= htmlspecialchars($student['class']) ?></td></tr>
            <tr><th>Attendance</th><td><?= htmlspecialchars($student['attendance']) ?></td></tr>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">No attendance data found for your account.</div>
    <?php endif; ?>
</div>
</body>
</html>
