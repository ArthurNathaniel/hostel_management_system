<!-- forget_password.php -->
<?php
require('db.php');
session_start();

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $phone_number = $_POST['phone_number'];

    $stmt = $conn->prepare("SELECT id, phone_number FROM student WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($student_id, $db_phone_number);
    $stmt->fetch();

    if ($db_phone_number == $phone_number) {
        // Phone number is correct
        $_SESSION['reset_student_id'] = $student_id; // Store student ID for password reset

        // Redirect to the password reset page
        header("Location: reset_password.php");
        exit();
    } else {
        $error_message = "Invalid username or phone number.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Forgot Password</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/login.css" />
</head>

<body>
    <!-- Add your body content here -->
    <form action="" method="post">
        <div class="forms-all">
            <div class="forms-title">
                <h1>Forget Password</h1>
            </div>
            <?php if (!empty($error_message)) : ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <div class="forms">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required />
            </div>
            <div class="forms">
                <label for="phone_number">Phone Number:</label>
                <input type="text" name="phone_number" id="phone_number" required />
            </div>
            <div class="forms">
                <button     type="submit">Submit</button>
            </div>
        </div>
    </form>
</body>

</html>