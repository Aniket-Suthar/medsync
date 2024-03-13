<?php
// Include your database connection file if not already included
include '../config/db_connection.php';

// Start a session (this should be at the top of every PHP file that uses sessions)
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // You should perform input validation and sanitization here.

    // Query the pdata table to check if the username exists and retrieve the role
    $checkPdataQuery = "SELECT id, username, password FROM pdata WHERE username = ?";
    $stmt = $conn->prepare($checkPdataQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Login successful for pdata user

            // Set up a session for the user
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $username;

            header("Location: upage.php"); // Redirect to pdata home page
            exit();
        }
    }

    // If the user is not found in pdata, check in ddata
    $checkDdataQuery = "SELECT id, username, password FROM ddata WHERE username = ?";
    $stmt = $conn->prepare($checkDdataQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Login successful for ddata user

            // Set up a session for the user
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $username;

            header("Location:dpage.php"); // Redirect to ddata home page
            exit();
        }
    }

    // If no match is found in either table
    echo "Login failed. User not found or incorrect password.";

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../img/logo.jpeg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Sign in & Sign up</title>
</head>

<body>
    <div class="wrapper">
        <div class="form-container sign-in">
            <form action="" method="POST">
                <h2>login</h2>
                <div class="form-group">
                    <input type="text" name="username" required>
                    <i class="fas fa-user"></i>
                    <label for="">username</label>
                </div>
                <div class="form-group">
                    <input type="password" name="password" required>
                    <i class="fas fa-lock"></i>
                    <label for="">password</label>
                </div>
                <div class="forgot-pass">
                    <a href="SignUpPageUser.php">forgot password?</a>
                </div>
                <button type="submit" name="submit"class="btn">login</button>
                <div class="link">
                    <p>Don't have an account?<a href="SignUpPageUser.php"> sign up</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
    <script src="https://kit.fontawesome.com/9e5ba2e3f5.js" crossorigin="anonymous"></script>
    <script src="../js/main.js"></script>
</body>

</html>