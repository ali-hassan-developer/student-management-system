<?php
session_start();
include 'db.php';
require 'functions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username     = trim($_POST['username']);
    $email        = trim($_POST['email']);
    $password     = $_POST['password'];
    $student_name = trim($_POST['student_name']);
    $roll_no      = trim($_POST['roll_no']);
    $class        = trim($_POST['class']);
    $phone        = trim($_POST['phone']);

    // Basic validation
    if (empty($username) || empty($email) || empty($password) || empty($student_name) || empty($roll_no)) {
        $msg = "<div class='alert alert-danger'>All fields are required.</div>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "<div class='alert alert-danger'>Invalid email format.</div>";
    } elseif (strlen($password) < 6) {
        $msg = "<div class='alert alert-danger'>Password must be at least 6 characters.</div>";
    } else {
        // Insert into users table
        $stmt1 = $conn->prepare("INSERT INTO users (username, email, password, role, is_active) VALUES (?, ?, ?, 'student', 1)");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt1->bind_param("sss", $username, $email, $hashedPassword);

        if ($stmt1->execute()) {
            $user_id = $stmt1->insert_id;

            // Insert into students table
            $stmt2 = $conn->prepare("INSERT INTO students (user_id, student_name, roll_no, class, attendance, marks, email, phone) VALUES (?, ?, ?, ?, 'absent', 0, ?, ?)");
            $stmt2->bind_param("isssss", $user_id, $student_name, $roll_no, $class, $email, $phone);

            if ($stmt2->execute()) {
                // Log audit
                log_audit($conn, $_SESSION['user_id'], 'Student', 'Add', "Student '$student_name' added with User ID $user_id", 'success');
                $msg = "<div class='alert alert-success'>Student added successfully!</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Error inserting student: ".$stmt2->error."</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Error inserting user: ".$stmt1->error."</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Add New Student</h2>
    <a href="manage_students.php" class="btn btn-secondary mb-3">Back</a>

    <?= $msg ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <hr>
        <div class="mb-3">
            <label class="form-label">Student Name</label>
            <input type="text" name="student_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Roll No</label>
            <input type="text" name="roll_no" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Class</label>
            <input type="text" name="class" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Add Student</button>
    </form>
</div>
</body>
</html>
