<?php
include ('dbcon.php');
session_start();
 $email= $_GET['email'];
//  echo "$email";
 
if(isset($_POST['verify_btn'])) {
    $entered_otp = $_POST['otp'];
    $stored_otp = $_SESSION['otp'];
    
 
 
    if($entered_otp == $stored_otp) {
        echo "<script>alert('OTP Verification Successful.');</script>";
             echo "<script>window.open('upadet_password.php?email=$email','_self')</script>";
    } else {
        
        echo "<script>alert('Invalid OTP. Please try again.');</script>";
    }
}
?>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h5>OTP Verification</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="form-group mb-3">
                            <label for="otp">Enter OTP</label>
                            <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter OTP" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="verify_btn">Verify OTP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

