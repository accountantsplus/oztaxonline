<?php

$json = file_get_contents('php://input');
$obj = json_decode($json);
$email = $obj->{'email'};
$service = $obj->{'service'};
$date = $obj->{'date'};
$time = $obj->{'time'};


/*
Credits: Bit Repository
URL: http://www.bitrepository.com/
*/

include 'androidconfig.php';

error_reporting (E_ALL ^ E_NOTICE);



$body .= "<b>Service:</b> ".$service."<br>"."<b>Preferred Date:</b> ".$date."<br>"."<b>Preferred Time:</b> ".$time;
$submsg = "Android - App - Appointment Request - PoliceTax";
$name = "PoliceTax";
$error = '';



if(!$error)
{
    $mail = mail('admin@accountantsplus.com.au', $submsg, $body,
        "From: ".$name." <".WEBMASTER_EMAIL.">\r\n"
                 ."Reply-To: ".WEBMASTER_EMAIL."\r\n"
                 .'MIME-Version: 1.0' . "\r\n" .
           'Content-type: text/html; charset=iso-8859-1'."\r\n" ."X-Mailer: PHP/" . phpversion());

    if($mail)
    {
        return;
    }
}


?>