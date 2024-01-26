<!-- reset_password_form.php -->
<?php
session_start();

if (empty($_SESSION['reset_username'])) {
    // Redirect to the reset password page if session is not set
    header("Location: reset_password.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update the student's password in the database
    $new_password = $_POST['new_password'];
    $reset_username = $_SESSION['reset_username'];

    // Add necessary logic to update the password in the database
    // ...

    // Clear the session variable
    unset($_SESSION['reset_username']);

    echo "Password reset successfully! Redirect to login page.";
    // Add logic to redirect to the login page
    // ...
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
                        <h1>Reset Password</h1>
                    </div>
                    <div class="forms">
                        <label for="new_password">New Password:</label>
                        <input type="password" name="new_password" id="new_password" required />
                    </div>
                    <div class="forms">
                        <button type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>