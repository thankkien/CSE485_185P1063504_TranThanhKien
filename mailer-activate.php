<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader
require 'vendor/autoload.php';
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.office365.com';                   // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    include("config-mail.php");
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    //Recipients
    $mail->setFrom('thankkien@hotmail.com', 'thankkien');
    $mail->addAddress($email, $username);    // Add a recipient
    //$mail->addAddress('ellen@example.com');                   // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');             // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');        // Optional name
    // Content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = 'Activate Your Account';
    $mail->Body    = "<p>Please <a href='http://localhost/BaiTapLon/activate.php?email=$email&code=$sec_code'>activate here</a>!!</p>";
    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}