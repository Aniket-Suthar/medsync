<?php
// Include your database connection file if not already included
include '../config/db_connection.php'; // Update this with your actual database connection file

$username = $email = ""; // Initialize username, email, and role variables

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        // Retrieve user input from the form
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm_password"];


        // You should perform input validation and sanitization here.

        // Check if the passwords match
        if ($password !== $confirmPassword) {
            echo "Passwords do not match. Please try again.";
        } else {
            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Create a SQL query to insert the user data into the database
            $sql = "INSERT INTO pdata (username, email, password) VALUES (?, ?, ?)";

            // Prepare the SQL statement
            $stmt = $conn->prepare($sql);

            // Bind the parameters and execute the query
            $stmt->bind_param("sss", $username, $email, $hashedPassword);

            if ($stmt->execute()) {
                // Registration successful
                echo "Registration successful. You can now log in.";
                header("Location: LoginPage.php");
            } else {
                // Registration failed
                echo "Error: " . $stmt->error;
            }

            // Close the statement and database connection
            $stmt->close();
            $conn->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp </title>
    <link rel="shortcut icon" href="../img/logo.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="form-container sign-up">
            <form action="" method="post" id="signupForm">
                <h2>sign up</h2>
                <div class="form-group">
                    <input type="text" required>
                    <label for="">username</label>
                    <i class="fas fa-user"></i>
                </div>
                <div class="form-group">
                    <input type="email" required>
                    <label for="">email</label>
                    <i class="fas fa-at"></i>
                </div>
                <div class="form-group">
                    <input type="password" required>
                    <label for="">password</label>
                    <i class="fas fa-lock"></i>
                </div>
                <div class="form-group">
                    <input type="password" required>
                    <label for="">confirm password</label>
                    <i class="fas fa-lock"></i>
                </div>
                <button type="submit" class="btn">sign up</button>
                <div class="link">
                    <p>You already have an account?<a href="LoginPage.php" > sign in</a></p>
                </div>
            </form>
        </div>
        <div class="image-section">
            <!-- <img src="../img/loginpic-removebg-preview.png" alt="Your Image"> -->
        </div>
</body>
</html>