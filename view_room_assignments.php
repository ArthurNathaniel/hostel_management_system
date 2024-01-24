<!-- view_room_assignments.php -->
<?php
require('db.php');

$stmt = $conn->prepare("SELECT students.id, students.first_name, students.last_name, rooms.room_number FROM students LEFT JOIN rooms ON students.room_id = rooms.id");
$stmt->execute();
$stmt->bind_result($student_id, $first_name, $last_name, $room_number);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Room Assignments</title>
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <div class="page-all">
        <div class="forms-all">
            <div class="forms-title">
                <h1>View Room Assignments</h1>
            </div>
            <div class="forms">
                <table>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Room Number</th>
                    </tr>
                    <?php while ($stmt->fetch()) : ?>
                        <tr>
                            <td><?php echo $student_id; ?></td>
                            <td><?php echo $first_name; ?></td>
                            <td><?php echo $last_name; ?></td>
                            <td><?php echo $room_number; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>