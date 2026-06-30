<?php
require_once './sendmail.php';
require_once '../php/database.php';
try {
    $db = Database::getDatabase(true);
    $lodged = array();
    $query = "SELECT Ref, FirstName, LastName, EMail, Status, WaitOnSignSent FROM lookup WHERE Status = '4' AND LENGTH(EMail) > 0 AND WaitOnSignSent = 0 LIMIT 5";
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
            $mail->setSubjectAndClient($client->EMail, $client->FirstName.' '.$client->LastName, "Waiting on a signed tax declaration (Reminder)");
            $mail->setClientInfoBCC("autoemail@policetax.com.au", $client->FirstName.' '.$client->LastName);
            $body  = "This email is to remind you that we have not received your signed declaration to give us permission to electronically lodge your tax return to the ATO.\n\r\n\r";
            $body .= "For your convenience we have an electronic signing platform which can be used on your smart phone or tablet.\n\r";
            $body .= "Options for signing your tax return (1 signing page only) for lodgment are as follows:\n\r";
            $body .= "1.       Digital signature (Further ID needed)\n\r";
            $body .= "2.       Manual signature/upload sign form or\n\r";
            $body .= "3.       Advise of any corrections or amendments\n\r\n\r";
            $body .= "Use the following link to advise us       https://www.policetax.com.au/SignElectronic.php";
			if(strlen($client->FirstName) > 0) $mail->setBody( $client->FirstName, $body );
			else $mail->setBody( $client->LastName, $body );
            $rs2 = $mail->sendMail();
            if($rs2) {
                $update = "UPDATE lookup SET WaitOnSignSent = 1 WHERE Ref='".$client->Ref."'";
                $db->query($update);
            } else {
                $update = "UPDATE lookup SET WaitOnSignSent = 2, MailError = '" . $mail->getErrorInfo() . "' WHERE Ref='".$client->Ref."'";
                $db->query($update);
            }
        }
    }
} catch (Exception $ex) {
}
?>