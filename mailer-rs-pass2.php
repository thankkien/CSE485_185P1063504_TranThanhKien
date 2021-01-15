<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp.office365.com';
    $mail->SMTPAuth   = true;
    include("config-mail.php");
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    //Recipients
    $mail->setFrom('thankkien@hotmail.com', 'thankkien');
    echo $email;
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Password Reset Was Successful';
    $mail->Body    = "<p>Your Password: $password</p> <br> <p>Please <a href='http://localhost/BaiTapLon/page-login.php'>login here</a>!!</p>";
    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}?>