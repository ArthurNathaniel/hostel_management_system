<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Announcement</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/announcement.css">
    <style>

    </style>
</head>

<body>
    <?php include 'student_navbar.php' ?>
    <div class="dashboard_all">
        <h4>Announcement</h4>
        <div class="view_announcements_page">
            <?php
            include 'db.php';

            $result = $conn->query("SELECT * FROM announcements ORDER BY id DESC");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Use htmlspecialchars_decode to decode HTML entities and display images
                    $decodedAnnouncement = htmlspecialchars_decode($row['announcement']);
                    echo "<div class='announcement'>" . $decodedAnnouncement . "</div>";
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

<style>

</style>