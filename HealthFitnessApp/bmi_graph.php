<?php
session_start();
include "connect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
?>
<?php
$bmi_values = [];
$dates = [];

$sql = "SELECT bmi, id FROM users WHERE user_id='$user_id' ORDER BY id ASC";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $bmi_values[] = $row['bmi'];
    $dates[] = "Record " . $row['id'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>BMI History Graph</title>
    <link rel="stylesheet" href="style.css">

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<h1>BMI History Graph</h1>
<div class="container">
    <canvas id="bmiChart"></canvas>

    <br>
    <a href="dashboard.php">
        <button>Back to Dashboard</button>
    </a>
</div>
<script>
const bmiData = <?php echo json_encode($bmi_values); ?>;
const labels = <?php echo json_encode($dates); ?>;

const ctx = document.getElementById('bmiChart').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'BMI Progress',
            data: bmiData,
            borderColor: 'blue',
            fill: false,
            tension: 0.3
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: false
            }
        }
    }
});
</script>
 