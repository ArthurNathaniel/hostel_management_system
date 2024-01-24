<!-- login_student_process.php -->
<?php
require('db.php');

session_start(); // Start the session

$error_message = ''; // Initialize the error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM students WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($student_id, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        // Set session variable for successful login
        $_SESSION['student_id'] = $student_id;

        // Redirect to student profile page after successful login
        header("Location: student_profile.php");
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
    <title>Student Login</title>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/login.css" />
</head>

<body>
    <div class="page-all">
        <form action="" method="post">
            <div class="forms-all">
                <div class="forms-title">
                    <h1>Student Login</h1>
                </div>
                <?php if (!empty($error_message)) : ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <div class="forms">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required />
                </div>
                <div class="forms">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required />
                </div>
                <div class="forms">
                    <button type="submit">Login</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>