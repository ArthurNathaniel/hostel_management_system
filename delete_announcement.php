<?php
session_start(); // Start the session

// Check if the user is not authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Announcement</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/announcement.css">
    <style>
        .announcement button {
            background-color: red;
            border: none;
            padding: 15px 45px;
            color: #fff;
            border-radius: 30px;
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php' ?>
    <div class="dashboard_all">
        <h4>Delete Announcement</h4>
        <div class="delete_announcement_page">

            <?php
            include 'db.php';

            // Check if the form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['announcement_id'])) {
                $announcement_id = $_POST['announcement_id'];

                // Use prepared statement to prevent SQL injection
                $stmt = $conn->prepare("DELETE FROM announcements WHERE id = ?");
                $stmt->bind_param("i", $announcement_id);

                if ($stmt->execute()) {
                    echo "Announcement deleted successfully!";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            }

            // Fetch and display existing announcements
            $result = $conn->query("SELECT * FROM announcements ORDER BY id DESC");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='announcement'>";
                    echo $row['announcement'];
                    echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' onsubmit='return confirm(\"Are you sure you want to delete this announcement?\");'>";
                    echo "<input type='hidden' name='announcement_id' value='" . $row['id'] . "'/>";
                    echo "<button type='submit'> <i class='fas fa-trash-alt'></i> | Delete</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "No announcements available.";
            }

            $conn->close();
            ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="./js/navbar.js"></script>
</body>

</html>