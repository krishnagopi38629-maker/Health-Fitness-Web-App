<?php
session_start();

/* 🔒 Security check */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_name = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Health & Fitness Web Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- 🔴 Logout button (top-right) -->
<div style="text-align:right; margin:10px;">
    <a href="logout.php">
        <button>Logout</button>
    </a>
</div>

<h1>Health & Fitness Web Application</h1>
<h3>Welcome, <?php echo $user_name; ?> 👋</h3>

<div class="container">
    <h2>BMI Calculator</h2>

    <form action="bmi.php" method="post">
        <input type="text" name="name" placeholder="Enter Your Name" required>
        <input type="number" name="weight" placeholder="Weight (kg)" required>
        <input type="number" name="height" placeholder="Height (cm)" required>
        <button type="submit">Calculate BMI</button>
    </form>
</div>

<br><br>

<!-- 🔹 User-based pages -->
<a href="diet.php">
    <button>View My Diet Plan</button>
</a>

<a href="workout.html">
    <button>View Workout Plan</button>
</a>

<a href="view_users.php">
    <button>View My Records</button>
</a>

</body>
</html>
