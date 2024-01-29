<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/index.css">

    <!-- Include Typed.js from CDN -->
   
    <!-- Your custom script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Typed.js
            var options = {
                strings: ['Welcome to Hostel Management System'],
                typeSpeed: 50,
                showCursor: false,
            };

            var typed = new Typed('.index_all h1', options);

            // Add Animate.css classes to buttons with delay
            var buttons = document.querySelectorAll('.btns .admin_btn a');
            buttons.forEach(function(button, index) {
                button.style.animationDelay = index * 0.2 + 's'; // 0.2s delay for each button
                button.addEventListener('mouseover', function() {
                    button.classList.add('animate__animated', 'animate__bounce');
                });

                button.addEventListener('mouseout', function() {
                    button.classList.remove('animate__animated', 'animate__bounce');
                });
            });
        });
    </script>
</head>

<body>

    <div class="index_all">
        <h1></h1>

        <div class="btns">
            <div class="admin_btn">
                <a href="login.php">Admin Login</a>
            </div>

            <div class="admin_btn">
                <a href="login_student.php">Student Login</a>
            </div>
        </div>

        <div class="btns">
            <div class="book">
                <a href="book_a_hostel_room.php">Book a hostel room</a>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>
            All Copyright &copy; Reserved
            <script>
                document.write(new Date().getFullYear())
            </script>
            | Hostel Management System
        </p>
    </div>
</body>

</html>