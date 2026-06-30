<?php
require_once './sendmail.php';
require_once '../php/database.php';
try {
    $mail = SendMail::getSendMail();
	$mail->setSubjectAndClient("lamtrvu@gmail.com", "Special Test", "Reminder we are waiting on information");
	$body  = "This email is to advise that your tax return has been lodged by our office electronically to the ATO on " . "2010-08-10" . ".\n\r\n\r";
	$dt = DateTime::createFromFormat('Y-m-d', "2010-08-10");
	$dt->add(new DateInterval('P14D'));
	$value = $dt->format('d/m/Y');
	$body = $body . "Your refund should be credited to your nominated bank account within the next 14 days. If you have not received your refund by " . $value . " please advise us using either of the following methods:\n\r";
	$body = $body . '<h2 style="margin-bottom: 30px;color: black;">Some title</h2>'.
                    '<div style="height: auto;display:block;margin-bottom: 20px;background-color: white;">'.
					'<p style="color: black;">Here is some email text</p>'.
                    '</div>';
	$mail->setBody( "Special Test", $body );
	$rs2 = $mail->sendMail();
	if($rs2) {
		echo "Success";
	} else {
		echo "Failure";
	}

} catch (Exception $ex) {
	echo $ex;
}
?>