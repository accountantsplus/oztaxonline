<?php
require_once '../cron/sendmail.php';
require_once '../php/database.php';
$client = $_POST['data'];
$body = $_POST['content'];
try {
    $mail = SendMail::getSendMail();	
	$mail->setSubjectAndClient($client['email'], $client['first_name'].' '.$client['last_name'], "Completion of your tax return");
	$mail->setClientInfoBCC ("customerservice@policetax.com.au", $client['first_name'].' '.$client['last_name']);
	$mail->setHTML(true);
	$mail->setBodyHTMLOnly($body );
	if(isset( $_POST['uploadFile'] )) {
		$mail->attachClientTaxFiles($_POST['uploadFile']);
	}
	if(isset( $_POST['uploadFile2'] )) {
		$mail->attachClientTaxFiles($_POST['uploadFile2']);
	}
	$mail->attachMailTemplates('Car Kms Checklist.pdf');
	$mail->attachMailTemplates('Checklist_Worksheet.pdf');
	$mail->attachMailTemplates('GarryA.jpg');
	$mail->attachMailTemplates('MobileLog2021.pdf');
	$mail->attachMailTemplates('PoliceTax 2021 Front Cover.pdf');
	$mail->attachMailTemplates('PoliceTax_DeductionList2021.pdf');
	$mail->attachMailTemplates('PolicetaxChecklist_Worksheet.pdf');
	$mail->attachMailTemplates('RentalProperty.pdf');
	$mail->attachMailTemplates('Robo Cop Appoint Bot.png');
	$mail->attachMailTemplates('Shares ASX crypto Trades2021.pdf');
	$mail->attachMailTemplates('Station Flyer2021.pdf');
	$mail->attachMailTemplates('TaxOrganiser2021.pdf');
	$mail->attachMailTemplates('TaxOrganiser2022.pdf');
	$rs2 = $mail->sendMail();
	if($rs2) {
		echo "Success";
	} else {
		echo $mail->getErrorInfo();
	}
} catch (Exception $ex) {
	echo $ex;
}
?>