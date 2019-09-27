<?php
require ('dbconnect.php');

//echo "hello world";
//$json = file_get_contents('php://input');

//decode the recceived JSON data and store as an object file into $obj
//$obj = json_decode($json, true);

//store qrcode url as $qrcode
$qrcodenumber = $_POST['attendance'];

//check if the qrcode number exist in our database
/*if($stmt = $con->prepare('SELECT fname, lname, oname FROM members WHERE id = ? ')){
    $stmt->bind_param('s', $qrcodenumber);
    $stmt->execute();
    //store result obtained from the query and check if there exists any qrcode
    $stmt->store_result();
    if($stmt->num_rows > 0) {
        $stmt->bind_result($fname, $lname, $oname);
        $stmt->fetch();

        $member_info = array(
            'fname' => $fname,
            'lname' => $lname,
            'oname' => $oname,
        );
        echo json_encode($member_info, JSON_PRETTY_PRINT);
    }
    else {
        echo json_encode("Not available");
    }

}
*/
echo json_encode("success");

?>