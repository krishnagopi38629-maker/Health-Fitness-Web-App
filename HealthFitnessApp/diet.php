<?php
session_start();
include "connect.php";

/* 🔒 Security check */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

/* Fetch latest BMI of logged-in user */
$sql = "SELECT * FROM users WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

$name = $user['name'];
$bmi = $user['bmi'];
$status = $user['status'];
$day = date("l");   // Get current day

$diets = [

"Underweight" => [
    "Monday"    => ["Milk", "Banana", "Boiled eggs"],
    "Tuesday"   => ["Curd", "Dry fruits", "Rice"],
    "Wednesday" => ["Fruit smoothie", "Paneer"],
    "Thursday"  => ["Milk", "Nuts", "Chapati"],
    "Friday"    => ["Eggs", "Brown rice"],
    "Saturday"  => ["Curd", "Potatoes"],
    "Sunday"    => ["Healthy home food"]
],

"Normal" => [
    "Monday"    => ["Fruits", "Chapati", "Dal"],
    "Tuesday"   => ["Oats", "Milk"],
    "Wednesday" => ["Salad", "Rice"],
    "Thursday"  => ["Eggs", "Vegetables"],
    "Friday"    => ["Curd", "Chapati"],
    "Saturday"  => ["Fruits", "Soup"],
    "Sunday"    => ["Balanced diet"]
],

"Overweight" => [
    "Monday"    => ["Oats", "Green tea"],
    "Tuesday"   => ["Salad", "Fruits"],
    "Wednesday" => ["Soup", "Vegetables"],
    "Thursday"  => ["Sprouts", "Curd"],
    "Friday"    => ["Boiled vegetables"],
    "Saturday"  => ["Low-fat foods"],
    "Sunday"    => ["Light diet"]
],

"Obese" => [
    "Monday"    => ["Salad", "Green tea"],
    "Tuesday"   => ["Soup", "Vegetables"],
    "Wednesday" => ["Fruits"],
    "Thursday"  => ["Sprouts"],
    "Friday"    => ["Boiled food"],
    "Saturday"  => ["Low-carb diet"],
    "Sunday"    => ["Light food"]
]

];
$todayDiet = $diets[$status][$day];

$randomDiet = $diets[$status][array_rand($diets[$status])];
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Diet Plan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Personalized Diet Plan</h1>

<div class="container">
    <h2>Hello <?php echo $name; ?></h2>
    <p><b>BMI:</b> <?php echo round($bmi, 2); ?></p>
    <p><b>Status:</b> <?php echo $status; ?></p>

    <hr>

    <h3><?php echo $day; ?> Diet Plan</h3>

    <ul>
        <?php foreach ($todayDiet as $item) {
    echo "<li>$item</li>";
}
 ?>
    </ul>

    <p><i>(Refresh page to change diet)</i></p>

    <a href="dashboard.php"><button>Go Back</button></a>
</div>

</body>
</html>
