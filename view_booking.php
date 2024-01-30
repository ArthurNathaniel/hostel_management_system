<?php
session_start(); // Start the session

// Check if the user is not authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Add custom CSS for setting the background color of table header */
        th {
            background-color: #6158e5 !important;
            color: #fff !important;
        }

        .view_booking {
            padding: 0 5%;

        }
    </style>
</head>


<body>
    <?php include 'sidebar.php' ?>
    <div class="view_booking">
        <h2>Booking Details</h2>

        <?php
        include 'db.php';

        $sql = "SELECT * FROM bookings";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Room Type</th>
                                <th>Booking Code</th>
                            </tr>
                        </thead>
                        <tbody>';

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['room_type'] . "</td>
                        <td>" . $row['booking_code'] . "</td>
                      </tr>";
            }

            echo '</tbody>
                    </table>
                </div>';
        } else {
            echo "No bookings found.";
        }

        $conn->close();
        ?>

        <!-- Include Bootstrap JS and Popper.js -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="./js/navbar.js"></script>
    </div>
</body>

</html>