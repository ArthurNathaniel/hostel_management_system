<?php
include 'db.php';

// Fetch available rooms with capacity, number of people booked, and gender information from the database
$roomQuery = "SELECT rooms.room_id, room_name, room_number, capacity, gender,
              COUNT(bookings.selected_room) AS booked_count 
              FROM rooms
              LEFT JOIN bookings ON rooms.room_id = bookings.selected_room
              GROUP BY rooms.room_id";
$result = $conn->query($roomQuery);

// Check for errors
if (!$result) {
    die("Error fetching rooms: " . $conn->error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentName = $_POST["student_name"];
    $contactNumber = $_POST["contact_number"];
    $selectedRoom = $_POST["selected_room"];

    // Check if the student has already booked a room
    $existingBookingQuery = "SELECT * FROM bookings WHERE student_name = '$studentName' AND contact_number = '$contactNumber'";
    $existingBookingResult = $conn->query($existingBookingQuery);

    if ($existingBookingResult->num_rows > 0) {
        // echo "Sorry, you have already booked a room.";
        echo "<script>alert('Sorry, you have already booked a room.');</script>";

    } else {
        // Check if the room is not fully booked
        $roomCapacityQuery = "SELECT capacity, COUNT(selected_room) AS booked_count, gender FROM rooms 
                              LEFT JOIN bookings ON rooms.room_id = bookings.selected_room 
                              WHERE room_id = $selectedRoom
                              GROUP BY rooms.room_id";
        $roomCapacityResult = $conn->query($roomCapacityQuery);
        $roomCapacityRow = $roomCapacityResult->fetch_assoc();

        if ($roomCapacityRow['booked_count'] < $roomCapacityRow['capacity']) {
            // Insert the booking if the room is not fully booked
            $insertQuery = "INSERT INTO bookings (student_name, contact_number, selected_room) VALUES ('$studentName', '$contactNumber', $selectedRoom)";

            if ($conn->query($insertQuery) === TRUE) {
                echo "<script>alert('Room booked successfully!');</script>";
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        } else {
            echo "<script>alert('Sorry, the room is fully booked!');</script>";
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
    <title>Book a Hostel room</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/book_a_hostel_room.css">
</head>

<body>
    <div class="body">
        <div class="book_a_hostel_room">
            <div class="title">
                <h1>Book a Hostel room</h1>
            </div>
            <form method="post" action="">
                <div class="forms">
                    <label>Student Name: </label>
                    <input type="text" placeholder="Enter your student's name" name="student_name" required>
                </div>
                <div class="forms">
                    <label>Contact Number:</label>
                    <input type="number" placeholder="Enter your contact number" name="contact_number" required>
                </div>
                <div class="forms">
                    <label> Select Room:</label>
                    <select name="selected_room" id="selectElement" required>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $roomInfo = "{$row['room_name']} - {$row['room_number']} (Capacity: {$row['capacity']}, Booked: {$row['booked_count']}, Gender: {$row['gender']})";
                            echo "<option value='{$row['room_id']}'>$roomInfo</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="forms">
                    <button type="submit">Book a room</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        new SlimSelect({
            select: '#selectElement'
        })
    </script>
</body>

</html>