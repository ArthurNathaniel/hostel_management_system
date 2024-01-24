<?php
// Include your database connection file
include 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $middle_name = mysqli_real_escape_string($conn, $_POST['middle_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $dob = $_POST['dob']; // Assuming you trust the input as a date type
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $father_name = mysqli_real_escape_string($conn, $_POST['father_name']);
    $father_number = mysqli_real_escape_string($conn, $_POST['father_number']);
    $mother_name = mysqli_real_escape_string($conn, $_POST['mother_name']);
    $mother_number = mysqli_real_escape_string($conn, $_POST['mother_number']);
    $emergency_contact = mysqli_real_escape_string($conn, $_POST['emergency_contact']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security

    // Upload profile image
    $image_path = './images/profile.jpg'; // Default image path
    if ($_FILES['file-input']['error'] == 0) {
        $target_dir = './uploads/';
        $target_file = $target_dir . basename($_FILES['file-input']['name']);
        move_uploaded_file($_FILES['file-input']['tmp_name'], $target_file);
        $image_path = $target_file;
    }

    // Check if the username is already registered
    $check_username_query = "SELECT * FROM student WHERE username = '$username'";
    $result = mysqli_query($conn, $check_username_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Error: This username is already registered.'); window.location.href = 'register_student.php';</script>";
    } else {
        // SQL query to insert data into the "student" table
        $insert_query = "INSERT INTO student (first_name, middle_name, last_name, dob, phone_number, father_name, father_number, mother_name, mother_number, emergency_contact, username, password, profile_image)
                        VALUES ('$first_name', '$middle_name', '$last_name', '$dob', '$phone_number', '$father_name', '$father_number', '$mother_name', '$mother_number', '$emergency_contact', '$username', '$password', '$image_path')";

        // Execute the query
        if (mysqli_query($conn, $insert_query)) {
            echo "<script>alert('Student registered successfully!'); window.location.href = 'register_student.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href = 'register_student.php';</script>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
