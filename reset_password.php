<!-- reset_password.php -->
<?php
require('db.php');
session_start();

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $student_id = $_SESSION['reset_student_id'];

    $stmt = $conn->prepare("UPDATE student SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $hashed_password, $student_id);
    $stmt->execute();

    // Redirect to the login page after password reset
    header("Location: login_student.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reset Password</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/login.css" />
</head>

<body>
    <!-- Add your body content here -->
    <form action="" method="post">
        <div class="forms-all">
            <div class="forms-title">
                <h1>Reset Password</h1>
            </div>
            <?php if (!empty($error_message)) : ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <div class="forms">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required />
            </div>
            <div class="forms">
                <button type="submit">Reset Password</button>
            </div>
        </div>
    </form>
</body>

</html>