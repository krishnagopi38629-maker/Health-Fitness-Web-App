<?php
include "connect.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO login_users(name, email, password)
        VALUES ('$name', '$email', '$password')";

if (mysqli_query($conn, $sql)) {
    echo "Registration successful <br>";
    echo "<a href='login.html'>Login Now</a>";
} else {
    echo "Error";
}
?>
