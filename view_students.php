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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Students</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/view_students.css" />
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="container">
        <div class="heading">
            <h3>All Students Database</h3>
        </div>
        <div class="table-responsive">
            <?php
            require('db.php');

            // Fetch all students from the 'student' table
            $sql = "SELECT id, first_name, middle_name, last_name, dob, phone_number, father_name, father_number, mother_name, mother_number, emergency_contact, username, profile_image FROM student";
            $result = mysqli_query($conn, $sql);

            // Check if there are any students
            if (mysqli_num_rows($result) > 0) {
                // Output data of each row
                echo "<table id='studentsTable' class='table table-bordered'>
                    <thead>
                        <tr class='title'>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>DOB</th>
                            <th>Phone No.</th>
                            <th>Father's Name</th>
                            <th>Father's No.</th>
                            <th>Mother's Name</th>
                            <th>Mother's No.</th>
                            <th>Emergency No.</th>
                            <th>Username</th>
                            <th>Profile Image</th>
                        </tr>
                    </thead>
                    <tbody>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['first_name']}</td>
                        <td>{$row['middle_name']}</td>
                        <td>{$row['last_name']}</td>
                        <td>{$row['dob']}</td>
                        <td>{$row['phone_number']}</td>
                        <td>{$row['father_name']}</td>
                        <td>{$row['father_number']}</td>
                        <td>{$row['mother_name']}</td>
                        <td>{$row['mother_number']}</td>
                        <td>{$row['emergency_contact']}</td>
                        <td>{$row['username']}</td>
                        <td><img src='{$row['profile_image']}' alt='Profile Image' class='profile'></td>
                    </tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "<p>No students found</p>";
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>

    <script src="./js/navbar.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable with search functionality
            $('#studentsTable').DataTable({
                "searching": true
            });
        });
    </script>
</body>

</html>