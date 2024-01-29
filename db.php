<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel_management";

// $servername = "nathstack.tech";
// $username = "u500921674_hostel";
// $password = "OnGod@123";
// $dbname = "u500921674_hostel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
