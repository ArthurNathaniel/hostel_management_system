<!-- student_profile.php -->
<?php
require('db.php');

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: login_student.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Retrieve data from the 'student' table based on the correct table name
$stmt = $conn->prepare("SELECT first_name, last_name, dob, phone_number, father_name, father_number, mother_name, mother_number, emergency_contact, username, profile_image FROM student WHERE id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $dob, $phone_number, $father_name, $father_number, $mother_name, $mother_number, $emergency_contact, $username, $profile_image);
$stmt->fetch();
$stmt->close();

// Display user data in the HTML page
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Profile</title>
    <!-- Add your CSS stylesheets or links here -->
</head>

<body>
    <h1>Welcome, <?php echo $username; ?>!</h1>
    <p>First Name: <?php echo $first_name; ?></p>
    <p>Last Name: <?php echo $last_name; ?></p>
    <p>Date of Birth: <?php echo $dob; ?></p>
    <p>Phone Number: <?php echo $phone_number; ?></p>
    <p>Father's Name: <?php echo $father_name; ?></p>
    <p>Father's Number: <?php echo $father_number; ?></p>
    <p>Mother's Name: <?php echo $mother_name; ?></p>
    <p>Mother's Number: <?php echo $mother_number; ?></p>
    <p>Emergency Contact: <?php echo $emergency_contact; ?></p>
    <p>Profile Image: <img src="<?php echo $profile_image; ?>" alt="Profile Image"></p>

    <!-- Add other profile details as needed -->

    <!-- Add your HTML and styling for the profile page -->
    <style>
        img{
            width: 300px;
            height: 300px;
            object-fit: cover;
        }
    </style>
</body>

</html>