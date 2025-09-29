<?php
// index.php
include 'db.php';
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Student Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Students</h2>
      <a href="add_student.php" class="btn btn-primary">Add Student</a>
    </div>

    <?php
    $sql = "SELECT * FROM students WHERE is_deleted = 'no' ORDER BY id DESC";
    $res = $conn->query($sql);
    ?>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Roll</th>
          <th>Class</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php if($res && $res->num_rows>0): ?>
        <?php while($row = $res->fetch_assoc()): ?>
          <tr>
            <td><?=htmlspecialchars($row['id'])?></td>
            <td><?=htmlspecialchars($row['student_name'])?></td>
            <td><?=htmlspecialchars($row['roll_no'])?></td>
            <td><?=htmlspecialchars($row['class'])?></td>
            <td><?=htmlspecialchars($row['email'])?></td>
            <td><?=htmlspecialchars($row['phone'])?></td>
            <td>
              <a href="edit_student.php?id=<?=$row['id']?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="delete_student.php?id=<?=$row['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="7" class="text-center">No students found.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
