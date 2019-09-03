<?php
    include 'dbconnect.php';
    session_start();

    //edit username field
    if(isset ($_POST['newUsername'])) {
        if($_POST['username'] === $_POST['newUsername']) {
            die('Username must be different');
        }
        $que = $con->prepare('SELECT * FROM accounts WHERE username = ?');
        $que->bind_param('s', $_POST['newUsername']);
        $que->execute();
        $que->store_result();
        if($que->num_rows > 0) {
            die('username exists; input new username');
        }
        $stmt = $con->prepare('UPDATE accounts SET username = ? WHERE id = ?');
        $stmt->bind_param('ss', $_POST['newUsername'], $_SESSION['user_id']);
        $stmt->execute();
        echo "successfully";
        header('Location:../home.php');
        exit();
        
    }
    
    //edit password field
    if(isset ($_POST['newpassword'], $_POST['password'], $_POST['confirm_newpassword'])) {
        $stmt = $con->prepare('SELECT password FROM accounts WHERE id = ?');
        $stmt->bind_param('s', $_SESSION['user_id']);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0) {
            $stmt->bind_result($password);
            $stmt->fetch();
            $stmt->close();
            if(!password_verify($_POST['password'], $password)) {
                die('Incorrect password');
            }
            if($_POST['password'] === $_POST['newpassword']) {
                die('password must be different');
            }
            if($_POST['newpassword'] != $_POST['confirm_newpassword']) {
                die('New passwords must match');
            }
            $password = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
            $stmt = $con->prepare('UPDATE accounts SET password = ? WHERE id = ?');
            $stmt->bind_param('ss', $password, $_SESSION['user_id']);
            $stmt->execute();
            echo "successfully";
            header('Location:../home.php');
            exit();
        }
        
    }


    
?>