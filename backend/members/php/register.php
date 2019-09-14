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

    //else add member to the database
        if($stmt = $con->prepare('INSERT INTO members VALUES(?,?,?,?,?) ')) {
            //id is generated from uniqid, a php function that generates random digits and letters
            $id = substr(str_shuffle(hexdec(uniqid())), 0, 6); //shuffle the id generated and take the first 6 values
            $stmt->bind_param('sssss', $id, $_POST['fname'], $_POST['lname'], $_POST['oname'], $_POST['contact']);
            $stmt->execute();
            $_SESSION['qrcode_id'] = $id;
            

            //generate qrcode now
            
            }
    
}

$con->close();
ob_end_flush();
?>

            <html>
                <head></head>
                <body>
                    <div id = "qrcode"></div>
                    <form action="saveqrcode.php" name = "Genqrcode" method="POST">
                    <input type="hidden" value="" name="imgSrc" />
                    </form>
                    <script src= "../js/jquery-3.3.1.min.js"></script>
                    <script src='../js/qrcode.js'></script>
                    <script type='text/javascript'>
                        var qrcode = new QRCode("qrcode");
                        function makeCode() {
                            
                        var elText = 'tst://member = "' + <?php echo $id?> + '"';
                        console.log(elText);
                        qrcode.makeCode(elText);
                        }
                        makeCode();
                        var canvas = $('#qrcode canvas');
                        console.log(canvas);
                        var img = canvas.get(0).toDataURL("image/png");
                        document.forms["Genqrcode"].elements["imgSrc"].value = img;
                        document.forms["Genqrcode"].submit();
                    </script>
                    </body>
            </html>