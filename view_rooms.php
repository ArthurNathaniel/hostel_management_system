<?php
require('db.php');

// Fetch all rooms from the database
$result = $conn->query("SELECT * FROM rooms");

// Check if there are any rooms
if ($result->num_rows > 0) {
    echo "<h2>Available Rooms</h2>";
    echo "<table border='1'>
            <tr>
                <th>Room ID</th>
                <th>Room Number</th>
                <th>Capacity</th>
                <th>Students Allocated</th>
            </tr>";

    // Output data of each room
    while ($room = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$room['id']}</td>
                <td>{$room['room_number']}</td>
                <td>{$room['capacity']}</td>
                <td>";

        // Fetch students allocated to this room
        $studentsResult = $conn->query("SELECT * FROM students WHERE room_id = {$room['id']}");

        // Check if there are any students
        if ($studentsResult->num_rows > 0) {
            // Output names of students
            while ($student = $studentsResult->fetch_assoc()) {
                echo "{$student['first_name']} {$student['last_name']}<br>";
            }
        } else {
            echo "No students allocated";
        }

        echo "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No rooms available.</p>";
}

$conn->close();
