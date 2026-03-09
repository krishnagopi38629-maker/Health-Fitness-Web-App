<?php
$conn = mysqli_connect("localhost", "root", "", "health_fitness");

if ($conn) {
    echo "Database connected successfully";
} else {
    echo "Connection failed";
}
?>
