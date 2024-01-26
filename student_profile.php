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
$stmt = $conn->prepare("SELECT first_name, middle_name, last_name, dob, phone_number, father_name, father_number, mother_name, mother_number, emergency_contact, username, profile_image FROM student WHERE id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$stmt->bind_result($first_name, $middle_name, $last_name, $dob, $phone_number, $father_name, $father_number, $mother_name, $mother_number, $emergency_contact, $username, $profile_image);
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
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/student_profile.css">
</head>

<body>
    <?php include 'student_navbar.php' ?>
    <div class="student_profile_all">
        <h1>Welcome, <?php echo $first_name; ?>! to your Hostel Portal</h1>
        <div class="profile_image">
            <img src="<?php echo $profile_image; ?>" alt="Profile Image">
        </div>
        <div class="profile_grid">
            <div class="profile">
                <h4>First Name: </h4>
                <p>
                    <?php echo $first_name; ?>
                </p>
            </div>
            <div class="profile">
                <h4> Middle Name: </h4>
                <p><?php echo $middle_name; ?></p>
            </div>
            <div class="profile">
                <h4>Last Name:</h4>
                <p> <?php echo $last_name; ?></p>
            </div>
            <div class="profile">
                <h4>Date of Birth:</h4>
                <p> <?php echo $dob; ?></p>
            </div>
            <div class="profile">
                <h4>Phone Number:</h4>
                <p> <?php echo $phone_number; ?></p>
            </div>
            <div class="profile">
                <h4>Father's Name:</h4>
                <p> <?php echo $father_name; ?></p>
            </div>
            <div class="profile">
                <h4>Father's Number:</h4>
                <p> <?php echo $father_number; ?></p>
            </div>
            <div class="profile">
                <h4>Mother's Name:</h4>
                <p> <?php echo $mother_name; ?></p>
            </div>
            <div class="profile">
                <h4>Mother's Number:</h4>
                <p> <?php echo $mother_number; ?></p>
            </div>
            <div class="profile">
                <h4>Emergency Contact:</h4>
                <p> <?php echo $emergency_contact; ?></p>
            </div>
        </div>


        <!-- <p>Last Name: <?php echo $last_name; ?></p>
        <p>Date of Birth: <?php echo $dob; ?></p>
        <p>Phone Number: <?php echo $phone_number; ?></p>
        <p>Father's Name: <?php echo $father_name; ?></p>
        <p>Father's Number: <?php echo $father_number; ?></p>
        <p>Mother's Name: <?php echo $mother_name; ?></p>
        <p>Mother's Number: <?php echo $mother_number; ?></p>
        <p>Emergency Contact: <?php echo $emergency_contact; ?></p> -->


    </div>
    <script src="./js/navbar.js"></script>
    <style>
        
    </style>
</body>

</html>