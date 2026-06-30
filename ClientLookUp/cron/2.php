<?php
require '../PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer();

$mail->IsSMTP();                       // telling the class to use SMTP

$mail->SMTPDebug = 1;                  
// 0 = no output, 1 = errors and messages, 2 = messages only.
$mail->Mailer = "smtp";
$mail->SMTPAuth = true;                // enable SMTP authentication
$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
//$mail->SMTPSecure = "tls";              // sets the prefix to the servier
$mail->Host = "mail.policetax.com.au";        // sets Gmail as the SMTP server
$mail->Port = 587;                     // set the SMTP port for the GMAIL
$mail->Priority = 1;
$mail->Username = 'customerservice@policetax.com.au'; // SMTP account username
$mail->Password = '$%Dusty@0077'; // SMTP account password

$mail->CharSet = 'windows-1250';
$mail->SetFrom ('customerservice@policetax.com.au', 'Information');
//$mail->AddBCC ( 'customerservices@policetax.com.au', 'Example.com Sales Dep.');
$mail->ContentType = 'text/plain';
$mail->IsHTML(false);

//$mail->Body = $body_of_your_email; 
// you may also use $mail->Body = file_get_contents('your_mail_template.html');
$mail->Subject = "HI";
$mail->Body = "SOMETHING"; 
$mail->AddAddress ('vutrlam@gmail.com', 'Recipients Name');
// you may also use this format $mail->AddAddress ($recipient);
if(!$mail->Send()) {
echo 'Message was not sent.';
echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
echo 'Message has been sent.';
}
?>