<?php
require ('dbconnect.php');

//echo "hello world";
$json = file_get_contents('php://input');

//decode the recceived JSON data and store as an object file into $obj
$obj = json_decode($json, true);

//store qrcode url as $qrcode
$qrcodenumber = $obj['qrcodeno'];


?>