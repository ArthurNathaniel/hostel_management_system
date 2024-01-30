<?php
session_start(); // Start the session

// Check if the user is not authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

include 'db.php';

// Count the total number of students
$result = $conn->query("SELECT COUNT(*) as total_students FROM student");
$totalStudents = $result->fetch_assoc()['total_students'];

// Count the number of male and female students
$resultGender = $conn->query("SELECT gender, COUNT(*) as count FROM student GROUP BY gender");
$genderData = $resultGender->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/dashboard.css">
</head>
<style>
    
</style>
<body>
    <div class="hey">
        <?php include 'sidebar.php' ?>
    </div>
    <div class="dashboard_all">
        <h4>Dashboard</h4>
        <div class="dash_grid">
            <div class="dash_box">
                <p>Total Number of Students: <?php echo $totalStudents; ?></p>
                <canvas id="studentsChart" width="400" height="200"></canvas>
            </div>
            <div class="dash_box">
                <p>Gender Distribution</p>
                <canvas id="genderChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
    <script src="./js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Use Chart.js to create a pie chart for total students
        var ctxStudents = document.getElementById('studentsChart').getContext('2d');
        var studentsChart = new Chart(ctxStudents, {
            type: 'pie',
            data: {
                labels: ['Total Students'],
                datasets: [{
                    label: 'Number of Students',
                    data: [<?php echo $totalStudents; ?>],
                    backgroundColor: '#6158e5',
                    borderColor: 'white',
                    borderWidth: 2
                }]
            }
        });

        // Use Chart.js to create a pie chart for gender distribution
        var ctxGender = document.getElementById('genderChart').getContext('2d');

        // Assuming gender is dynamic, handle it dynamically
        var genderLabels = <?php echo json_encode(array_column($genderData, 'gender')); ?>;
        var genderCounts = <?php echo json_encode(array_column($genderData, 'count')); ?>;

        var genderChart = new Chart(ctxGender, {
            type: 'doughnut',
            data: {
                labels: genderLabels,
                datasets: [{
                    label: 'Number of Students',
                    data: genderCounts,
                    backgroundColor: ['#ff4961', '#6158e5'],
                    borderColor: 'white',
                    borderWidth: 2
                }]
            }
        });
    </script>
</body>

</html>