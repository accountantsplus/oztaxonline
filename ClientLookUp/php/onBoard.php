<?php
require_once '../cron/sendmail.php';
require_once './database.php';
$db = Database::getDatabase(true);
$email = $_POST['email'];
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$phone = $_POST['mobile'];
$station = $_POST['station'];
$rank = $_POST['rank'];
$year = $_POST['years_in_job'];
$spouse_include = ($_POST['spouse_tax'] == 'yes') ? 1 : 0;
$spouse = $_POST['spouse_details'];
$spouse_dob = $_POST['spouse_dob'];
$spouse_income = $_POST['spouse_income'];
$no_dependants = $_POST['no_dependants'];
$rental_property = 0;
if (isset($_POST['rental_property'])) {
    $rental_property = ($_POST['rental_property'] == 'on') ? 1 : 0;
}
$query = "INSERT INTO onboard (email, fname, lname, phone, station, rank, year, spouse_include, spouse, spouse_dob, spouse_income,no_dependants, rental_property) VALUES ('".$email."','". $fname."','".$lname."','".$phone."','".$station."','".$rank."','".$year."','".$spouse_include."','".$spouse."','".$spouse_dob."','".$spouse_income."','".$no_dependants."','".$rental_property."') ON DUPLICATE KEY UPDATE fname = VALUES(fname), lname = VALUES(lname), phone = VALUES(phone), station = VALUES(station), rank = VALUES(rank), year = VALUES(year), spouse_include = VALUES(spouse_include), spouse = VALUES(spouse), spouse_dob = VALUES(spouse_dob), spouse_income = VALUES(spouse_income), no_dependants = VALUES(no_dependants), rental_property = VALUES(rental_property)";
$rs = $db->query($query);
//echo $rs;
try {
    $mail = SendMail::getSendMail();	
	$mail->setSubjectAndClient($email, $fname.' '.$lname, "Police Tax Client Onboarding");
	$mail->setClientInfoBCC ("customerservice@policetax.com.au", $email.' '.$lname);
	$mail->setHTML(true);
	$mail->setBodyHTMLOnly(' ');
	$mail->attachMailTemplates('How to Get the Best Legal Police Tax Refund for the 2024 Year.pdf');
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