<?php
require '../phpqrcode/qrlib.php';

$codeString = $_POST['codeString'];

$PNG_TEMP_DIR = 'temp/';
if (!file_exists($PNG_TEMP_DIR))
    mkdir($PNG_TEMP_DIR);

$filename = $PNG_TEMP_DIR . 'test' . md5($codeString) . '.png';

QRcode::png($codeString, $filename);
echo '<img src="' . $filename . '" />';
?>