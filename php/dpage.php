<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../img/logo.jpeg" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .navbar {
            padding-top: 1px;
            padding-bottom: 1px;
        }

        .home-button {
            display: flex;
        }

        .home-button i {
            font-size: 50px;
            border-radius: 50%;
            color: #f5f5f5;
            padding: 5px;
        }

        /* Style the account box */
        #account-box a {
            display: block;
            padding: 10px 15px;
            text-align: left;
            color: #333;
            text-decoration: none;
        }

        #account-box a:hover {
            background-color: #f5f5f5;
        }

        /* Center both cards vertically */
        .center-cards {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }

        /* Increase card height and style card icons */
        .card {
            height: 420px;
            /* Adjust the height as needed */
            text-align: center;
        }

        .card-icon {
            font-size: 98px;
            margin: 20px 0;
            color: #007BFF;
            /* Change the color as needed */
        }
    </style>
    <title>Doctor's Page</title>
</head>

<body>
    <nav class="navbar navbar-expand navbar-light bg-primary fixed-top">
        <div class="container">
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
            }
            ?>
            <a class="home-button" href="index.php" id="home" data-toggle="home" aria-haspopup="true"
                aria-expanded="false">
                <i class="fas fa-arrow-alt-circle-left"></i>
            </a>
            <a class="navbar-brand" style="font-size: 25px; font-weight: 600; color: #f5f5f5;" href="#">
                <h2 style="font-weight: 600;">
                    <?php echo "<h1>Welcome Dr. $username!</h1>"; ?>
                </h2>
            </a>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="far fa-user-circle" style="font-size: 50px; border-radius: 50%;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" id="account-box" aria-labelledby="userDropdown">

                        <a class="dropdown-item" href="logout.php">Log Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">

        <div class="center-cards">
            <div class="row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="card">
                        <div class="card-body">
                            <i class="far fa-calendar-alt card-icon"></i>
                            <h5 class="card-title">Manage My Appointments</h5>
                            <p class="card-text">Easily organize and keep track of your medical appointments with our
                                convenient appointment management system.</p>
                            <a href="maincal.php" class="btn btn-primary">Manage Appointments</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <i class="fas fa-qrcode card-icon"></i>
                            <h5 class="card-title">Scan patient's QR code here</h5>
                            <input type="file" id="fileInput" accept="image/*">
                            <p class="card-text">Upload an image containing a QR code to retrieve patient information.
                            </p>
                            <div id="patientName" style="margin-top: 10px; font-size: 20px;"></div>
                            <button id="visitDownloadPage" style="display: none;margin-left:198px;margin-bottom:5px;"
                                class="btn btn-primary">Download Patient's
                                Docs</button>
                            <button id="getQRButton" class="btn btn-primary">Get Patient Name</button>
                            <canvas id="canvas" style="display: none;"></canvas>
                            <hr>
                            <div id="output"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <canvas id="canvas" style="display: none;"></canvas> -->
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
                        // console.log(usernameFromQR);
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
        <script>
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
    </div>
</body>

</html>