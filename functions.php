<?php
function getCurrentBookingsCount()
{
    include 'db.php';

    $result = $conn->query("SELECT COUNT(*) as count FROM bookings");
    $row = $result->fetch_assoc();

    return $row['count'];
}

function generateBookingCode()
{
    // Generate a random and unique booking code
    return strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));
}
