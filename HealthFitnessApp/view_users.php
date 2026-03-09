<?php
session_start();
include "connect.php";

/* 🔒 Security check */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Health Records</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>My Health & Fitness Records</h1>

<div class="container">
<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Weight</th>
    <th>Height</th>
    <th>BMI</th>
    <th>Status</th>
</tr>

<?php
$sql = "SELECT * FROM users WHERE user_id='$user_id' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['weight']}</td>
                <td>{$row['height']}</td>
                <td>".round($row['bmi'],2)."</td>
                <td>{$row['status']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No records found</td></tr>";
}
?>
</table>

<br>
<a href="dashboard.php"><button>Go Back</button></a>
</div>

</body>
</html>
