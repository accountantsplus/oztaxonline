<?php
require '../PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Mailer = "smtp";
$mail->Host = 'vs-anniefanny.au.syrahost.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
$mail->Username = 'customerservice@policetax.com.au';                 // SMTP username
$mail->Password = '$%Dusty@0077';                           // SMTP password
$mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to
$mail->setFrom('customerservice@policetax.com.au', 'Mailer');
$mail->addAddress('lamtrvu@gmail.com', 'Contact');     // Add a recipient
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = "test";
$mail->Body    = "<b>Hello</b> <i>evrything</i>";
$mail->AltBody = '';
    if(!$mail->send()) {
        echo 'Message could not be sent.<br>';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo "ok";
    }
?>