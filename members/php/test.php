<?php
$data = $_POST['imgSrc'];
file_put_contents("../qrcodes/file.png",file_get_contents("data://".$_POST['imgSrc']));
//removing the "data:image/png;base64," part
/*$uri =  substr($data,strpos($data,",")+1);
file_put_contents('wow.png', base64_decode($uri));
if(file_exists('wow.png')){
header("Content-Type: application/force-download");
header('Content-Disposition: attachment; filename="wow.png"');
readfile('wow.png');
}
//echo $_POST['imgSrc'];
*/