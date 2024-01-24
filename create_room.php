<!-- create_room.php -->
<?php
require('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_number = $_POST['room_number'];
    $capacity = $_POST['capacity'];

    $stmt = $conn->prepare("INSERT INTO rooms (room_number, capacity) VALUES (?, ?)");
    $stmt->bind_param("si", $room_number, $capacity);

    if ($stmt->execute()) {
        echo "Room created successfully. <a href='view_rooms.php'>View Rooms</a>";
    } else {
        echo "Error creating room.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Room</title>
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <div class="page-all">
        <form action="create_room.php" method="post">
            <div class="forms-all">
                <div class="forms-title">
                    <h1>Create Room</h1>
                </div>
                <div class="forms">
                    <label for="room_number">Room Number:</label>
                    <input type="text" name="room_number" id="room_number" required />
                </div>
                <div class="forms">
                    <label for="capacity">Capacity:</label>
                    <input type="number" name="capacity" id="capacity" required />
                </div>
                <div class="forms">
                    <button type="submit">Create Room</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>