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
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Health & Fitness Dashboard</h1>
<h3>Welcome, <?php echo $user_name; ?> 👋</h3>
<div class="image-row">
    <img src="images/fitness1.jpg" alt="Workout">
    <img src="images/fitness2.jpg" alt="Healthy Food">
    <img src="images/fitness3.jpg" alt="Yoga">
</div>


<div class="container">

    <a href="bmi_form.php">
        <button>Calculate BMI</button>
    </a>

    <a href="diet.php">
        <button>View Diet Plan</button>
    </a>

    <a href="view_users.php">
        <button>View My Records</button>
    </a>

    <!-- ✅ NEW BUTTON ADDED -->
    <a href="bmi_graph.php">
        <button>View BMI Graph</button>
    </a>

    <a href="workout.html">
        <button>Workout Plan</button>
    </a>

    <a href="logout.php">
        <button>Logout</button>
    </a>

</div>

</body>
</html>
