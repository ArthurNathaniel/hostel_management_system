<?php
require('db.php');

// Check if the admin is logged in
session_start();
if (!isset($_SESSION['authenticated'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_POST['student'];
    $roomId = $_POST['room'];

    // Update the student's room assignment in the database
    $updateStmt = $conn->prepare("UPDATE students SET room_id = ? WHERE id = ?");
    $updateStmt->bind_param("ii", $roomId, $studentId);

    if ($updateStmt->execute()) {
        // Update the room status to 'assigned'
        $updateRoomStmt = $conn->prepare("UPDATE rooms SET status = 'assigned' WHERE id = ?");
        $updateRoomStmt->bind_param("i", $roomId);
        $updateRoomStmt->execute();
        $updateRoomStmt->close();

        echo "Room assigned successfully. <a href='view_room_assignments.php'>View Room Assignments</a>";
    } else {
        echo "Error assigning room: " . $updateStmt->error;
    }

    $updateStmt->close();
}

$conn->close();
