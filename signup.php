<?php
require('db.php');

$error_message = ''; // Initialize the error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the username already exists
    $checkStmt = $conn->prepare("SELECT id FROM admins WHERE username = ?");
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        $error_message = "Username already exists. Please choose a different username.";
    } else {
        // Insert new admin if the username is unique
        $insertStmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
        $insertStmt->bind_param("ss", $username, $password);

        if ($insertStmt->execute()) {
            // Redirect to login.php after successful signup
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Error during registration.";
        }

        $insertStmt->close();
    }

    $checkStmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Sign Up Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/login.css">
    <style>
        .error-message {
            transition: opacity 3s ease;
            /* Add transition effect */
        }
    </style>
    <script>
        // JavaScript to hide the error message after 7 seconds
        setTimeout(function() {
            var errorMessage = document.querySelector('.error-message');
            if (errorMessage) {
                errorMessage.style.opacity = '0'; // Set opacity to 0 for the transition effect
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 3000); // Wait for the transition to complete before hiding
            }
        }, 4000);
    </script>
</head>

<body>
    <div class="page_all">
        <div class="page_swiper">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="./images/slide_one.jpg" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="./images/slide_two.jpg" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="./images/slide_three.jpg" alt="">
                    </div>
                </div>
                <div class="swiper_btn">
                    <div class="swiper-button-next s_btn"></div>
                    <div class="swiper-button-prev s_btn"></div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>
            </div>
        </div>
        <div class="page_form">
            <form action="signup.php" method="post">
                <div class="forms-all">
                    <div class="forms-title">
                        <h1>Admin - Sign Up </h1>
                    </div>
                    <?php if (!empty($error_message)) : ?>
                        <div class="error-message"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    <div class="forms">
                        <label>Username:</label>
                        <input type="text" name="username" placeholder="Enter your username" required />
                    </div>
                    <div class="forms">
                        <label>Password:</label>
                        <input type="password" name="password" placeholder="Enter your password" required />
                    </div>
                    <div class="forms">
                        <button type="submit">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="./js/authentication_swiper.js.js"></script>
</body>


</html>