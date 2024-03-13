<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Doctor's Page</title>
</head>

<body>
    <div class="container mt-5">
        <?php
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
            echo "<h1>Welcome Dr. $username!</h1>";
            echo "<hr>";
        }
        ?>
        <a href="maincal.php"><button class="btn btn-primary">Book Appointment</button></a>
        <h1>Scan your QR code here</h1>
        <input type="file" id="fileInput" accept="image/*">
        <button id="getQRButton" class="btn btn-primary">Get Patient Name</button>
        <div id="patientName" style="margin-top: 10px; font-size: 20px;"></div>
        <button id="visitDownloadPage" style="display: none;" class="btn btn-primary">Visit Download Page</button>
        <canvas id="canvas" style="display: none;"></canvas>
        <div id="output"></div>
        <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
        <script>
            document.getElementById('getQRButton').addEventListener('click', function () {
                const fileInput = document.getElementById('fileInput');
                const file = fileInput.files[0];

                if (file) {
                    scanQRCode(file);
                } else {
                    alert("Please select an image containing a QR code.");
                }
            });

            function scanQRCode(file) {
                const canvas = document.getElementById('canvas');
                const output = document.getElementById('output');
                const ctx = canvas.getContext('2d');

                const image = new Image();
                image.onload = function () {
                    canvas.width = image.width;
                    canvas.height = image.height;
                    ctx.drawImage(image, 0, 0);

                    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                    const code = jsQR(imageData.data, imageData.width, imageData.height);

                    if (code) {
                        const usernameFromQR = code.data;

                        // Display the patient's name
                        output.innerHTML = 'Patient Name is: ' + usernameFromQR;

                        // Show the "Visit Download Page" button
                        document.getElementById('visitDownloadPage').style.display = 'block';

                        // Set the button's click event to redirect to the download page
                        document.getElementById('visitDownloadPage').addEventListener('click', function () {
                            // Send an AJAX request to retrieve the user's ID from pdata
                            $.ajax({
                                type: "POST",
                                url: "getUserId.php",
                                data: { username: usernameFromQR },
                                success: function (response) {
                                    if (response.error) {
                                        output.innerHTML = response.error;
                                    } else {
                                        const userId = response.userId;
                                        window.location.href = "download.php?user_id=" + userId;
                                    }
                                }
                            });
                        });
                    } else {
                        output.innerHTML = 'No QR code found.';
                    }
                };

                const reader = new FileReader();
                reader.onload = function (e) {
                    image.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        </script>
    </div>
</body>

</html>
