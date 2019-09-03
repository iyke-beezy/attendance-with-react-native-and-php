<?php
session_start();
$data = $_POST['imgSrc'];
$filename = $_SESSION['qrcode_id'];
//save qrcode to qrcodes 
if(file_put_contents("../qrcodes/$filename.png",file_get_contents("data://".$_POST['imgSrc']))) {
    header('Location: ../../profile.php');
    $_SESSION[loggedin] = TRUE;
}

?>