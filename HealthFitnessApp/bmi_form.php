<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>BMI Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>BMI Calculator</h1>
<h3>Hello, <?php echo $user_name; ?> 👋</h3>

<div class="container">
<form action="bmi.php" method="post">
    <input type="number" name="weight" placeholder="Weight (kg)" required>
    <input type="number" name="height" placeholder="Height (cm)" required>
    <button type="submit">Calculate BMI</button>
</form>

<br>
<a href="dashboard.php"><button>Back to Dashboard</button></a>
</div>

</body>
</html>
