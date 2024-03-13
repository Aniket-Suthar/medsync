<?php
// Include your database connection file
include '../config/db_connection.php';

// Start a session (this should be at the top of every PHP file that uses sessions)
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: LoginPage.php");
    exit();
}

// Get the username from the session
$username = $_SESSION['username'];

// Query the pdata table to retrieve the user's ID based on the username
$query = "SELECT id FROM pdata WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $userId = $row['id'];
    echo "User ID: " . $userId;
} else {
    echo "User not found.";
}

$stmt->close();
$conn->close();
?>
