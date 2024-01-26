<!-- logout_student.php -->
<?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the student login page
header("Location:index.php");
exit();
?>