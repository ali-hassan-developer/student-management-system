<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit();
}

$msg = "";

// Update marks
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sid = (int) $_POST['student_id'];
    $marks = (int) $_POST['marks'];

    $stmt = $conn->prepare("UPDATE students SET marks=? WHERE id=?");
    $stmt->bind_param("ii", $marks, $sid);

    if ($stmt->execute()) {
        $msg = "<div class='alert alert-success'>Marks updated successfully!</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Failed to update marks.</div>";
    }
}

// Fetch students
$result = $conn->query("SELECT id, student_name, roll_no, class, marks FROM students WHERE is_deleted='no'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Marks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Update Student Marks</h2>
    <a href="teacher_dashboard.php" class="btn btn-secondary mb-3">Back</a>
    <?= $msg ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Roll No</th><th>Class</th><th>Marks</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <form method="POST">
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['student_name']) ?></td>
                    <td><?= htmlspecialchars($row['roll_no']) ?></td>
                    <td><?= htmlspecialchars($row['class']) ?></td>
                    <td>
                        <input type="number" name="marks" value="<?= $row['marks'] ?>" class="form-control" required>
                    </td>
                    <td>
                        <input type="hidden" name="student_id" value="<?= $row['id'] ?>">
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                    </td>
                </form>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
