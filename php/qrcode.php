<!DOCTYPE html>
<html>

<head>
    <title>QR Code Scanner;</title>
</head>

<body>
    <h1>Scan your QR code here</h1>
    <input type="file" id="fileInput" accept="image/*">
    <button id="getQRButton">Get QR Code</button>
    <canvas id="canvas" style="display: none;"></canvas>
    <div id="output"></div>
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
    <script>
        // Add an event listener to the "Get QR Code" button
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
                    output.innerHTML = `QR Code Data: ${code.data}`;
                } else {
                    output.innerHTML = 'No QR code found.';
                }
            };

            const reader = new FileReader();
            reader.onload = function (e) {
                image.src = e.target.result;
            };
            reader.readAsDataURL(file);

            <?php
            	echo "<a href=`downloads.php?user=${code.data}`>Visit User's Download Page</a>";
            ?>
        }
    </script>
</body>

</html>