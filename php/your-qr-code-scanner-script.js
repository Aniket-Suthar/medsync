// your-qr-code-scanner-script.js

// When a file is selected, trigger the scanning process
document.getElementById('fileInput').addEventListener('change', function (e) {
    const file = e.target.files[0];

    if (file) {
        scanQRCode(file);
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
}
