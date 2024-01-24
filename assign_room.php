<?php
require('db.php');

// Check if the admin is logged in
session_start();
if (!isset($_SESSION['authenticated'])) {
    header("Location: login.php");
    exit();
}

// Fetch the list of registered students
$studentsQuery = "SELECT id, first_name, last_name FROM students";
$studentsResult = $conn->query($studentsQuery);

// Fetch the list of available rooms
$roomsQuery = "SELECT id, room_number FROM rooms WHERE status = 'available'";
$roomsResult = $conn->query($roomsQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Room</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="page-all">
        <div class="forms-all">
            <div class="forms-title">
                <h1>Assign Room</h1>
            </div>
            <form action="assign_room_process.php" method="post">
                <div class="forms">
                    <label for="student">Select Student:</label>
                    <select name="student" id="student" required>
                        <?php
                        while ($student = $studentsResult->fetch_assoc()) {
                            echo "<option value='" . $student['id'] . "'>" . $student['first_name'] . " " . $student['last_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="forms">
                    <label for="room">Select Room:</label>
                    <select name="room" id="room" required>
                        <?php
                        while ($room = $roomsResult->fetch_assoc()) {
                            echo "<option value='" . $room['id'] . "'>" . $room['room_number'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="forms">
                    <button type="submit">Assign Room</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>