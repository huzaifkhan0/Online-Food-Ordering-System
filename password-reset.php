<?php
session_start();
include("connection/connect.php"); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//Load Composer's autoloader
require 'vendor/autoload.php';


function send_password_reset($get_name,$get_email,$token)

{
    $mail = new PHPMailer(true);
    $mail->isSMTP();                                                
    $mail->SMTPAuth   = true;     
    
    $mail->Host       = 'smtp.gmail.com'; 
    $mail->Username   = 'huzaifhusainkhan@gmail.com';                     
    $mail->Password   = 'mkfcyfkbgeibhuhm';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    
                                  

    $mail->setFrom('huzaifhusainkhan@gmail.com',$get_name );
    $mail->addAddress($get_email);     
   

    $mail->isHTML(true);                                  
    $mail->Subject = 'Reset Password Notification';   

    $email_template =" 
    <h2> Hello</h2>
    <h3> You are reciving this email </h3>
    </br></br>
    <a href='http://localhost/Online-Food-Ordering-System-in-PHP-main/password-change.php?token=$token&email=$get_email'>Click me</a>
    ";

    $mail->Body = $email_template;
    $mail->send();
    
}


if(isset($_POST['passforgot']))
{

    $email=mysqli_real_escape_string($db, $_POST['email']);
    $token =md5(rand());
    
    $check_email ="SELECT  email FROM users WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($db,$check_email);

    if(mysqli_num_rows($check_email_run)>0)
    {
        $row= mysqli_fetch_array($check_email_run); 
        $get_name= $row['username']; 
        $get_email= $row['email'];


        $update_token= "UPDATE users SET verify_token='$token' WHERE email='$get_email' LIMIT 1";
        $update_token_run= mysqli_query($db,$update_token); 
        
        if($update_token_run)
        {
             send_password_reset($get_name,$get_email,$token);
             $_SESSION['status']= "we e-mail you a password reset link send";
             header("Location: forgot_password.php");
             exit(0);


        }
        else
        {
            $_SESSION['status']= "Something went wrong. #1";
            header("Location: forgot_password.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status']= "No Email Found";
        header("Location: forgot_password.php");
        exit(0);
    }

}

    if(isset($_POST['password-update']))
    {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $new_password = mysqli_real_escape_string($db, $_POST['new-password']); 
    $confirm_password = mysqli_real_escape_string($db, $_POST['confirm-password']);

    $token = mysqli_real_escape_string($db, $_POST['password_token']);
    if(!empty($token))
    {
        if(!empty($email) && !empty($new_password) && !empty($confirm_password))
        {
            $check_token = "SELECT verify_token FROM users WHERE verify_token='$token' LIMIT 1"; 
            $check_token_run = mysqli_query($db, $check_token);

            if(mysqli_num_rows($check_token_run) > 0)
            {
               if($new_password==$confirm_password)
               {
                  $update_password="UPDATE users SET Password='$new_password' WHERE verify_token='$token' LIMIT 1";
                  $update_password_run=mysqli_query($db,$update_password);
                  if($update_password_run)
                  {

                    $new_token = md5(rand())."funda"; 
                    $update_to_new_token = "UPDATE users SET verify_token='$new_token' WHERE verify_token='$token' LIMIT 1"; 
                    $update_to_new_token_run = mysqli_query($db, $update_to_new_token);



                    $_SESSION['status1']= "New Password Sucessfuly Updated";
                    header("Location: login.php");
                    exit(0);
                  }
                  else
                  {
                    $_SESSION['status1']= "Did not update password Something went worng";
                    header("Location: password-change.php?token=$token&email=$email");
                    exit(0);
                  }
               }
               else
               {
                $_SESSION['status1']= "Password and Confirm Password does not match";
                header("Location: password-change.php?token=$token&email=$email");
                exit(0);
               }
            }
            else
            {
                $_SESSION['status1']= "Invalid Token";
            header("Location: password-change.php?token=$token&email=$email");
            exit(0); 
            }


        }
        else
        {
            $_SESSION['status1']= "All Filed are Mandetory";
            header("Location: password-change.php?token=$token&email=$email");
            exit(0);
        }
    }

else
{
    $_SESSION['status1']= "No Token Available";
    header("Location: password-change.php?token=$token&email=$email");
        exit(0);
}



    }

?>
