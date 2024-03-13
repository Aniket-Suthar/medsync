<?php
// Include your database connection file
include '../config/db_connection.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: LoginPage.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the "Remove" button was clicked
if (isset($_POST['remove'])) {
    $file_id = $_POST['file_id'];

    // Fetch the file details from the database
    $sql = "SELECT filename FROM files WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $file_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filename = $row['filename'];

        // Remove the file from the database
        $delete_sql = "DELETE FROM files WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $file_id);
        if ($delete_stmt->execute()) {
            // Delete the file from the server (if it exists in the "uploads" directory)
            $file_path = "uploads/" . $filename;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }
}

// Fetch files uploaded by the current user
$sql = "SELECT * FROM files WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uploaded files</title>
    <link rel="shortcut icon" href="../img/logo.jpeg" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Uploaded Files</h2>
        <h3><?php echo `Welcome ${username}` ?></h3>
        <!-- Add the "Generate QR Code" button -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>File Size</th>
                    <th>File Type</th>
                    <th>Download</th>
                    <th>Remove</th> <!-- Add the Remove column -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $file_path = "uploads/" . $row['filename'];
                        $file_id = $row['id'];
                        ?>
                        <tr>
                            <td>
                                <?php echo $row['filename']; ?>
                            </td>
                            <td>
                                <?php echo $row['filesize']; ?> bytes
                            </td>
                            <td>
                                <?php echo $row['filetype']; ?>
                            </td>
                            <td><a href="<?php echo $file_path; ?>" class="btn btn-primary" download>Download</a></td>
                            <td>
                                <!-- Add a Remove button with a form -->
                                <form method="post" action="">
                                    <input type="hidden" name="file_id" value="<?php echo $file_id; ?>">
                                    <input type="submit" name="remove" value="Remove" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5">No files uploaded yet.</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <a href="logout.php" class="btn btn-primary">Logout</a>
    </div>
</body>

</html>