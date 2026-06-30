<?php
require '../PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer();

$mail->IsSMTP();                       // telling the class to use SMTP

$mail->SMTPDebug = 1;                  
// 0 = no output, 1 = errors and messages, 2 = messages only.
$mail->Mailer = "smtp";
$mail->SMTPAuth = true;                // enable SMTP authentication
//$mail->SMTPSecure = "tls";              // sets the prefix to the servier
$mail->Host = "mail.accountantsplus.com.au";        // sets Gmail as the SMTP server
$mail->Port = 587;                     // set the SMTP port for the GMAIL
$mail->Priority = 1;
$mail->Username = 'info@accountantsplus.com.au'; // SMTP account username
$mail->Password = 'Dusty@007'; // SMTP account password

$mail->CharSet = 'windows-1250';
$mail->SetFrom ('info@accountantsplus.com.au', 'Information');
$mail->AddBCC ( 'info@accountantsplus.com.au', 'Example.com Sales Dep.');
$mail->ContentType = 'text/plain';
$mail->IsHTML(false);

//$mail->Body = $body_of_your_email; 
// you may also use $mail->Body = file_get_contents('your_mail_template.html');
$mail->Subject = "HI";
$mail->Body = "SOMETHING"; 
//$mail->AddAddress ('vutrlam@gmail.com', 'Recipients Name');
// you may also use this format $mail->AddAddress ($recipient);
/*
if(!$mail->Send()) {
echo 'Message was not sent.';
echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
echo 'Message has been sent.';
}*/
$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'EMAIL SUBJECT';
$mail->Body    =   '<h2 style="margin-bottom: 30px;color: black;">Some title</h2>
                    <div style="height: auto;display:block;margin-bottom: 20px;background-color: white;">
                        <p style="color: black;">Here is some email text</p>
                    </div>';
$array = array(
    1 => array('mail' => 'vutrlam@gmail.com', 'name' => 'Lam1'), 
    2 => array('mail' => 'lamtrvu@gmail.com', 'name' => 'Lam2'),
);
foreach($array as $item) {
    $mail->AddBCC($item['mail'],$item['name']);
}
if(!$mail->Send()) {
echo 'Message was not sent.';
echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
echo 'Message has been sent.';
}
?>