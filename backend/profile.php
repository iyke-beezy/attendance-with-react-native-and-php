<?php

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
    exit();
}
include 'php/dbconnect.php';

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT username, password FROM users WHERE id = ?');
$stmt->bind_param('s', $_SESSION['user_id']);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0) {
    $stmt->bind_result($username, $password);
    $stmt->fetch();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="images/favicon.png" type="image/x-icon" />
    <!-- Theme tittle -->
    <title>Slitcops - Profile</title>

    <!-- Theme style CSS -->
    <link href="members/css/bootstrap.min.css" rel="stylesheet">
    <link href="members/css/style.css" rel="stylesheet">
    <link href="members/fontawesome/css/all.css" rel="stylesheet">
</head>
<body>

<div class="main">                
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <section>
                        <div class="jumbotron jumbotron-fluid">
                        <div class="container">         
                        <h1 class="display-4">Hello, <?php echo $username;?>!</h1>
                        <p class="lead">This is your dashboard to receive latest reports on your account.</p>
                        <hr class="my-4">
                        <p>Below is a cast of recent news</p>
                        </div><!--container-->
                    </div><!--jumbotron [opening title]-->
                </section>
                <div class="card news">
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Attendance</h5>
                                    <div class="separator"></div>
                                </div>
                    </div>
                </div>
                </div>
                </div>
              
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                     <!--create profile editing screen-->
                     <section>
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                            <h1 class="display-4">Account Details!</h1>
                            
                            <hr class="my-4">
                            </div><!--container-->
                        </div><!--jumbotron [opening title]-->
                </section>
                </section>
                <div class="card clients">
                    <div class="card-body container" id = "client_details">
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="client_header">
                                    <h5>Account Details</h5>
                                    <div class="separator"></div>
                                </div>
                                <div class="acc_details text-center">
                                    <!-- username -->
                                    <p><a data-toggle="modal" href="#username_edit"><h5>Username <span><i class="far fa-edit"></i></span></h5></a>  | <?php echo $username; ?></p>
                                    <hr class="my-4">

                                    <!-- Password -->
                                    <p><a data-toggle="modal" href="#password_edit"><h5>password <span><i class="far fa-edit"></i></span></h5></a>  | <?php echo "******"; ?></p>
                                    <hr class="my-4">
                                </div>
                            </div>                                
                        </div>
                    </div> 
                </div><!--clients-->
                </div>
              </div>
</div>   

<!--modal content-->
<!--username edit-->
<div class="modal fade" id="username_edit" tabindex="-1" role="dialog" aria-labelledby="username_edit" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                    <form class="from_main" action="php/edit.php" method="post" >
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" <?php echo $username; ?> name="username" placeholder="Username" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="newUsername" name="newUsername" placeholder="Enter new username" required>
                        </div>
    
                        <div class="form-group m-0">
                            <button class="theme_btn btn" type="submit" name = "submit">Save changes</button>
                            <div id="js-contact-result" data-success-msg="Form submitted successfully." data-error-msg="Messages Successfully"></div>
                        </div>
                    </form>
            </div>
            <div class="modal-footer">
            
            </div>
        </div>
        </div>
    </div>
    <!--username editing ends-->

    <!--password edit-->
    <div class="modal fade" id="password_edit" tabindex="-1" role="dialog" aria-labelledby="password_edit" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                    <form class="from_main" action="php/edit.php" method="post" >
                        <div class="form-group">
                            <input type="password" class="form-control" id="name" name="password" placeholder="Enter Old password" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter new password " required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="confirm_newpassword" name="confirm_newpassword" placeholder="confirm new password" required>
                        </div>
    
                        <div class="form-group m-0">
                            <button class="theme_btn btn" type="submit" name = "submit">Save changes</button>
                            <div id="js-contact-result" data-success-msg="Form submitted successfully." data-error-msg="Messages Successfully"></div>
                        </div>
                    </form>
            </div>
            <div class="modal-footer">
            
            </div>
        </div>
        </div>
    </div>
    <!--password editing ends-->

    <!--Add new member-->
    <div class="modal fade" id="member_add" tabindex="-1" role="dialog" aria-labelledby="member_add" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                        <form class="from_main" action="members/php/register.php" method="post" >
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="lname" placeholder="Enter last name" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter first name " required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="onames" name="oname" placeholder="Enter other names (optional)">
                            </div>
        
                            <div class="form-group">
                                <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter contact number" required>
                            </div>
                            
                            <div class="form-group">
                                <button class="btn btn-link"></button>
                            </div>
                            
                            <div class="form-group m-0">
                                
                                <button class="btn btn-link" type="submit" name = "submit">Register</button>
                            </div>
                        </form>
                </div>
                <div class="modal-footer">
                
                </div>
            </div>
            </div>
        </div>


<nav class="navbar fixed-bottom navbar-expand-lg navbar-light bg-light" role="tablist">
      <a class="navbar-brand"
          href="index.html"><img class="img-fluid bottom_image" src="images/logo.png" alt="#"></a>
      <div class="collapse navbar-collapse justify-content-center"
          id="navbarNav">
          <ul class="nav nav-pills" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Overview <i class="fas fa-tachometer-alt"></i><span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile <i class="fas fa-plus-circle"></i></a>
                </li>
                <li class="nav-item">
                <a class="nav-link"
                    href="php/logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
                </li>
                <li class="nav-item">
                <a class="nav-link"
                data-toggle="modal" href="#member_add"> Add Member <i class="fas fa-user-plus"></i></a>
                </li>
              </ul>
      </div>
    </nav>
<!-- nav tabs -->

<!-- nav tabs content -->

    
    <!-- Scroll Top Button -->
        
        <!-- jQuery v3.3.1 -->
        <script src="members/js/jquery-3.3.1.min.js"></script>
        <!-- Bootstrap v4.0.0 -->
        <script src="members/js/popper.min.js"></script>
        <script src="members/js/bootstrap.min.js"></script>
        
        </body>
        </html>