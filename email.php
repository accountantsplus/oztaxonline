<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");


//require 'PHPMailer/class.phpmailer.php';
//require("PHPMailer/PHPMailerAutoload.php"); // path to the PHPMailerAutoload.php file.

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

ini_set('date.timezone', 'Australia/Melbourne');  
  $allowed_filetypes = array('.jpg','.pdf','.txt','.png','.zip');
  $max_filesize = 8388608; // Maximum filesize in BYTES (currently 8MB).
  $upload_path = 'uploads/' . $_POST['TFN'] . '/';

  /*
  Code to SEND form details to email address
  */
  $sendto  = "online@policetax.com.au"; // send to email address
  if(isset($_POST["emailTo"]) && $_POST["emailTo"] != ""){
    $sendto = $_POST["emailTo"];
  }

  $subject = $_POST['subject'];
  $fromName = "Online Packages";
  
  if(isset($_POST["fromName"]) && $_POST["fromName"] != ""){
    $fromName = $_POST['fromName'];
  }
  $email = "online@policetax.com.au";
  // $statement =  $_POST["Statement"];

    $emailcontent = "";
  // Build the email body text
  if(isset($_POST['message'])){
    $emailcontent = $_POST['message'];   
  }
  
  if(isset($_POST['TaxResult'])){
      $emailcontent =  $_POST['TaxResult'];
  }
  
  if(isset($_POST['message']) && isset($_POST['TaxResult'])){
    $emailcontent = $_POST['message'] . $_POST['TaxResult'];   
  }

  $emailid=md5(time());

  //saving the files
  $path = 'uploads/' . $_POST['TFN'] . '/';

  if (!file_exists($path)) {
      mkdir($path);
  }
  
