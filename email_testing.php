<?php
require 'PHPMailer/class.phpmailer.php';
require("PHPMailer/PHPMailerAutoload.php"); // path to the PHPMailerAutoload.php file.

ini_set('date.timezone', 'Australia/Melbourne');  
  $allowed_filetypes = array('.jpg','.pdf','.txt','.png','.zip');
  $max_filesize = 8388608; // Maximum filesize in BYTES (currently 8MB).
  $upload_path = 'uploads/' . $_POST['TFN'] . '/';

  /*
  Code to SEND form details to email address
  */
  $sendto  = "online@policetax.com.au"; // send to email address
  if($_POST["emailTo"] != ""){
    $sendto = $_POST["emailTo"];
  }

  $subject = $_POST['subject'];
  $email = "online@policetax.com.au";
  // $statement =  $_POST["Statement"];

  // Build the email body text
  $emailcontent = $_POST['message'] . $_POST['TaxResult'];

  $emailid=md5(time());

  //saving the files
  $path = 'uploads/' . $_POST['TFN'] . '/';

  if (!file_exists($path)) {
      mkdir($path);
  }
  
$mail = new PHPMailer();
//$mail->IsSMTP();
$mail->Mailer = "ssl";
$mail->Host = "mail.policetax.com.au";
$mail->Port = 26; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Username = "online@policetax.com.au";
$mail->Password = "Dusty@007";

$mail->From =  $email;
$mail->FromName = "Online Packages";
$mail->AddAddress($sendto, $sendto);

$mail->Subject = $subject;
$mail->Body = $emailcontent;
$mail->WordWrap = 50000;


$count = count(array_filter($_FILES['file']['name']));
if(!empty($_FILES['file']) > 0){
    if($_POST['TaxType'] == "Budget"){
    
     $temp = explode('.', $_FILES['file']['name']);
    $uploadedFileName = $path . "AttachmentFiles_" . time() . '.' . end($temp);
      //print_r $fileExtension;
      if ( 0 < $_FILES['file']['error'] ) {
          echo 'Error: ' . $_FILES['file']['error'] . '<br>';
      }
      else {
          move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFileName );
      }
      
      $mail->addAttachment($uploadedFileName);
    
      
    }else{
    
      for ($i = 0; $i < $count; $i++) {
        $uid = md5(uniqid(time()));
        $filename = $_FILES['file']['name'][$i]; // Get the name of the file (including file extension).
        //$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the extension from the filename.
        
        $temp = explode('.', $_FILES['file']['name'][$i]);
        $uploadedFileName = $path . "AttachmentFiles_" . time() . '.' . end($temp);
        //print_r $fileExtension;
          move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadedFileName );
        if ( 0 < $_FILES['file']['error'][$i] ) {
          echo 'Error: ' . $_FILES['file']['error'][$i] . '<br>';
        }
        else {
        }
        
        $handle = fopen($_FILES['file']['tmp_name'][$i], "rb");
        $filecontents = fread($handle, filesize($_FILES['file']['tmp_name'][$i]));
        fclose($handle);
        
        $mail->addAttachment($uploadedFileName);
      }
    }
}

if(!$mail->Send()) {
echo 'Message was not sent.';
echo 'Mailer error: ' . $mail->ErrorInfo;
exit;
} else {
echo 'Message has been sent.';
}
?>