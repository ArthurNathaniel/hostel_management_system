<!-- reset_password.php -->
<?php
require('db.php');

session_start();

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $dob = $_POST['dob'];
    $phone_number = $_POST['phone_number'];

    $stmt = $conn->prepare("SELECT id FROM student WHERE username = ? AND date_of_birth = ? AND phone_number = ?");
    $stmt->bind_param("sss", $username, $dob, $phone_number);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Valid credentials, redirect to password reset page
        $_SESSION['reset_username'] = $username;
        header("Location: reset_password_form.php");
        exit();
    } else {
        $error_message = "Invalid username, date of birth, or phone number.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/login.css" />
</head>

<body>
    <div class="page_all">
        <div class="page_form">
            <form action="" method="post">
                <div class="forms-all">
                    <div class="forms-title">
                        <h1>Forgot Password</h1>
                    </div>
                    <?php if (!empty($error_message)) : ?>
                        <div class="error-message"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    <div class="forms">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" required />
                    </div>
                    <div class="forms">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" name="dob" id="dob" required />
                    </div>
                    <div class="forms">
                        <label for="phone_number">Phone Number:</label>
                        <input type="text" name="phone_number" id="phone_number" required />
                    </div>
                    <div class="forms">
                        <button type="submit">Reset Password</button>
                    </div>
                    <div class="forms">
                        <a href="login.php">Back to Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>