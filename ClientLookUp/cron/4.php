<?php
require '../PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer();
$mail = new PHPMailer();
$mail->SMTPDebug = 1;
$mail->Mailer = "smtp";
$mail->Host = "mail.policetax.com.au";
$mail->Port = 587;
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "customerservice@policetax.com.au"; // SMTP username
$mail->Password = "$%Dusty@0077"; // SMTP password 
$Mail->Priority = 1;
$mail->AddAddress("lamtrvu@gmail.com","Name");
$mail->SetFrom("customerservice@policetax.com.au", "Info");
$mail->AddReplyTo("customerservice@policetax.com.au", "Info");
$mail->Subject  = "Hello";
$mail->Body     = "This is my message.";
$mail->WordWrap = 50;  
if(!$mail->Send()) {
    echo 'Message was not sent.';
    echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent.';
}
?>