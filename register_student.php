<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hostel Management - Register Student</title>
    <link rel="stylesheet" href="./css/base.css" />
  
</head>

<body>
    <div class="page-all">
        <form action="register_process.php" method="post">
            <div class="forms-all">
                <div class="forms-title">
                    <h1>Register Student</h1>
                </div>
                <div class="forms">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" id="first_name" required />
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
                    <label for="parent_name">Parent's Name:</label>
                    <input type="text" name="parent_name" id="parent_name" required />
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
                    <button type="submit" onclick="return validateForm()">Register</button>
                </div>
            </div>
        </form>

        <script>
            function validateForm() {
                // You can add more client-side validation if needed
                var username = document.getElementById('username').value.trim();
                var emergencyContact = document.getElementById('emergency_contact').value.trim();

                // Check if the username or emergency contact is empty
                if (username === '' || emergencyContact === '') {
                    alert('Please fill in all required fields.');
                    return false; // Prevent form submission
                }

                // Check additional conditions if needed

                return true; // Allow form submission
            }
        </script>
    </div>
</body>

</html>