<?php

include ('dbcon.php');
session_start();


if(isset($_POST['register_btn'])) 
{
$email = $_POST['email'];

$_SESSION['email'] = $emial;
 $receiver_email = $_POST['email'];

      $otp = rand(111111, 999999);
    $_SESSION['otp'] = $otp;
    $sended_otp = $_SESSION['otp'];
    
    $body = "";
    $body .= '<h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> '.$otp.' </h2>';
    
    
    if(true){
        $to = " $receiver_email";
        $subject = "Email Verification";
        $headers = "From:maruticlass81@gmail.com". "\r\n";;
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $message = " $otp";
        
        if(mail($to, $subject, $message, $headers)){
            echo "<script>alert('Mail send to sended Otp : $sended_otp')</script>";
             echo "<script>window.open('forget_password_otp.php?email=".$_POST['email']."','_self')</script>";
        }else{
            echo "<script>alert('Mail not send')</script>";
        }	
         
    }
    
}

?>


<!DOCTYPE html>
<html lang="en">


<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<title>Registration Form</title>
</head>
<body>
 <div class="py-5">
        <div class="containder">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Registration</h5>
                        </div>
                        <div class="card-body">
                        <form   method="POST">
        
        
                            <div class="form-group mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" id="email"  name= "email" placeholder="Email Address" class="form-control" required>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"  name="register_btn"> Register Now</button>
                            </div>
                        </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
