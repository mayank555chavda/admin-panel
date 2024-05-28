<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();

try {
    //Server settings
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.example.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'your@example.com'; // SMTP username
    $mail->Password = 'your_password'; // SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; // TCP port to connect to

    //Recipients
    $mail->setFrom('from@example.com', 'First Last'); // Sender's email address and name
    $mail->addAddress('whoto@example.com', 'John Doe'); // Recipient's email address and name

    //Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'PHPMailer mail() test'; // Email subject
    $mail->Body = '<p>This is the HTML message body</p>'; // HTML message body
    $mail->AltBody = 'This is the plain text message body'; // Plain text message body

    //Attachments
    $mail->addAttachment('images/phpmailer_mini.png'); // Add attachments

    //Send the email
    if ($mail->send()) {
        echo 'Message has been sent';
    } else {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
