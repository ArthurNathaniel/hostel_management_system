<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/view_booking.css">
</head>
<style>
    .dd {
        width: 100%;
        padding: 0 7%;
        margin-top: 70px;
    }

    .hello {
        background-color: #6158e5 !important;
    }
</style>

<body>
    <?php include 'sidebar.php' ?>
    <div class="view_booking  dd">
        <h2>View Bookings</h2>

        <?php
        include 'db.php';
        session_start(); // Start the session

        // Check if the user is not authenticated
        if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
            // Redirect to the login page
            header("Location: login.php");
            exit();
        }
        // Fetch booking information from the database
        $bookingQuery = "SELECT bookings.booking_id, student_name, contact_number, 
                         rooms.room_name, rooms.room_number
                         FROM bookings
                         JOIN rooms ON bookings.selected_room = rooms.room_id";
        $bookingResult = $conn->query($bookingQuery);

        // Check for errors in the query execution
        if (!$bookingResult) {
            die("Error fetching bookings: " . $conn->error);
        }

        // Check if there are rows returned from the query
        if ($bookingResult->num_rows > 0) {
            echo '<div class="table-responsive">
                    <table class="table table-striped">
                        <thead  class="hello">
                            <tr>
                                <th>Booking ID</th>
                                <th>Student Name</th>
                                <th>Contact Number</th>
                                <th>Room Name</th>
                                <th>Room Number</th>
                            </tr>
                        </thead>
                        <tbody>';

            // Loop through the fetched bookings and display them in a table
            while ($bookingRow = $bookingResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$bookingRow['booking_id']}</td>";
                echo "<td>{$bookingRow['student_name']}</td>";
                echo "<td>{$bookingRow['contact_number']}</td>";

                // Check if the columns exist in the result set before echoing
                if (isset($bookingRow['room_name'])) {
                    echo "<td>{$bookingRow['room_name']}</td>";
                } else {
                    echo "<td>Not available</td>";
                }

                if (isset($bookingRow['room_number'])) {
                    echo "<td>{$bookingRow['room_number']}</td>";
                } else {
                    echo "<td>Not available</td>";
                }

                echo "</tr>";
            }

            echo '</tbody>
                </table>
            </div>';
        } else {
            echo "No bookings found.";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
    <script src="./js/navbar.js"></script>
    <!-- Include Bootstrap JS (Optional, only if you need Bootstrap JS features) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>