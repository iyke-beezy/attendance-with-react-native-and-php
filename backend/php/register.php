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
$ip = $_SERVER['REMOTE_ADDR'];
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['cpassword'])) {
	// Could not get the data that should have been sent.
    echo('Please complete the registration form!');
    
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['cpassword'])) {
	// One or more values are empty.
    echo('Please complete the registration form');
    
}
//check if passwords match
if($_POST['password'] != $_POST['cpassword']) {
    echo("Passwords do not match");
    
}

if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
    echo('Username is not valid!');
    
}
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
    echo('Password must be between 5 and 20 characters long!');
    
}
// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT id, password FROM users WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo('Username exists, please choose another');
            
	} else {
        if ($stmt = $con->prepare('INSERT INTO users (id, username, password) VALUES (?, ?, ?)')) {
            // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $uniqid = uniqid();
            $id = uniqid();
            $stmt->bind_param('sss',$id, $_POST['username'], $password);
            $stmt->execute();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['user_id'] = $id;
            header('Location: ../profile.php');
            exit();
        
            //confirmation email
            /*$from    = 'info@slitcorp.com';
            $subject = 'Account Activation Required';
            $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
            $activate_link = 'http://slitcorp.com/php/activate.php?&code=' . $uniqid. '&referrer_id='. $ref_id;
            $message = '<p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
            mail($_POST['email'], $subject, $message, $headers);
            
            // mail to referrer that someone has used his referral link
            $from    = 'noreply@slit.com';
            $subject = 'Referral code activated';
            $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
            $message = '<p>You referral code has been activated by '. $output['username'] .' and you will be rewarded a commison when they purchase a package. Login into your account to track your earnings</p>';
            mail($re_email, $subject, $message, $headers);
            header('Location: ../error.php?error_msg=Please check your email to activate your account!');
            exit();
        */
        $stmt->close();
    }
        
    }
            
    }
    else {
	// Something is wrong with the sql statement, check to make sure users table exists with all 3 fields.
    echo('Could not run statement!');
    
}
$con->close();
ob_end_flush();

?>