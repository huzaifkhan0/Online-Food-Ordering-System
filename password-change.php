<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");  
error_reporting(0);  
session_start(); 

?>


<head>
    <meta charset="UTF-8">
    <title>Login || SS FOOD</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="css/login.css">

    <style type="text/css">
    #buttn {
        color: #fff;
        background-color: #5c4ac7;
    }
    </style>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>


<body>
    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logo.png" alt="" width="18%"> </a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    
                </div>
            </div>
        </nav>
    </header>
    <div style=" background-image: url('images/img/pimg.jpg');">

        

        <div class="pen-title">
            < </div>

                <div class="module form-module">
                    <div class="toggle">

                    </div>
                    <div class="form">
                        <h2>Change Password</h2>
                        <?php
      if(isset($_SESSION['status1']))
      {
        ?>
        <div class="alert alert-success">
          <h5><?= $_SESSION['status1'];?></h5>
      </div>
      <?php
      unset($_SESSION['status1']);
      }
      ?>
                        
                       
                        <form action="password-reset.php" method="post">
                            
                            <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">
                            
                        <label class="label_txt">Email Address</label>
                            <input type="text" placeholder="Email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" name="email" />
                            <label class="label_txt">New Password </label>
                            <input type="password" placeholder="New-Password" name="new-password" />
                            <label class="label_txt">confirm password </label>
                            <input type="password" placeholder="Confirm-Password" name="confirm-password" />
                            <input type="submit" id="buttn" name="password-update" value="Update Password" />
                           
                        </form>
                    </div>

                </div>
                <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


                <div class="container-fluid pt-3">
                    <p></p>
                </div>



                <?php include "images/include/footer.php" ?>


</body>

</html>