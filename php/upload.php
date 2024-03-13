<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir = "uploads/"; // Change this to the desired directory for uploaded files
        $original_filename = basename($_FILES["file"]["name"]);
        $file_extension = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));

        // Check if the file is allowed (you can modify this to allow specific file types)
        $allowed_types = array("jpg", "jpeg", "png", "pdf");
        if (!in_array($file_extension, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG, and PDF files are allowed.";
        } else {
            // Generate a unique filename
            $unique_filename = uniqid() . '.' . $file_extension;
            $target_file = $target_dir . $unique_filename;

            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // File upload success, now store information in the database
                $filename = $original_filename;
                $filesize = $_FILES["file"]["size"];
                $filetype = $_FILES["file"]["type"];

                // Database connection
                include '../config/db_connection.php';

                // Start a session to access user information
                session_start();

                // Retrieve the user's ID from the session
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];

                    // Insert the file information into the database
                    $sql = "INSERT INTO files (user_id, filename, filesize, filetype) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("isss", $user_id, $filename, $filesize, $filetype);

                    if ($stmt->execute()) {
                        echo "The file $original_filename has been uploaded and the information has been stored in the database.";
                        
                        // Redirect to the homepage or any other authorized page
                        header("Location: download.php");
                        exit();
                    } else {
                        echo "Sorry, there was an error storing file information in the database: " . $conn->error;
                    }

                    $stmt->close();
                } else {
                    echo "User not authenticated. Please log in and try again.";
                }
                
                $conn->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file was uploaded.";
    }
}
?>


