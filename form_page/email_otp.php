<?php

include ('dbcon.php');
session_start();


// $sended_otp = $_SESSION['otp'];
//  $here_name = $_SESSION['name'];

// echo" here $sended_otp is otp & name is $here_name";



  

// if(isset($_POST['submit_otp'])){
//     $receive_otp = $_POST['otp'];
//     $sended_otp = $_SESSION['otp'];
    
//     if($receive_otp == $sended_otp ){
//          echo "<script>alert('Thank you For Add OTP')</script>";
//     }
//     else{
//           echo "<script>alert('OTP Not Same sended OTP : $sended_otp  & Enter OTP : $receive_otp ')</script>";
//     }
    
// }



if(isset($_POST['register_btn'])) 
{
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

 $_SESSION['name'] = $_POST['name'];
 $here_name = $_SESSION['name'];


 $check_email_query= "SELECT email FROM register WHERE email='$email'LIMIT 1";
 $check_email_query_run = mysqli_query($con,$check_email_query);


 if(mysqli_num_rows($check_email_query_run) > 0) 
 {
  $_SESSION['status'] = "Email Id already Exists";
  echo "<script>alert('Email Already Registerd')</script>";
  echo "<script>window.open('email_otp.php','_self')</script>";
 }





else {
    $query =  "INSERT INTO register (name, phone, email,password,confirm_password) VALUES ('$name', '$phone', '$email','$password','$confirm_password')";
     
     $result = mysqli_query($con, $query);
     
     if($result){

            $data = [
                'status' => 201,
                'message' => $requestMethod. 'Customer Created Successfully',
            ];
            echo json_encode($data);

        }
        else {
            $data = [
                'status' => 500,
                'message' => $requestMethod. 'Internal Server Error',
            ];
            echo json_encode($data);
        }
}
 $receiver_email = $_POST['email'];



     
    // $fotp = rand(111111111111111111,999999999999999999);
    // $sotp = rand(111111111111111111,999999999999999999);
    // $totp = rand(111111111111111111,999999999999999999);
    // $footp = rand(111111111111111111,999999999999999999);
    // $otp = 0;
    // $otp .= $fotp .=$sotp .=$totp .=$footp;
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
             echo "<script>window.open('otp.php','_self')</script>";
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
                        <form   method="POST" id="registrationForm" onsubmit="return validateForm()">
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" id="name" name= "name" placeholder="Your Name" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name= "phone" placeholder="Phone Number"  pattern="[6-9]{1}[0-9]{9}" title="Enter Valid Mobile" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" id="email"  name= "email" placeholder="Email Address" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password"  id="password" name= "password" class="form-control" placeholder="Password" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password"  id="confirm_password" name= "confirm_password" class="form-control"  placeholder="Confirm_Password" onkeyup="checkPassword()" required>
                                <span id="message" style="color:red"></span>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" onclick="submitForm()" name="register_btn"> Register Now</button>
                            </div>
                             <a href="login_page.php" class="forgot-password">Login page</a
                        </form>
                        </div>
                </div>
            </div>
        </div>
    </div>




 <script>
    
 function checkPassword() {
  var password = document.getElementById("password").value;
  var confirm_password = document.getElementById("confirm_password").value;
  var message = document.getElementById("message");

  if (password !== confirm_password) {
    message.innerHTML = "Passwords do not match";
  } else {
    message.innerHTML = "";
  }
}
    
//  function submitForm() {
//   if (validateForm()) {
//     window.location.href = "login_page.php";
//   } else {
//     alert("Please fix errors in the form.");    
//   }
// }



function validateForm() {
  var password = document.getElementById("password").value;
  var confirm_password = document.getElementById("confirm_password").value;


  if (password !== confirm_password) {
    document.getElementById("message").innerHTML = "Passwords do not match";
    return false;
  }

  return true;
}


    </script>
    
</body>
</html>
