<?php
require_once './sendmail.php';
require_once '../php/database.php';
try {
    $db = Database::getDatabase(true);
    $lodged = array();
    $query = "SELECT Ref, FirstName, LastName, EMail, Status, LodgeDate, LodgedSent FROM lookup WHERE Status = '6' AND LENGTH(EMail) > 0 AND LodgedSent = 0 LIMIT 5";
    $rs = $db->query($query);
    if(!is_bool($rs)) {
        while($obj = $rs->fetch_object()) {
            array_push($lodged, $obj);
        }
    }
    $mail = SendMail::getSendMail();
    if(count($lodged) > 0) {
        foreach ($lodged as $client) {
            if(strlen($client->EMail) == 0) continue;
            $mail->setSubjectAndClient($client->EMail, $client->FirstName.' '.$client->LastName, "ATO Lodgement completed");
            $mail->setClientInfoBCC("autoemail@policetax.com.au", $client->FirstName.' '.$client->LastName);
			$dt = DateTime::createFromFormat('Y-m-d', $client->LodgeDate);
			$value = $dt->format('d/m/Y');
            $body  = "This email is to advise that your tax return has been lodged by our office electronically to the ATO on " . $value . ".\n\r\n\r";
			$dt->add(new DateInterval('P14D'));
			$value = $dt->format('d/m/Y');
            $body = $body . "Your refund should be credited to your nominated bank account within the next 14 days. If you have not received your refund by " . $value . " please advise us using either of the following methods:\n\r";
            $body .= "1. our website page < a href='https://www.policetax.com.au/MyTaxRedund_Overdue.php' target='blank'>my tax refund is overdue</a> \n\r";
            $body .= "2. 2.	or send us an SMS to 0418 327 096 stating your name and say in body of SMS refund not received yet \n\r\n\r";
			$body .= "If you are happy with our service, please consider giving us a Google review by following this link <a href='https://www.google.com/search?q=policetax-mitcham#lrd=0x6ad6392320b7b39f:0x505d0b9eb9ce5c5c,3,,,.\n\r' target='blank'>policetax-mitcham - Google Search</a>";
            $body .= "If you have any other questions regarding your tax lodgement for this year, please do not hesitate to ring our office on 1800 819 692.";
            $mail->setHTML(true);
			if(strlen($client->FirstName) > 0) $mail->setBodyHTML( $client->FirstName, $body );
			else $mail->setBodyHTML( $client->LastName, $body );
            $rs2 = $mail->sendMail();
            if($rs2) {
                $update = "UPDATE lookup SET LodgedSent = 1 WHERE Ref='".$client->Ref."'";
                $db->query($update);
            } else {
                $update = "UPDATE lookup SET LodgedSent = 2, MailError = '" . $mail->getErrorInfo() . "' WHERE Ref='".$client->Ref."'";
                $db->query($update);
            }
        }
    }
} catch (Exception $ex) {
}
?>