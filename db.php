<?php
$host='localhost';
$username='root';
$pass='';
$db='login_system';
$conn=mysqli_connect($host,$username,$pass,$db);
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
} 
if($conn){
}else{
    die('not connected');
}
?>
