<?php
session_start();
include "connect.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM login_users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_name'] = $row['name'];
   header("Location: dashboard.php");

} else {
    echo "Invalid login";
}
?>
