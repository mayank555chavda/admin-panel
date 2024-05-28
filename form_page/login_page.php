<?php
session_start();

include('dbcon.php');
if(isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM register WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) == 1) {
        $_SESSION['email'] = $email;
    $row = mysqli_fetch_assoc($result);
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_name'] = $row['name'];
      $_SESSION['user_phone'] = $row['phone'];
      $_SESSION['user_email'] = $row['email'];

      header('location:../index.php');
        exit();
    } else {
         echo "<script>alert( 'Invalid email or password.Please try again.')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 90%;
            text-align: center;
        }

        .login-container h2 {
            margin-top: 0px;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .forgot-password {
            margin-top: 10px;
            font-size: 20px;
            color: #007bff;
            text-decoration: none;
            display: block;
        }

        .company-image {
            margin-bottom: 20px;
            max-width: 70%;
            height: auto;
        }

        @media screen and (max-width: 768px) {
            .login-container {
                max-width: 80%;
            }
        }

        @media screen and (max-width: 576px) {
            .login-container {
                max-width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!--<img src="Zapvi-Logo-Dark(1).svg" alt="Company Logo" class="company-image">-->
        <h2>Login Page</h2>
        <form class="login-form" method="POST" action="">
            <input type="email" id="email" name="email" placeholder="Email Address" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit" name="login_btn">Login</button>
        </form>
        <a href="forget_password_email.php" class="forgot-password">Forgot Password?</a>
         <a href="email_otp.php" class="forgot-password">Registration</a>
    </div>
</body>
</html>

