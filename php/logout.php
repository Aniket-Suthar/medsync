<?php
// Start a session (this should be at the top of every PHP file that uses sessions)
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Unset the session variables
    session_unset();

    // Destroy the session
    session_destroy();
}

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="../img/logo.jpeg" type="image/x-icon">
    <title>Logout</title>
</head>

<body>
    <form action="" method="post">
        <input type="submit" value="Logout">
    </form>
    <script>
        // Display a "Logged out Successfully" message
        alert('Logged out Successfully');

        // Redirect the user to the login page or any other desired page
        window.location.href = "LoginPage.php";
    </script>
</body>

</html>