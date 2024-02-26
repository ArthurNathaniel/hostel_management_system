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
    <title>Admin - Make Announcement</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/announcement.css">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        #editor {
            height: 300px;
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php' ?>
    <div class="dashboard_all">
        <h4>Make Announcement</h4>

        <div class="admin_page">
            <?php
            include 'db.php';

            // Function to check and reconnect if the MySQL connection is lost
            function checkAndReconnect($conn)
            {
                if (!$conn->ping()) {
                    $conn->close();
                    include 'db.php'; // Re-establish the connection
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $announcement = trim($_POST['announcement']);

                if (empty($announcement)) {
                    // echo '<p style="color: red;">Error: Announcement cannot be empty.</p>';
                    echo "<script>alert('Error: Announcement cannot be empty.');</script>";

                } else {
                    try {
                        checkAndReconnect($conn); // Check and reconnect if needed

                        // Use prepared statement to prevent SQL injection
                        $stmt = $conn->prepare("INSERT INTO announcements (announcement) VALUES (?)");
                        $stmt->bind_param("s", $announcement);

                        if ($stmt->execute()) {
                            // echo "Announcement added successfully!";
                            echo "<script>alert('Announcement added successfully!');</script>";

                        } else {
                            echo "Error: " . $stmt->error;
                        }

                        $stmt->close();
                    } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }
            }
            ?>

            <form id="announcementForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateAndSubmit()">
                <div class="forms">
                    <label for="announcement">Announcement:</label>
                    <!-- Quill editor container -->
                    <div id="editor"></div>
                    <!-- Hidden input field to store the Quill editor content -->
                    <input type="hidden" name="announcement" id="hidden_announcement" required>
                </div>

                <div class="forms">
                    <button type="submit">Add Announcement</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['link', 'image'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        ['clean']
                    ]
                }
            });

            document.getElementById('announcementForm').addEventListener('submit', function(event) {
                var announcementContent = quill.root.textContent.trim();

                if (announcementContent === '') {
                    alert('Error: Announcement cannot be empty.');
                    event.preventDefault(); // Prevent form submission
                } else {
                    // Set the value of the hidden input field
                    document.querySelector('#hidden_announcement').value = announcementContent;
                }
            });
        });
    </script>






    <script src="./js/navbar.js"></script>
    <?php include 'footer.php'; ?>
</body>

</html>