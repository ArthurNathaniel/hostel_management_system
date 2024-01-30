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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Student</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/register.css">
</head>

<body>
    <?php include 'sidebar.php' ?>
    <!-- <button id="toggleButton">
        <i class="fa-solid fa-bars-staggered"></i>
    </button> -->

    <div class="register_all">
        <form action="register_process.php" method="post" enctype="multipart/form-data">
            <div class="forms_all">
                <div class="forms-title">
                    <h1>Register Student</h1>
                </div>
                <div class="profile_all">
                    <img id="img-preview" src="./images/profile.jpg" />

                    <label for="file-input" class="label">Upload Image</label>
                    <input accept="image/*" type="file" name="file-input" id="file-input" required />

                </div>

                <div class="forms_grid">
                    <div class="forms">
                        <label for="first_name">First Name:</label>
                        <input type="text" name="first_name" id="first_name" required />
                    </div>
                    <div class="forms">
                        <label for="middle_name">Middle Name:</label>
                        <input type="text" name="middle_name" id="middle_name" />
                    </div>
                    <div class="forms">
                        <label for="last_name">Last Name:</label>
                        <input type="text" name="last_name" id="last_name" required />
                    </div>
                    <div class="forms">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" name="dob" id="dob" required />
                    </div>
                    <div class="forms">
                        <label for="phone_number">Phone Number:</label>
                        <input type="tel" name="phone_number" id="phone_number" required />
                    </div>
                    <div class="forms">
                        <label for="father_name">Father's Name:</label>
                        <input type="text" name="father_name" id="father_name" required />
                    </div>
                    <div class="forms">
                        <label for="father_number">Father's Number:</label>
                        <input type="tel" name="father_number" id="father_number" required />
                    </div>
                    <div class="forms">
                        <label for="mother_name">Mother's Name:</label>
                        <input type="text" name="mother_name" id="mother_name" required />
                    </div>
                    <div class="forms">
                        <label for="mother_number">Mother's Number:</label>
                        <input type="text" name="mother_number" id="mother_number" required />
                    </div>
                    <div class="forms">
                        <label for="emergency_contact">Emergency Contact:</label>
                        <input type="tel" name="emergency_contact" id="emergency_contact" required />
                    </div>

                    <div class="forms">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" required />
                    </div>
                    <div class="forms">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" required />
                    </div>
                    <div class="forms">
                        <button type="submit">Register a student</button>
                    </div>
                </div>
            </div>
        </form>
        <script>
            flatpickr("#dob", {
                dateFormat: "Y-m-d", // Customize the date format if needed
                maxDate: "today" // Optionally set a maximum date (e.g., today)
            });
        </script>

        <script>
            const input = document.getElementById("file-input");
            const image = document.getElementById("img-preview");

            input.addEventListener("change", (e) => {
                if (e.target.files.length) {
                    const src = URL.createObjectURL(e.target.files[0]);
                    image.src = src;
                }
            });
        </script>
        <script src="./js/navbar.js"></script>
    </div>
</body>

</html>