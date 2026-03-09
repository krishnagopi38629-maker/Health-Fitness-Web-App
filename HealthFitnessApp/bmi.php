<?php
session_start();
include "connect.php";

/* 🔒 Security check */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];   // ✅ FIXED LINE

$weight = $_POST['weight'];
$height_cm = $_POST['height'];

/* BMI calculation */
$height_m = $height_cm / 100;
$bmi = $weight / ($height_m * $height_m);

/* BMI status */
if ($bmi < 18.5)
    $status = "Underweight";
else if ($bmi < 25)
    $status = "Normal";
else if ($bmi < 30)
    $status = "Overweight";
else
    $status = "Obese";

/* Insert record */
$sql = "INSERT INTO users (user_id, name, weight, height, bmi, status)
        VALUES ('$user_id', '$name', '$weight', '$height_cm', '$bmi', '$status')";

mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>BMI Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Hello <?php echo $name; ?></h2>
    <p>Your BMI: <b><?php echo round($bmi, 2); ?></b></p>
    <p>Status: <b><?php echo $status; ?></b></p>

    <a href="dashboard.php"><button>Back to Dashboard</button></a>
</div>

</body>
</html>
