<?php
require('db.php');

session_start(); // Start the session

$error_message = ''; // Initialize the error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        // Set session variable for successful login
        $_SESSION['authenticated'] = true;

        // Redirect to index.php after successful login
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page - Admin </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/login.css">

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
            <form action="login.php" method="post">
                <div class="forms-all">
                    <div class="forms-title">
                        <h1>Admin - Login Page</h1>
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

    <script>
        // JavaScript to hide the error message after 7 seconds
        setTimeout(function() {
            var errorMessage = document.querySelector('.error-message');
            if (errorMessage) {
                errorMessage.classList.add('hide');
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 3000); // Wait for the transition to complete before hiding
            }
        }, 3000);
    </script>
    <script src="./js/authentication_swiper.js.js"></script>
</body>

</html>