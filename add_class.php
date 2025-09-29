<?php
session_start();
include 'db.php';


// ✅ Only admin can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_name = trim($_POST['class_name']);
    $section    = trim($_POST['section']);

    if (empty($class_name) || empty($section)) {
        $msg = "<div class='alert alert-danger'>Both fields are required.</div>";
    } else {
        // ✅ Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO classes (class_name, section) VALUES (?, ?)");
        $stmt->bind_param("ss", $class_name, $section);

        if ($stmt->execute()) {
            $msg = "<div class='alert alert-success'>Class added successfully! <a href='manage_classes.php'>Go Back</a></div>";
        } else {
            $msg = "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h3 class="mb-3">➕ Add New Class</h3>
                <?php if (!empty($msg)) echo $msg; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Class Name</label>
                        <input type="text" name="class_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Section</label>
                        <input type="text" name="section" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Add Class</button>
                    <a href="manage_classes.php" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
