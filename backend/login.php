<?php
require ('dbconnect.php');

//echo "hello world";
$json = file_get_contents('php://input');

//decode the recceived JSON data and store as an object file into $obj
$obj = json_decode($json, true);

//store username in $obj into $username
$username = $obj['username'];

//store password in $obj into $password
$password = $obj['password'];

//check if username and password fields are both empty using a prepare statement to prevent sql injection
if($username != '' && $password != '') {
    $que = $con->prepare("SELECT password from users WHERE username = ?");
    $que->bind_param('s', $username);
    $que->execute();
    $que->store_result();

    //check if the credentials exist in the database
    if($que->num_rows > 0) {
        $que->bind_result($ori_password);
        $que->fetch();

        //verify the password using password_verify. NB: It only works if the passwords were encrypted during registration using password_hash
        if(password_verify($password, $ori_password)) {
            //verification success user can now log in.
            echo json_encode("Login Succesful!");
        }
        else {
            echo json_encode("Incorrect Password!");
        }
    } else {
        echo json_encode("Incorrect Username!");
    }
} elseif ($username != '' && $password ==='') {
    json_encode("Please enter your password");
}
else {
    json_encode("Please enter your username");
}
?>