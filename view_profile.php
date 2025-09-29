<?php
session_start();
include 'db.php';

// Only student can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

// Fetch student's info
$student_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT s.student_name, s.roll_no, s.class, s.email, s.phone, s.marks, s.attendance 
                        FROM students s
                        JOIN users u ON s.user_id = u.id
                        WHERE u.id = ? AND s.is_deleted='no'");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container">
        <h2>My Profile</h2>
        <a href="students_dashboard.php" class="btn btn-secondary mb-3">Back</a>

        <?php if ($student): ?>
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <td><?= htmlspecialchars($student['student_name']) ?></td>
                </tr>
                <tr>
                    <th>Roll No</th>
                    <td><?= htmlspecialchars($student['roll_no']) ?></td>
                </tr>
                <tr>
                    <th>Class</th>
                    <td><?= htmlspecialchars($student['class']) ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?= htmlspecialchars($student['phone']) ?></td>
                </tr>
                <tr>
                    <th>Marks</th>
                    <td><?= htmlspecialchars($student['marks']) ?></td>
                </tr>
                <tr>
                    <th>Attendance</th>
                    <td><?= htmlspecialchars($student['attendance']) ?></td>
                </tr>
            </table>
        <?php else: ?>
            <div class="alert alert-warning">No data found.</div>
        <?php endif; ?>
    </div>
</body>

</html>