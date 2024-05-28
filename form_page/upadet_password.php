<?php
include ('dbcon.php'); 
session_start();
$email= $_GET['email'];
//  echo "$email";
if(isset($_POST['register_btn'])) {
   $email= $_GET['email'];
    $password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

    $check_email_query = "SELECT * FROM register WHERE email='$email'";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if(mysqli_num_rows($check_email_query_run) > 0) {
        
        $update_query = "UPDATE register SET password='$password',confirm_password = '$confirm_password' WHERE email='$email'";
        $update_query_run = mysqli_query($con, $update_query);

        if($update_query_run) {
            echo "Password updated successfully";
        } else {
            echo "Failed to update password";
        }
    }
    else{
        echo"somrthing Error";
    }
}
?>






<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<title>Update Password</title>
</head>
<body>
 <div class="py-5">
        <div class="containder">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>upadet_paaseord</h5>
                        </div>
                        <div class="card-body">

                        <form   method="POST" id="registrationForm" onsubmit="return validateForm()">
                            
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
                        </form>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
    
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
</html>