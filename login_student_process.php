<!-- login_student_process.php -->
<?php
require('db.php');

session_start(); // Start the session

$error_message = ''; // Initialize the error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM students WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($student_id, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        // Set session variable for successful login
        $_SESSION['student_id'] = $student_id;

        // Redirect to student profile page after successful login
        header("Location: student_profile.php");
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>