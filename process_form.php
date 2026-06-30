
 <?php 
if(isset($_POST['submit'])){
$mail = new PHPMailer();    
$mail->isSMTP();
$mail->Host = 'smtp.mailtrap.io';
$mail->SMTPAuth = true;
$mail->Username = 'Policetax0@gmail.com';
$mail->Password = '$%Dusty@0077’;
$mail->SMTPSecure = 'ssl';
$mail->Port = 25;
$to = "policetax0@gmail.com"; // this is your Email address
$from = $_POST['email']; // this is the sender's Email address
$Firstname = $_POST['FirstName'];
$Surname = $_POST['Surname'];
$email = $_POST[' email'];
$mobile = $_POST[' mobile'];
$state = $_POST['state'];
$TaxDone = $_POST['TaxDone'];
$BeenBefore = $_POST['BeenBefore'];
    
    
    
    $subject = "subject line new 2023 e-book- collected by........name.......mobile ";
    $subject2 = "Copy of your form submission";
    $message = $FirstName . " " . $Surname . " wrote the following:" . "\n\n" . $_POST['message'];
    $message2 = "Here is a copy of your message " . $FirstName . "\n\n" . $_POST['message'];
    $mail->AddAttachment('pdf_files/', 'docs/R3_Pol_Tax.pdf');

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    echo "Mail Sent. Thank you " . FirstName . ", we will contact you shortly.";
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    }
?>



// Save the data to a database or perform any other necessary actions here
// ...

// For demonstration purposes, let's assume the ebook is a file named "ebook.pdf"
// and it's located in the same directory as this PHP file.
//$ebookFilename = 'ebook.pdf';

// Send the ebook to the client for download
//header('Content-Type: application/pdf');
//header('Content-Disposition: attachment; filename="'.basename($ebookFilename).'"');
//readfile($ebookFilename);
//exit();
?>