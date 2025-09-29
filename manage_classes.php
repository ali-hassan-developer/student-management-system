<?php
session_start();
include 'db.php';
require 'functions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// ---- Class Delete ----
if (isset($_GET['delete_id'])) {
    $cid = (int) $_GET['delete_id'];

    $stmt = $conn->prepare("UPDATE classes SET is_deleted='yes' WHERE id=?");
    $stmt->bind_param("i", $cid);

    if ($stmt->execute()) {
        log_audit($conn, $_SESSION['user_id'], 'Class', 'Delete', "Class ID $cid deleted", 'success');
    } else {
        log_audit($conn, $_SESSION['user_id'], 'Class', 'Delete', "Failed to delete Class ID $cid", 'error');
    }

    header("Location: manage_classes.php");
    exit();
}

// ---- Update Class ----
if (isset($_POST['update_class'])) {
    $cid = (int) $_POST['class_id'];
    $class_name = trim($_POST['class_name']);
    $section = trim($_POST['section']);

    $stmt = $conn->prepare("UPDATE classes SET class_name=?, section=? WHERE id=?");
    $stmt->bind_param("ssi", $class_name, $section, $cid);

    if ($stmt->execute()) {
        log_audit($conn, $_SESSION['user_id'], 'Class', 'Update', "Class ID $cid updated", 'success');
    } else {
        log_audit($conn, $_SESSION['user_id'], 'Class', 'Update', "Failed to update Class ID $cid", 'error');
    }

    header("Location: manage_classes.php");
    exit();
}

// ---- Fetch Classes ----
$result = $conn->query("SELECT id, class_name, section FROM classes WHERE is_deleted='no' ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Classes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Manage Classes</h2>
    <a href="admin_dashboard.php" class="btn btn-secondary mb-3">Back</a>
    <a href="add_class.php" class="btn btn-success mb-3">Add New Class</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Class Name</th><th>Section</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['class_name']) ?></td>
                <td><?= htmlspecialchars($row['section']) ?></td>
                <td>
                    <!-- Edit button with data-* attributes -->
                    <button class="btn btn-primary btn-sm editBtn"
                            data-id="<?= $row['id'] ?>"
                            data-class="<?= htmlspecialchars($row['class_name']) ?>"
                            data-section="<?= htmlspecialchars($row['section']) ?>">
                        Edit
                    </button>
                    <a href="manage_classes.php?delete_id=<?= $row['id'] ?>" 
                       onclick="return confirm('Are you sure you want to delete this class?');"
                       class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="">
        <div class="modal-header">
          <h5 class="modal-title">Edit Class</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="class_id" id="edit_id">
            <div class="mb-3">
                <label for="edit_class" class="form-label">Class Name</label>
                <input type="text" class="form-control" id="edit_class" name="class_name" required>
            </div>
            <div class="mb-3">
                <label for="edit_section" class="form-label">Section</label>
                <input type="text" class="form-control" id="edit_section" name="section" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="update_class" class="btn btn-success">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll(".editBtn").forEach(btn => {
    btn.addEventListener("click", function () {
        document.getElementById("edit_id").value = this.dataset.id;
        document.getElementById("edit_class").value = this.dataset.class;
        document.getElementById("edit_section").value = this.dataset.section;
        var myModal = new bootstrap.Modal(document.getElementById('editModal'));
        myModal.show();
    });
});
</script>
</body>
</html>
