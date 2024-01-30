<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Hotel room</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/book_a_hostel_room.css">
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                strings: ['Book a hostel room'],
                typeSpeed: 70,
                showCursor: false,
            };

            var typed = new Typed('.heading h4', options);

            // Hide the full message after 5 seconds with animation
            var fullMessage = document.querySelector('.full_message');
            if (fullMessage) {
                setTimeout(function() {
                    fullMessage.classList.add('hidden');
                }, 5000);
            }
        });
    </script>
</head>

<body>
    <div class="book_a_hostel_room">
        <div class="heading">
            <h4></h4>
        </div>

        <?php
        include 'db.php';
        include 'functions.php';

        // Check if the hostel is full
        $current_bookings = getCurrentBookingsCount();
        $max_capacity = 6; // You can adjust this according to your needs

        if ($current_bookings >= $max_capacity) {
            echo "<p class='full_message'>Sorry, the hostel is full. No more bookings are allowed at the moment.</p>";
        } else {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['name'];
                $room_type = $_POST['room_type'];

                $booking_code = generateBookingCode();

                $sql = "INSERT INTO bookings (name, room_type, booking_code) VALUES ('$name', '$room_type', '$booking_code')";

                if ($conn->query($sql) === TRUE) {
                    echo "Booking successful! Your Booking Code is: $booking_code";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="forms">
                <label for="name">Name:</label>
                <input type="text" name="name" required>
            </div>

            <div class="forms">
                <label for="room_type">Room Type:</label>
                <select name="room_type" required>
                    <option value="single">Single</option>
                    <option value="double">Double</option>
                    <option value="triple">Triple</option>
                </select>
            </div>

            <div class="forms">
                <button type="submit">Book a Room</button>
            </div>
        </form>
    </div>
</body>

</html>