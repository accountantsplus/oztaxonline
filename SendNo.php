
<?php
   $to_email = "info@policetax.com.au";
   $subject = $_POST['name']." Disagrees to go ahead with Late Years Tax logdement";
   $body = "Hello Anne, Please make a note of the client ". $_POST['name']. "  Please don't send him/her the invoice and his email-ID is:".$_POST['email'];
   $headers = "From: cpa@policetax.com.au";
 
   if ( mail($to_email, $subject, $body, $headers)) {
      echo("Email successfully sent to $to_email");
   } else {
      echo("Email sending failed...");
   }
?>