//$mail->IsSMTP(true);
try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    // SMTP configuration
    //$mail->isSMTP();
    //$mail->Host = "mail.policetax.com.au";//"email-smtp.ap-southeast-2.amazonaws.com";//"mail.policetax.com.au";//awspolicetax.com.au
    //$mail->Port = 465; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
    //$mail->SMTPAuth = true;
    //$mail->Username = "online@policetax.com.au";//"AKIAWCU6DUKYPNHFU64V";//"online@policetax.com.au";
    //$mail->Password = "$%Dusty@0077";//"BHL/jaGSTSTFIhBzv9FWfYEuV8PN21Qm/0i4MPClxf8c";//"$%Dusty@0077";
    //$mail->Priority = 1;
    //$mail->SMTPSecure = 'ssl';
    
    $mail->Host = 'smtp.office365.com';
    $mail->Port       = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth   = true;
    $mail->Username = 'admin@policetax.com.au';
    $mail->Password = '$%Dusty@0077';

    // Send email
    $mail->From =  $email;
    $mail->FromName = $fromName;
    $mail->AddAddress($sendto, $sendto);
    
    $mail->Subject = $subject;
    $mail->Body = $emailcontent;
    $mail->WordWrap = 50000;
    $mail->IsHTML(true);
    
     if(!empty($_POST['emailAttachmentEbook'])){
        if($_POST["type"] == "ebookTax"){
            $path = 'assets/files/E-Book_Police Officers.pdf';
            $mail->AddAttachment($path, 'E-Book_Police Officers.pdf');
        } elseif($_POST["type"] == "kmsTax"){
            $path = "assets/files/CarKms_PDF.pdf";
            $mail->AddAttachment($path, 'CarKms_PDF.pdf');
        } elseif($_POST["type"] == "greedyTax"){
            $path = "assets/files/GreedyTax_Police.pdf";
            $mail->AddAttachment($path, 'GreedyTax_Police.pdf');
        } elseif($_POST["type"] == "negativeGearing"){
            $path = "assets/files/Negative gearing explained.pdf";
            $mail->AddAttachment($path, 'Negative gearing explained.pdf');
        } elseif($_POST["type"] == "rental"){
            $path = "assets/files/Rental_PDF.pdf";
            $mail->AddAttachment($path, 'Rental_PDF.pdf');
        } elseif($_POST["type"] == "benefitsOfSalaryPackaging"){
            $path = "assets/files/SalaryPackaging_PDF.pdf";
            $mail->AddAttachment($path, 'SalaryPackaging_PDF.pdf');
        } elseif($_POST["type"] == "novatedLeases"){
            $path = "assets/files/NovatedLeases_PDF.pdf";
            $mail->AddAttachment($path, 'NovatedLeases_PDF.pdf');
        } elseif($_POST["type"] == "fixingPastRefunds"){
            $path = "assets/files/PastPoorRefund_PDF.pdf";
            $mail->AddAttachment($path, 'PastPoorRefund_PDF.pdf');
        } elseif($_POST["type"] == "lastMinuteTax"){
            $path = "assets/files/Last minute tax tips.pdf";
            $mail->AddAttachment($path, 'Last minute tax tips.pdf');
        } elseif($_POST["type"] == "marriageTax"){
            $path = "assets/files/MarriageTax.pdf";
            $mail->AddAttachment($path, 'MarriageTax.pdf');
        } elseif($_POST["type"] == "newPoliceRecruits"){
            $path = "assets/files/Taxation guide for New Police Recruits.pdf";
            $mail->AddAttachment($path, 'Taxation guide for New Police Recruits.pdf');
        } elseif($_POST["type"] == "bewareMyGov"){
            $path = "assets/files/MyGov Tax Lodge Is Not Good For You - Read This Shocking Report Now.pdf";
            $mail->AddAttachment($path, 'MyGov Tax Lodge Is Not Good For You.pdf');
        } elseif($_POST["type"] == "newRecruitsAcademy"){
            $path = "assets/files/Successful Tax Preparation for New Police Recruits.pdf";
            $mail->AddAttachment($path, 'Successful Tax Preparation.pdf');
        } elseif($_POST["type"] == "policeTaxNewsletter"){
            $path = "assets/files/PoliceTax - Police Officers Tax Deductions - Free.pdf";
            $mail->AddAttachment($path, 'Police Officers Tax Deductions.pdf');
        } elseif($_POST["type"] == "Taxchecklist1"){
            $path = "assets/files/Police officer tax tips.pdf";
            $mail->AddAttachment($path, 'Tax Tips.pdf');
        } elseif($_POST["type"] == "mistakes"){
            $path = "assets/files/7 mistakes police officers do with their tax.pdf";
            $mail->AddAttachment($path, '7 mistakes with tax.pdf');
        } elseif($_POST["type"] == "freeChecklists"){
            $path = "assets/files/Police Deduction List.pdf";
            $mail->AddAttachment($path, 'Police Deduction List.pdf');
        } elseif($_POST["type"] == "checklist"){
            $path = "assets/files/Police Deduction List.pdf";
            $mail->AddAttachment($path, 'Police Deduction List.pdf');
        } elseif($_POST["type"] == "myGov"){
            $path = "assets/files/DontUseMygovTax.pdf";
            $mail->AddAttachment($path, 'DontUseMygovTax.pdf');
        }
      }
     
     if(isset($_FILES['file'])){
    $count = count(array_filter($_FILES['file']['name']));   
     }
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
        
          for ($i = 0; $i <= $count; $i++) {
            $uid = md5(uniqid(time()));
            $filename = $_FILES['file']['name'][$i]; // Get the name of the file (including file extension).
            //$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the extension from the filename.
            
            $temp = explode('.', $_FILES['file']['name'][$i]);
            $uploadedFileName = $path . "AttachmentFiles_" . time() . '.' . end($temp);
            //print_r $fileExtension;
              
            if ( 0 < $_FILES['file']['error'][$i] ) {
              echo 'Error: ' . $_FILES['file']['error'][$i] . '<br>';
            }
            else {
                move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadedFileName );
            }
            
            $mail->addAttachment($uploadedFileName);
          }
        }
    }else if(isset($_POST['imgbase64']) && $_POST['imgbase64'] != ''){
        $img = $_POST['imgbase64'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = $path . "AttachmentFiles_" . time() . '.png';
        $success = file_put_contents($file, $data);
        $mail->addAttachment($file);
    }
    
    if($emailcontent == ""){
        echo 'Error occurred while sending message.';
        exit;
    }
    
    if(!$mail->Send()) {
        echo 'Message was not sent.';
        echo 'Mailer error: ' . $mail->ErrorInfo;
        exit;
    } else {
        echo 'Message has been sent.';
    }
    echo 'Email sent successfully';
} catch (Exception $e) {
    echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
}
?>