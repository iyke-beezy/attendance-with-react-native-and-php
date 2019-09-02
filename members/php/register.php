<?php
ob_start();
session_start();
// database connection settings
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'attendance';
$con = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ($con->connect_error) {
	die ('Failed to connect to MySQL: ' .$con->connect_error);
}
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['lname'], $_POST['fname'], $_POST['oname'], $_POST['contact'])) {
	// Could not get the data that should have been sent.
    echo('Please complete the registration form!');
    
}

// Make sure the first name and last name are not invalid are not empty.
if (preg_match('/[A-Za-z0-9]+/', $_POST['lname']) == 0  && preg_match('/[A-Za-z0-9]+/', $_POST['fname']) == 0 && preg_match('/[A-Za-z0-9]+/', $_POST['oname'])) {
    echo('names are not valid!');
}

//check if the member already exist in the database using sql prepare statement to prevent sql injection
if($stmt = $con->prepare('SELECT id FROM members WHERE fname = ? AND lname = ? AND oname = ?')) {
    // Bind parameters (s = string, i = int, b = binary, etc)
    $stmt->bind_param('sss', $_POST['fname'], $_POST['lname'], $_POST['oname']);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0) {
        die('Member already exists');
    }

    else {
        if($stmt = $con->prepare('INSERT INTO members VALUES(?,?,?,?) ')) {
            
        }
    }
}
?>