<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit();
}

$msg = "";

// Ensure attendance_records table exists
$conn->query("
    CREATE TABLE IF NOT EXISTS attendance_records (
        id INT AUTO_INCREMENT PRIMARY KEY,
        student_id INT NOT NULL,
        attendance_date DATE NOT NULL,
        status ENUM('present','absent') NOT NULL DEFAULT 'absent',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY student_date (student_id, attendance_date),
        FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
    )
");

// Handle attendance submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['attendance'])) {
    $date = date('Y-m-d'); // today
    foreach ($_POST['attendance'] as $sid => $status) {
        $stmt = $conn->prepare("
            INSERT INTO attendance_records (student_id, attendance_date, status)
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE status=VALUES(status)
        ");
        $stmt->bind_param("iss", $sid, $date, $status);
        $stmt->execute();
    }
    $msg = "<div class='alert alert-success'>Attendance updated for $date!</div>";
}

// Fetch students
$result = $conn->query("SELECT id, student_name, roll_no, class FROM students WHERE is_deleted='no' ORDER BY student_name ASC");

// Attendance summary
$summary_data = $conn->query("
    SELECT s.student_name, s.roll_no, s.class, 
           ar.attendance_date, ar.status
    FROM students s
    LEFT JOIN attendance_records ar ON s.id = ar.student_id
    ORDER BY s.student_name ASC, ar.attendance_date DESC
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Mark Attendance</h2>
    <a href="teacher_dashboard.php" class="btn btn-secondary mb-3">Back</a>

    <?= $msg ?>

    <!-- Attendance Form -->
    <form method="POST">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Roll No</th>
                    <th>Class</th>
                    <th>Attendance Today (<?= date('Y-m-d') ?>)</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): 
                    // Fetch today's attendance
                    $stmt = $conn->prepare("SELECT status FROM attendance_records WHERE student_id=? AND attendance_date=?");
                    $today = date('Y-m-d');
                    $stmt->bind_param("is", $row['id'], $today);
                    $stmt->execute();
                    $att_result = $stmt->get_result();
                    $att_row = $att_result->fetch_assoc();
                    $status = $att_row['status'] ?? 'absent';
                ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['student_name']) ?></td>
                    <td><?= htmlspecialchars($row['roll_no']) ?></td>
                    <td><?= htmlspecialchars($row['class']) ?></td>
                    <td>
                        <select name="attendance[<?= $row['id'] ?>]" class="form-select">
                            <option value="present" <?= $status=="present"?"selected":"" ?>>Present</option>
                            <option value="absent" <?= $status=="absent"?"selected":"" ?>>Absent</option>
                        </select>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-success mb-4">Save Attendance</button>
    </form>

    <!-- Attendance Summary -->
    <h4>Attendance Records</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Roll No</th>
                <th>Class</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $summary_data->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['student_name']) ?></td>
                <td><?= htmlspecialchars($row['roll_no']) ?></td>
                <td><?= htmlspecialchars($row['class']) ?></td>
                <td><?= $row['attendance_date'] ?? '-' ?></td>
                <td><?= ucfirst($row['status'] ?? '-') ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
