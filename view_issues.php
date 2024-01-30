<?php
include 'db.php';
session_start(); // Start the session

// Check if the user is not authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}
$select_query = "SELECT * FROM reported_issues";
$result = $conn->query($select_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reported Issues</title>

    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/view_bookng.css">
</head>

<body>
    <?php include 'sidebar.php' ?>
    <div class="view_booking">
        <h2>Reported Issues</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                    
                        <th>Student ID</th>
                        <th>Issue Description</th>
                        <th>Report Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                     
                            <td><?= $row['student_id'] ?></td>
                            <td><?= $row['issue_description'] ?></td>
                            <td><?= $row['report_date'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
<script src="./js/navbar.js"></script>
    <!-- Include Bootstrap JS (Optional, only if you need Bootstrap JS features) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>