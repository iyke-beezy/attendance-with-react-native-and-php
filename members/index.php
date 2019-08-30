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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet">
</head>
<body>

<div class="main">                
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <section>
                        <div class="jumbotron jumbotron-fluid">
                        <div class="container">         
                        <h1 class="display-4">Hello, <?php /* Placeholder for the username of admin */ echo "Username" //$username;?>!</h1>
                        <p class="lead">This is your dashboard to receive latest reports on your account.</p>
                        <hr class="my-4">
                        <p>Below is a cast of recent news</p>
                        </div><!--container-->
                    </div><!--jumbotron [opening title]-->
                </section>
                <div class="card news">
                    <div class="card-body">
                        
                            <div class="row">
                                <h5>Attendance</h5>
                                <div class="separator"></div>
                                <div id="tol">
                                    <div class="overview_referral">
                                    <div class="overview_Referral_count">
                                        <div class="Referral_count"><?php echo $referral_count; ?></div> 
                                        <div class="count_title">Total Referrals</div>
                                    </div>
                                    <svg data-v-3c5762f5="" class="donut">
                                        <circle data-v-3c5762f5="" r="38%" cx="50%" cy="50%" style="stroke-dasharray: 422, 422; stroke-dashoffset: 0;"></circle>
                                        <circle data-v-3c5762f5="" r="38%" cx="50%" cy="50%" style="stroke-dasharray: 0, 422; stroke-dashoffset: -422;"></circle>

                                    </svg>
                                    <p>Referral code activated <?php echo $referral_count; ?> times</p>
                                </div>
                                </div><!--#referral-->
                            </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-4" id = "bal">
                                <div id="avail">
                                <h5>Available Balance</h5>
                                <div class="separator"></div>
                                <h6>GH₵ 0.0</h6>
                                <p class="text-muted">Money here is available for withdrawal and spend.</p>
                                </div>
                                <div id="ledger">
                                        <h5>Ledger Balance</h5>
                                        <div class="separator"></div>
                                        <h6>GH₵ <?php echo $earnings; ?>.0</h6>
                                        <p class="text-muted">Your ledger balance is how much you have made. This money will be settled into your preferred account on due date.</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer text-center text-muted">
                        Due for collection in 90 days ago
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
                                    <p><a data-toggle="modal" href="#username_edit"><h5>Username <span><i class="far fa-edit"></i></span></h5></a>  | <?php echo $username; ?></p>
                                    <hr class="my-4">

                                    <p><a data-toggle="modal" href="#email_edit"><h5>Email <span><i class="far fa-edit"></i></span></h5></a>  | <?php echo $email; ?></p>
                                    <hr class="my-4">

                                    <p><a data-toggle="modal" href="#phone_edit"><h5>Phone <span><i class="far fa-edit"></i></span></h5></a>  | <?php echo $phone; ?></p>
                                    <hr class="my-4">

                                    <p><a data-toggle="modal" href="#product_edit"><h5>Product <span><i class="far fa-edit"></i></span></h5></a>  | <?php echo $product; ?></p>
                                    <hr class="my-4">

                                    <p><a data-toggle="modal" href="#package_edit"><h5>Package <span><i class="far fa-edit"></i></span></h5></a>  | <?php echo $package; ?></p>
                                    <hr class="my-4">
                                    
                                    <p><a data-toggle="modal" href="#password_edit"><h5>password <span><i class="far fa-edit"></i></span></h5></a>  | <?php echo "******"; ?></p>
                                    <hr class="my-4">


                                    <p><h5>Referral Code</h5>  | <?php echo $referral_code; ?></p>
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
    
<!--email edit-->
    <div class="modal fade" id="email_edit" tabindex="-1" role="dialog" aria-labelledby="email_edit" aria-hidden="true">
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
                            <input type="email" class="form-control" id="name" <?php echo $email; ?> name="email" placeholder="email" readonly>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="newemail" name="newemail" placeholder="Enter new email" required>
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
    <!--email editing ends-->

    <!--phone edit-->
    <div class="modal fade" id="phone_edit" tabindex="-1" role="dialog" aria-labelledby="phone_edit" aria-hidden="true">
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
                            <input type="text" class="form-control" id="name" name="phone" <?php echo $phone; ?> placeholder="phone" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="newphone" name="newphone" placeholder="Enter new phone number" required>
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
    <!--phone editing ends-->
    
    <!--product edit-->
    <div class="modal fade" id="product_edit" tabindex="-1" role="dialog" aria-labelledby="product_edit" aria-hidden="true">
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
                            <input type="text" class="form-control" id="name" name="product" <?php echo $product; ?> placeholder="product" readonly>
                        </div>
                        <div class="form-group">
                                <select class="form-control" id="product" name="newproduct" required>
                                        <option value="" selected disabled>Industry</option>
                                        <option value="pro" >Professional</option>
                                        <option value="com" >Company</option>
                                        <option value="ent" >Entertainment</option>
                                        <option value="ath" >Athletes</option>
                                        <option value="ree" >Real Estate</option>
                                        <option value="res" >Restaurant</option>
                                        <option value="eco" >Ecommerce</option>
                                        <option value="gym" >Gym</option>
                                        <option value="bea" >Beauty</option>
                                        <option value="pho" >Photography</option>
                                        <option value="crd" >Creative Design</option>
                                        <option value="aut" >Authors/Writers</option>
                                        <option value="att" >Attorneys</option>
                                        <option value="sch" >School</option>
                                        <option value="hos" >Hospital</option>
                                    </select>
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
    <!--product editing ends-->

    <!--package edit-->
    <div class="modal fade" id="package_edit" tabindex="-1" role="dialog" aria-labelledby="package_edit" aria-hidden="true">
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
                            <input type="text" class="form-control" id="name" value="<?php echo $package; ?>" name="package" placeholder="package" readonly>
                        </div>
                        <div class="form-group">
                                <select class="form-control" id="package" required name="newpackage">
                                        <option value="" selected disabled>Select your package</option>
                                        <option value="bronze" >Bronze</option>
                                        <option value="silver" >Silver</option>
                                        <option value="gold">Gold</option>
                                    </select>
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
    <!--package editing ends-->

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
              </ul>
      </div>
    </nav>
<!-- nav tabs -->

<!-- nav tabs content -->

    
    <!-- Scroll Top Button -->
        
        <!-- jQuery v3.3.1 -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <!-- Bootstrap v4.0.0 -->
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
        </body>
        </html>