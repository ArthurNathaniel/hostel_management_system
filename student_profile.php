<!-- student_profile.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Profile</title>
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <div class="page-all">
        <div class="forms-all">
            <div class="forms-title">
                <h1>Student Profile</h1>
            </div>
            <div class="profile-info">
                <?php
                // Retrieve and display student details
                require('db.php');
                session_start();

                if (isset($_SESSION['student_id'])) {
                    $student_id = $_SESSION['student_id'];

                    $stmt = $conn->prepare("SELECT first_name, last_name, dob, parent_name, emergency_contact, username FROM students WHERE id = ?");
                    $stmt->bind_param("i", $student_id);
                    $stmt->execute();
                    $stmt->bind_result($first_name, $last_name, $dob, $parent_name, $emergency_contact, $username);
                    $stmt->fetch();

                    echo "<p><strong>Name:</strong> $first_name $last_name</p>";
                    echo "<p><strong>Date of Birth:</strong> $dob</p>";
                    echo "<p><strong>Parent's Name:</strong> $parent_name</p>";
                    echo "<p><strong>Emergency Contact:</strong> $emergency_contact</p>";
                    echo "<p><strong>Username:</strong> $username</p>";

                    $stmt->close();
                } else {
                    echo "Session not set. Please log in.";
                }

                $conn->close();
                ?>
            </div>
            <div class="forms">
                <a href="logout_student.php">Logout</a>
            </div>
        </div>
    </div>
</body>

</html>