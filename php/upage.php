<!-- PHP code for handling file uploads -->
<?php
include "../phpqrcode/qrlib.php";
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page
    echo "<p>YOU ARE NOT LOGGED IN</p>";
    echo '<a href="LoginPage.php" class="btn btn-primary">Login</a>';
    exit();
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // echo "<h1>Welcome, $username!</h1>";
    // echo "<hr>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../css/upage.css">
    <link rel="shortcut icon" href="../img/logo.jpeg" type="image/x-icon">
    <title>User Page</title>
</head>

<body>
    <nav class="navbar navbar-expand navbar-light bg-primary fixed-top">
        <div class="container">
            <a class="home-button" href="index.php" id="home" data-toggle="home" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-arrow-alt-circle-left"></i>
            </a>
            <a class="navbar-brand" style="font-size: 25px; font-weight: 600; color: #f5f5f5;" href="#">
                <h2 style="font-weight: 600;">
                    <?php echo "<h1>Welcome, $username!</h1>"; ?>
                </h2>
            </a>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="far fa-user-circle" style="font-size: 50px; border-radius: 50%;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" id="account-box" aria-labelledby="userDropdown">
                        <a class="dropdown-item" name="generate_qr" value="Generate QR Code"
                            onclick="generateQRCode('<?php echo $username; ?>');">Generate QR Code</a>
                        <a class "dropdown-item" href="logout.php">Log Out</a>
                        <div id="qrcode"></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    </nav>
    <div class="container ">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">

                <div class="upload-container" id="upload-container">
                    <h2 style="text-align: center;margin-top:10px">Upload Your MedicalFile</h2>
                    <div class="upload-area" id="upload-area">
                        <p> Click to select (PDF, DOC, or images)</p>
                        <input type="file" name="file" id="file-input" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                            style="text-align:center; padding: 45px; padding-left: 110px;">
                    </div>
                </div>
            </div>
            <div class="buttongrp" style="display: flex; justify-content: center;margin-top:-45px;">
                <button type="submit" name="submit" class="btn btn-success">Upload
                    File</button>
        </form>
    </div>
    <a style="display: flex; justify-content: center;margin-top:10px;" href="download.php"><button
            class="btn btn-primary">View My Files</button></a>

    <script>
        function generateQRCode(username) {
            const codeString = username;
            $.ajax({
                type: "POST",
                url: "generate_qr.php",
                data: { codeString: codeString },
                success: function (data) {
                    $("#qrcode").html(data);
                }
            });
        }
        const uploadArea = document.getElementById('upload-area');
        const fileInput = document.getElementById('file-input');
        const preview = document.getElementById('preview');

        // Prevent default behavior for drag-and-drop events
        uploadArea.addEventListener('dragenter', preventDefaults, false);
        uploadArea.addEventListener('dragleave', preventDefaults, false);
        uploadArea.addEventListener('dragover', preventDefaults, false);
        uploadArea.addEventListener('drop', preventDefaults, false);

        // Highlight the upload area on dragover
        uploadArea.addEventListener('dragover', highlight, false);

        // Unhighlight the upload area on dragleave
        uploadArea.addEventListener('dragleave', unhighlight, false);

        // Handle the dropped files
        uploadArea.addEventListener('drop', handleDrop, false);

        // Handle file selection when clicking on the upload area
        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });



        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight() {
            uploadArea.classList.add('highlight');
        }

        function unhighlight() {
            uploadArea.classList.remove('highlight');
        }

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
        }

        document.addEventListener("DOMContentLoaded", function () {
            const userLogo = document.querySelector(".nav-link");
            const accountBox = document.getElementById("account-box");

            userLogo.addEventListener("click", function (event) {
                event.preventDefault();
                if (accountBox.style.display === "block") {
                    accountBox.style.display = "none";
                } else {
                    accountBox.style.display = "block";
                }
            });
        });

    </script>
</body>

</html>