<?php
include 'db.php';
session_start(); // Start the session

// Check if the user is not authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate user input
    $roomName = mysqli_real_escape_string($conn, $_POST["room_name"]);
    $roomNumber = mysqli_real_escape_string($conn, $_POST["room_number"]);
    $capacity = intval($_POST["capacity"]);
    $gender = $_POST["gender"]; // Added gender input

    // Check if the room already exists
    $checkQuery = "SELECT * FROM rooms WHERE room_name = '$roomName' AND room_number = '$roomNumber'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "<script>alert('Room already exists!');</script>";
    } else {
        // Insert the room if it doesn't already exist
        $insertQuery = "INSERT INTO rooms (room_name, room_number, capacity, gender) VALUES ('$roomName', '$roomNumber', $capacity, '$gender')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "<script>alert('Room created successfully!');</script>";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a room</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/book_a_hostel_room.css">
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="body">
        <div class="book_a_hostel_room">
            <div class="title">
                <h1>Create a Hostel Room</h1>
            </div>
            <form method="post" action="">
                <div class="forms">
                    <label> Room Name: </label>
                    <input type="text" placeholder="Enter your room name" name="room_name" required>
                </div>
                <div class="forms">
                    <label>Room Number:</label>
                    <input type="text" placeholder="Enter your room number" name="room_number" required>
                </div>
                <div class="forms">
                    <label> Capacity:</label>
                    <input type="number" placeholder="Enter your room capacity" name="capacity" required>
                </div>
                <div class="forms">
                    <label> Gender:</label>
                    <select name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="forms">
                    <button type="submit">Create Room</button>
                </div>
            </form>
        </div>
    </div>
    <script src="./js/navbar.js"></script>
</body>

</html>