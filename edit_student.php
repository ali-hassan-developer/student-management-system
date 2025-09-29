<?php
// edit_student.php
include 'db.php';
$id = intval($_GET['id'] ?? 0);
if($id<=0){ header("Location: index.php"); exit; }

$stmt = $conn->prepare("SELECT * FROM students WHERE id = ? AND is_deleted='no'");
$stmt->bind_param("i",$id);
$stmt->execute();
$res = $stmt->get_result();
$student = $res->fetch_assoc();
if(!$student){ header("Location: index.php"); exit; }

$errors = [];
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = trim($_POST['student_name'] ?? '');
    $roll = trim($_POST['roll_no'] ?? '');
    $class = trim($_POST['class'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    if($name==='' || $roll==='') $errors[] = "Name and Roll No are required.";

    if(empty($errors)){
        $up = $conn->prepare("UPDATE students SET student_name=?, roll_no=?, class=?, email=?, phone=? WHERE id=?");
        $up->bind_param("sssssi", $name, $roll, $class, $email, $phone, $id);
        if($up->execute()){
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Update failed: " . $conn->error;
        }
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Student</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h2>Edit Student</h2>
    <?php if($errors): ?><div class="alert alert-danger"><?=implode('<br>', array_map('htmlspecialchars',$errors))?></div><?php endif; ?>
    <form method="post">
      <div class="mb-3"><label class="form-label">Name</label><input name="student_name" value="<?=htmlspecialchars($student['student_name'])?>" class="form-control" required></div>
      <div class="mb-3"><label class="form-label">Roll No</label><input name="roll_no" value="<?=htmlspecialchars($student['roll_no'])?>" class="form-control" required></div>
      <div class="mb-3"><label class="form-label">Class</label><input name="class" value="<?=htmlspecialchars($student['class'])?>" class="form-control"></div>
      <div class="mb-3"><label class="form-label">Email</label><input name="email" type="email" value="<?=htmlspecialchars($student['email'])?>" class="form-control"></div>
      <div class="mb-3"><label class="form-label">Phone</label><input name="phone" value="<?=htmlspecialchars($student['phone'])?>" class="form-control"></div>
      <button class="btn btn-primary">Update</button>
      <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</body>
</html>
