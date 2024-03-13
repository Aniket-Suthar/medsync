<?php
$host = "localhost"; 
$username = "root"; 
$password = "apsn8xb6e"; 
$database = "records"; 

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8 (optional)
$conn->set_charset("utf8");

// $conn->close();
?>
