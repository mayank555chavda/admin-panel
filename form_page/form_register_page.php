<?php

include ('dbcon.php');

if(isset($_POST['register_btn'])) 
{
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];


 $check_email_query= "SELECT email FROM register WHERE email='$email'LIMIT 1";
 $check_email_query_run = mysqli_query($con,$check_email_query);


 if(mysqli_num_rows($check_email_query_run) > 0) 
 {
  $_SESSION['status'] = "Email Id already Exists";
  echo 'Email Already Registerd';
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
                                <input type="tel" id="phone" name= "phone" placeholder="Phone Number" pattern="[0-9]{10}" class="form-control" required>
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
                                <span id="message"></span>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" onclick="submitForm()" name="register_btn"> Register Now</button>
                            </div>
                        </form>
                        
                        </div>
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


                        <div id="otpdiv" <?php if(isset($_GET['otp'])) { ?> style="display:block;" <?php }else{ ?> style="display:none;"<?php } ?> >
                            <form action="" method="POST">
                                <input type="text" id="mayankinput" name="otp">
                                <button type="submit" name="submit_otp" > Submit OTP</button>
                                
                            </form>
                            
                        </div>
    </script>
    
</body>
</html>