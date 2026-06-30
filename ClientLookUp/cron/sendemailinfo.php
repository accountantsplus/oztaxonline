<?php
require_once './sendmail.php';
require_once '../php/database.php';
try {
    $db = Database::getDatabase(true);
    $lodged = array();
    $query = "SELECT Ref, FirstName, LastName, EMail, Status, Text, WaitOnInfoSent FROM lookup WHERE Status = '3' AND LENGTH(EMail) > 0 AND WaitOnInfoSent = 0 LIMIT 5";
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
            $mail->setSubjectAndClient($client->EMail, $client->FirstName.' '.$client->LastName, "Reminder we are waiting on information");
            $mail->setClientInfoBCC("autoemail@policetax.com.au", $client->FirstName.' '.$client->LastName);
            $body  = "This email is to remind you that we are still waiting on information to complete your tax for the current year.\n\r\n\r";
            $body = $body . "Specifically, we are waiting on missing information " . $client->Text . "\n\r";
            $body .= "Please forward this information at your earliest convenience by email to customerservice@policetax.com.au.\n\r";
            $body .= "We will endeavor to process this information within 48 hours and send you a completed tax return for signing";
			if(strlen($client->FirstName) > 0) $mail->setBody( $client->FirstName, $body );
			else $mail->setBody( $client->LastName, $body );
            $rs2 = $mail->sendMail();
            if($rs2) {
                $update = "UPDATE lookup SET WaitOnInfoSent = 1 WHERE Ref='".$client->Ref."'";
                $db->query($update);
            } else {
                $update = "UPDATE lookup SET WaitOnInfoSent = 2, MailError = '" . $mail->getErrorInfo() . "' WHERE Ref='".$client->Ref."'";
                $db->query($update);
            }
        }
    }
} catch (Exception $ex) {
}
?>