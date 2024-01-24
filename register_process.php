<?php
require('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $parent_name = $_POST['parent_name'];
    $emergency_contact = $_POST['emergency_contact'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the student with the provided information already exists
    $checkStmt = $conn->prepare("SELECT id FROM students WHERE first_name = ? AND last_name = ? AND dob = ? AND parent_name = ? AND emergency_contact = ?");
    $checkStmt->bind_param("sssss", $first_name, $last_name, $dob, $parent_name, $emergency_contact);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        // Display JavaScript alert for existing student and redirect to registration page
        echo "<script>alert('Student with the provided information already registered. Click OK to go back to registration.'); window.location.href='register_student.php';</script>";
    } else {
        // Insert new student if the student is not already registered
        $insertStmt = $conn->prepare("INSERT INTO students (first_name, last_name, dob, parent_name, emergency_contact, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insertStmt->bind_param("sssssss", $first_name, $last_name, $dob, $parent_name, $emergency_contact, $username, $password);

        if ($insertStmt->execute()) {
            // Display JavaScript alert for successful registration
            echo "<script>alert('Student registered successfully. Click OK to login as a student.'); window.location.href='login_student.php';</script>";
        } else {
            // Display JavaScript alert for registration error
            echo "<script>alert('Error during registration.');</script>";
        }

        $insertStmt->close();
    }

    $checkStmt->close();
}

$conn->close();
