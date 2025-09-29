<?php
// delete_student.php
include 'db.php';
$id = intval($_GET['id'] ?? 0);
if($id>0){
    $stmt = $conn->prepare("UPDATE students SET is_deleted='yes' WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
}
header("Location: index.php");
exit;
