<?php
include 'db.php';
session_start(); // Start the session

// Assuming you have a session for authentication
// Make sure the student is logged in before proceeding
if (!isset($_SESSION['student_id'])) {
    // Redirect to login page or handle authentication
    header("Location: login.php");
    exit();
}

$form_submitted = false; // Variable to track form submission

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form_submitted = true; // Set the form_submitted flag
    $student_id = $_SESSION['student_id'];
    $issue_description = $conn->real_escape_string($_POST['issue_description']);

    // Use prepared statement to prevent SQL injection
    $insert_query = $conn->prepare("INSERT INTO reported_issues (student_id, issue_description) VALUES (?, ?)");
    $insert_query->bind_param("is", $student_id, $issue_description);

    if ($insert_query->execute()) {
        $success_message = "Issue reported successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }

    $insert_query->close(); // Close the prepared statement
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Issue</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/report.css">
</head>

<body>
    <?php include 'student_navbar.php' ?>
    <div class="reports_all">
        <div class="forms">
            <h2>Report Issue</h2>
        </div>
        <?php
        // Display success or error message here only if the form is submitted
        if ($form_submitted) {
            if (isset($success_message)) {
                echo "<p class='success-message'>$success_message</p>";
            } elseif (isset($error_message)) {
                echo "<p class='error-message'>$error_message</p>";
            }
        }
        ?>
        <form method="post" action="report_issue.php">
            <!-- You can include other necessary form fields -->
            <div class="forms">
                <label for="issue_description">Issue Description:</label>
                <textarea name="issue_description" required></textarea>
            </div>

            <div class="forms">
                <input type="submit" id="submitBtn" value="Submit Issue">
            </div>
        </form>
    </div>
    <script src="./js/navbar.js"></script>
    <script>
        function onSubmit() {
            // Disable the submit button to prevent multiple submissions
            document.getElementById("submitBtn").disabled = true;
            // Change the text of the submit button to indicate "Please wait..."
            document.getElementById("submitBtn").value = "Please wait...";
        }
    </script>
</body>

</html>