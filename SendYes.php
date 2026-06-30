<?php
   $to_email = "info@policetax.com.au";
   $subject = $_POST['name']." Agrees to go ahead with Late Year Tax logdement";
   $body = "Hello Anne, Please make a note of the client ". $_POST['name']. " Please do the needful by sending him/her the invoice to ".$_POST['email'];
   $headers = "From: cpa@policetax.com.au";
 
   if ( mail($to_email, $subject, $body, $headers)) {
      echo("Email successfully sent to $to_email...");
   } else {
      echo("Email sending failed...");
   }
?>