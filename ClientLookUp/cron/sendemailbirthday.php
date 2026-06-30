<?php
require_once './sendmail.php';
require_once '../php/database.php';
try {
    $db = Database::getDatabase(true);
    $lodged = array();
	$query = "SELECT Ref, FirstName, LastName, EMail, DOB, BirthdaySent FROM lookup WHERE LENGTH(EMail) > 0 AND DAY(DOB) = DAY(CURDATE()) and MONTH(DOB) = MONTH(CURDATE()) AND BirthdaySent <> YEAR(CURDATE()) LIMIT 10";
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
            $mail->setSubjectAndClient($client->EMail, $client->FirstName.' '.$client->LastName, "Congratulations it’s your birthday");
            $mail->setClientInfoBCC("autoemail@policetax.com.au", $client->FirstName.' '.$client->LastName);
            $body  = "We wish you a truly spectacular birthday celebration filled with beautiful and happy periods is all we wish for you. May lots of amazing achievements forever accompany your life. Happy birthday!";
			if(strlen($client->FirstName) > 0) $mail->setBody( $client->FirstName, $body );
			else $mail->setBody( $client->LastName, $body );
            $rs2 = $mail->sendMail();
            if($rs2) {
                $update = "UPDATE lookup SET BirthdaySent = YEAR(CURDATE()) WHERE Ref='".$client->Ref."'";
                $db->query($update);
            } else {
                $update = "UPDATE lookup SET BirthdaySent = 2, MailError = '" . $mail->getErrorInfo() . "' WHERE Ref='".$client->Ref."'";
                $db->query($update);
            }
        }
    }
} catch (Exception $ex) {
    echo $ex;
}
?>