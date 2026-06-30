<?php
header("Access-Control-Allow-Origin: https://policetax.com.au");

require_once './database.php';
require_once "./db.php";
require_once './sendEmail.php';
require_once './paypal.class.php';
$action = $_POST['action'];
if(!isset($_SESSION)) session_start();
$firstName = $_SESSION['fname'];
$lastName = $_SESSION['lname'];
$zipCode = $_SESSION['postcode'];
$town = $_SESSION['suburb'];
$email = $_SESSION["email"];
$ip = getRealIpAddr();
$country = getCountryIp($ip);

//$merchantID = '';
//$password = '';


function getMerchantIdandPassword(){
    $db = Database::getDatabase(true);
    $query = "SELECT MerchantId, Password FROM BankingCredential WHERE Id = 1";//'2021-10-01 05:55:00'
    $rs = $db->query($query);
    $arr = array();
    if(is_bool($rs)) return $query;
    else {
        while($obj = $rs->fetch_object()) {
        	array_push($arr, $obj);
        }
        
        return $arr[0];
    }
}

if($firstName == ""){
    $firstName = $_POST['fname'];
}
if($lastName == ""){
    $lastName = $_POST['lname'];
}

if($email == ""){
    $email = $_POST['email'];
}


if (checkError($firstName, $lastName, $country, $email, $ip) == false) {
    http_response_code(503);
    exit;
}
if($action == 'sendPayment') {
	$amount = ((double) $_POST['amount']) * 100;
	//$amount = 1;//test only, dangerous
	$cardNumber = $_POST['cardNumber'];
	$country = getCountryCard(mb_substr($cardNumber, 0, 7));
	$cvv = $_POST['cvv'];
	$expiryDate = $_POST['expiryDate'];
	$cardHolderName = $_POST['cardHolderName'];
	//$message = sendPayment($amount, $cardNumber, $cvv, $expiryDate, $cardHolderName);
	$message = sendRiskPayment($amount, $cardNumber, $cvv, $expiryDate, $cardHolderName, $firstName, $lastName, $zipCode, $town, $country, $email, $ip);
	//$url = 'https://demo.transact.nab.com.au/xmlapi/payment';
	//$url = 'https://transact.nab.com.au/live/xmlapi/payment';
	$url = 'https://transact.nab.com.au/riskmgmt/payment';
	$token = $_POST['token'];
	$googleurl = 'https://www.google.com/recaptcha/api/siteverify';
	$result = postDataToGoogle($token, $googleurl);
	if($result->success == true) {
    	echo postData($message, $url);
	} else {
	    
	    exit;
	}
} else if($action == 'processEmail') {
	$ReceiptId = $_POST['ReceiptId'];
	$_SESSION['ReceiptId'] = $ReceiptId;
	$a = processCreditCardEmail();
	$b = processConfirmEmail();

	if($_SESSION['address'] == true || $_SESSION['bank'] == true){
		$c = processChangeofAddressorBSBEmail();
	}
	echo processEmail();
} else if($action == 'processTaxedEmail') {
	$ReceiptId = $_POST['ReceiptId'];
	$_SESSION['ReceiptId'] = $ReceiptId;
	echo processTaxedEmail();
} else if($action == 'processSaving') {
	echo processSaving();
}
function postDataToGoogle($token, $url) {
    $fields = [
        'secret' => "6Ld-ODkfAAAAAP4uAMoHA_MhlYwZkBfDV3LQhSzu",
        'response' => $token
    ];
    $fields_string = http_build_query($fields);
    $ch = curl_init( $url );
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec( $ch );
    curl_close($ch);
    $jsonData = json_decode($result);
    return $jsonData;
}
function postToUrl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec( $ch );
    curl_close($ch);
    $jsonData = json_decode($result);
    return $jsonData;
}
function getRealIpAddr(){
    $ip = $_SERVER['REMOTE_ADDR'];
    if ( !empty($_SERVER['HTTP_CLIENT_IP']) ) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function getCountryCard($card) {
    $card_json = postToUrl('https://lookup.binlist.net/'.$card);
    if($card_json == null) {
        http_response_code(503);
        exit;
    }
    $country_code = $card_json->country->alpha2;
    if($country_code != "AU") {
        http_response_code(503);
        exit;
    }
    return $country_code;
}
function getCountryIp($ip) {
    $card_json = postToUrl('https://api-bdc.net/data/country-by-ip?ip='.$ip.'&localityLanguage=en&key=bdc_00a210ee757941c3998829e12376093d');
    if($card_json == null) {
        http_response_code(503);
        exit;
    }
    $country_code = $card_json->country->isoAlpha2;
    if($country_code != "AU") {
        http_response_code(503);
        exit;
    }
    return $country_code;
}
function sendPayment($amount, $cardNumber, $cvv, $expiryDate, $cardHolderName) {
	$dateReference = "dmYHis";
	$messageID = gmdate($dateReference, time());	
	$dateFormat="YmdHis";
	$messageTimestamp=gmdate($dateFormat, time());
	$merchantID = 'AV00010';
	$password = 'w1VKorgi';
    $message = '<?xml version="1.0" encoding="UTF-8"?>';
    $message .= '<NABTransactMessage>';
    $message .= '<MessageInfo>';
    $message .= '<messageID>'.$messageID.'</messageID>';
    $message .= '<messageTimestamp>'.$messageTimestamp.'</messageTimestamp>';
    $message .= '<timeoutValue>60</timeoutValue>';
    $message .= '<apiVersion>xml-4.2</apiVersion>';
    $message .= '</MessageInfo>';
    $message .= '<MerchantInfo>';
    $message .= '<merchantID>'.$merchantID.'</merchantID>';
    $message .= '<password>'.$password.'</password>';
    $message .= '</MerchantInfo>';
    $message .= '<RequestType>Payment</RequestType>';
    $message .= '<Payment>';
    $message .= '<TxnList count="1">';
    $message .= '<Txn ID="1">';
    $message .= '<txnType>0</txnType>';
    $message .= '<txnSource>23</txnSource>';
    $message .= '<amount>'.$amount.'</amount>';
    $message .= '<currency>AUD</currency>';
    $message .= '<purchaseOrderNo>'.$messageID.'</purchaseOrderNo>';
    $message .= '<CreditCardInfo>';
    $message .= '<cardNumber>'.$cardNumber.'</cardNumber>';
	$message .= '<cvv>'.$cvv.'</cvv>';
    $message .= '<expiryDate>'.$expiryDate.'</expiryDate>';
    $message .= '<cardHolderName>'.$cardHolderName.'</cardHolderName>';
    $message .= '<recurringflag>no</recurringflag>';
    $message .= '</CreditCardInfo>';
    $message .= '</Txn>';
    $message .= '</TxnList>';
    $message .= '</Payment>';
    $message .= '</NABTransactMessage>';
    return $message;
}

function sendRiskPayment($amount, $cardNumber, $cvv, $expiryDate, $cardHolderName, $firstName, $lastName, $zipCode, $town, $country, $email, $ip) {
	$dateReference = "dmYHis";
	$messageID = gmdate($dateReference, time());	
	$dateFormat="YmdHis";
	$messageTimestamp=gmdate($dateFormat, time());
	
	$arr = getMerchantIdandPassword();
	
	//$merchantID = base64_decode($arr->MerchantId);
    //$password = base64_decode(base64_decode($arr->Password));
	
	$merchantID = 'AV00010';
	$password = 'Yzi9RGyFI]';
    $message = '<?xml version="1.0" encoding="UTF-8"?>';
    $message .= '<NABTransactMessage>';
    $message .= '<MessageInfo>';
    $message .= '<messageID>'.$messageID.'</messageID>';
    $message .= '<messageTimestamp>'.$messageTimestamp.'</messageTimestamp>';
    $message .= '<timeoutValue>60</timeoutValue>';
    $message .= '<apiVersion>xml-4.2</apiVersion>';
    $message .= '</MessageInfo>';
    $message .= '<MerchantInfo>';
    $message .= '<merchantID>'.$merchantID.'</merchantID>';
    $message .= '<password>'.$password.'</password>';
    $message .= '</MerchantInfo>';
    $message .= '<RequestType>Payment</RequestType>';
    $message .= '<Payment>';
    $message .= '<TxnList count="1">';
    $message .= '<Txn ID="1">';
    $message .= '<txnType>0</txnType>';
    $message .= '<txnSource>23</txnSource>';
    $message .= '<amount>'.$amount.'</amount>';
    $message .= '<currency>AUD</currency>';
    $message .= '<purchaseOrderNo>'.$messageID.'</purchaseOrderNo>';
    $message .= '<CreditCardInfo>';
    $message .= '<cardNumber>'.$cardNumber.'</cardNumber>';
	$message .= '<cvv>'.$cvv.'</cvv>';
    $message .= '<expiryDate>'.$expiryDate.'</expiryDate>';
    $message .= '<cardHolderName>'.$cardHolderName.'</cardHolderName>';
    $message .= '<recurringflag>no</recurringflag>';
    $message .= '</CreditCardInfo>';
    $message .= '<BuyerInfo>';
    $message .= '<firstName>'.$firstName.'</firstName>';
    $message .= '<lastName>'.$lastName.'</lastName>';
    $message .= '<zipCode>'.$zipCode.'</zipCode>';
    $message .= '<town>'.$town.'</town>';
    $message .= '<billingCountry>'.$country.'</billingCountry>';
    $message .= '<deliveryCountry>'.$country.'</deliveryCountry>';
    $message .= '<emailAddress>'.$email.'</emailAddress>';
    $message .= '<ip>'.$ip.'</ip>';
    $message .= '</BuyerInfo>';
    $message .= '</Txn>';
    $message .= '</TxnList>';
    $message .= '</Payment>';
    $message .= '</NABTransactMessage>';
    return $message;
}

function checkError($firstName, $lastName, $country, $email, $ip) {
    if (empty($ip)) return false;
    else if (empty($country)) return false;
    else if ($country != "AU") return false;
    else if (empty($firstName)) return false;
    else if (empty($lastName)) return false;
    else if (empty($email)) return false;
    else return true;
}

function postData($message, $url) {
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			//'content' => http_build_query($data)
			'content' => $message
		)
	);
	set_error_handler(function($errno, $errstr, $errfile, $errline) {
		// error was suppressed with the @-operator
		if (0 === error_reporting()) {
			return false;
		}		
		throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
	});
	try {
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		
		//return 0;
		if ($result === false) {
			return 0;
		} else {
			$xml = simplexml_load_string($result);
			$obj = (object) array('error' => false, 'message' => $xml);
			$json = json_encode($obj);
			return $json;
		}
	} catch (ErrorException $e) {
		$obj = (object) array('error' => true, 'message' => $e->getMessage());
		$json = json_encode($obj);
		return $json;
	}
}
function prepareHtml($hash) {
    if(!isset($_SESSION)) session_start();
    $replaceArray = [
        '$email_title' => 'Payment Information',
        '$email_message' => "If you haven't paid the amount, please pay to confirm your booking",
        '$appointment_service' => $_SESSION["taxServiceName"],
        '$appointment_provider' => $_SESSION["consultantName"],
        '$receipt_id' => $_POST['ReceiptId'],
        '$appointment_start_date' => $_SESSION["selectedDate"].' '.$_SESSION["selectedTime"],
        '$appointment_duration' => $_SESSION["service_duration"].' minutes',
        '$appointment_link' => 'https://policetax.com.au/appo/index.php/appointments/index/' . $hash,
        '$company_link' => 'https://www.policetax.com.au',
        '$company_name' => 'Police Tax',
        '$customer_name' => $_SESSION['fname'] . ' ' . $_SESSION['lname'],
        '$customer_email' => $_SESSION['email'],
        '$customer_phone' => $_SESSION['mob'],
        '$customer_address' => $_SESSION['street'],
        '$customer_suburb' => $_SESSION['suburb'] . ' ' . $_SESSION['city'],
        '$customer_state' => $_SESSION['state'],
        '$customer_postcode' => $_SESSION['postcode'],
        '$booked_by' => $_SESSION['fname'] . ' ' . $_SESSION['lname'],
    ];

	$html = file_get_contents('./appointment_details.php');
	$html = _replaceTemplateVariables($replaceArray, $html);
	return $html;
}
function prepareTaxedHtml($hash) {
    if(!isset($_SESSION)) session_start();
    $replaceArray = [
        '$email_title' => 'Payment Information',
        '$email_message' => "If you haven't paid the amount, please pay to confirm your booking",
        '$appointment_service' => $_SESSION["taxServiceName"],
        '$appointment_provider' => $_SESSION["consultantName"],
        '$receipt_id' => $_POST['ReceiptId'],
        '$appointment_start_date' => $_SESSION["selectedDate"].' '.$_SESSION["selectedTime"],
        '$appointment_duration' => $_SESSION["service_duration"].' minutes',
        '$appointment_link' => 'https://policetax.com.au/appo/index.php/appointments/index/' . $hash,
        '$company_link' => 'https://www.policetax.com.au',
        '$company_name' => 'Police Tax',
        '$customer_name' => $_SESSION['fname'] . ' ' . $_SESSION['lname'],
        '$customer_email' => $_SESSION['email'],
        '$customer_phone' => $_SESSION['mob'],
        '$customer_address' => $_SESSION['street'],
        '$customer_suburb' => $_SESSION['suburb'] . ' ' . $_SESSION['city'],
        '$customer_state' => $_SESSION['state'],
        '$customer_postcode' => $_SESSION['postcode'],
        '$booked_by' => $_SESSION['fname'] . ' ' . $_SESSION['lname'],
        '$year' => date("Y"),
        '$total' => $_SESSION["price"]
    ];

	$html = file_get_contents('./taxed_invoice.php');
	$html = _replaceTemplateVariables($replaceArray, $html);
	return $html;
}
function _replaceTemplateVariables(array $replaceArray, $templateHtml){
	foreach ($replaceArray as $name => $value){
		$templateHtml = str_replace($name, $value, $templateHtml);
	}
    return $templateHtml;
}
function processEmail() {
	if(!isset($_SESSION)) session_start();
	try {
	    $mail = SendMail::getSendMail();
		$mail->setSubjectAndClient($_SESSION["email"], $_SESSION["fname"].' '.$_SESSION["lname"], "Appointment Confirmation");
		$mail->setClientInfoBCC ("policetax0@gmail.com", $_SESSION["fname"].' '.$_SESSION["lname"]);
		$mail->setHTML(true);
		$current_date = new DateTime();
		$hash = md5($current_date->getTimestamp());
		$_SESSION['hash'] = $hash;
		$mail->setBodyHTMLOnly(prepareHtml($hash) );
		$mail->attach('Terms_Conditions.pdf');
		$rs2 = $mail->sendMail();
		if($rs2) {
			return "Success";
		} else {
			return $mail->getErrorInfo();
		}

	} catch (Exception $ex) {
		return $ex;
	}
}

function processTaxedEmail() {
	if(!isset($_SESSION)) session_start();
	try {
	    $mail = SendMail::getSendMail();
		$mail->setSubjectAndClient($_SESSION["email"], $_SESSION["fname"].' '.$_SESSION["lname"], "Appointment Confirmation");
		$mail->setClientInfoBCC ("policetax0@gmail.com", $_SESSION["fname"].' '.$_SESSION["lname"]);
		$mail->setHTML(true);
		$current_date = new DateTime();
		$hash = md5($current_date->getTimestamp());
		$_SESSION['hash'] = $hash;
		$mail->setBodyHTMLOnly(prepareTaxedHtml($hash) );
		$rs2 = $mail->sendMail();
		if($rs2) {
			return "Success";
		} else {
			return $mail->getErrorInfo();
		}

	} catch (Exception $ex) {
		return $ex;
	}
}

function prepareCreditCardHtml() {
	if(!isset($_SESSION)) session_start();
	$salutationAndName = $_SESSION["fname"].' '.$_SESSION["lname"];
	$packageName = "Appointment Diary Service";
	$price = $_SESSION["price"];
	$ReceiptId = $_POST['ReceiptId'];

    $paymentMessage = '<div id="mmf_container"><div id="mmf_util"></div>';
    $paymentMessage .= '<div id="mmf_header_index"><img src="https://i1.wp.com/www.alectoaustralia.com/wp-content/uploads/2016/09/NAB-Logo.png?ssl=1" alt="National Australia Bank Logo (Home)" /></div>';
    $paymentMessage .= '<div id="nab_system_menu"></div></div><div id="mmf_wrapper">';
    $date = new DateTime();
    $current_date = $date->format('d-m-Y H:i:s');
    $paymentMessage .= 'This online payment was provided by NAB HPP on ' . $current_date .' Do not reply to this auto-generated email<br/>';
    $paymentMessage .= '<table id="datatable" width="450"><tr class="header"><td colspan="2">Transaction Details</td>';
    $paymentMessage .= '</tr><tr><td class="label">Account Name</td><td class="value">AV00010</td></tr><tr><td class="label">Trading Name</td><td class="value">Accountants Plus</td></tr><tr><td class="label">Receipt Number</td><td class="value">' . $ReceiptId . '</td></tr><tr><td class="label">Payment Amount</td>';
    $paymentMessage .= '<td class="value">AUD$' . $price . '00</td>';
    $paymentMessage .= '</tr><tr><td class="label">Card Holders Name</td><td class="value">' . $salutationAndName . '</td></tr><tr><td class="label">Card Type</td><td class="value">Visa</td></tr><tr><td colspan="2" align="center">This payment has been deposited in your merchant account.</td></tr><tr><td class="label">Bank Authorisation</td><td class="value">' . $ReceiptId . '</td></tr></table><table id="datatable" width="450"><tr class="header"><td colspan="3">Order Details</td></tr><tr><td class="label">Description</td>';
    $paymentMessage .= '<td class="label">Quantity</td><td class="label">AUD$Price</td>';
    $paymentMessage .= '</tr><tr><td class="threecolvalue">' . $packageName . ' Tax | PoliceTax</td>';
    $paymentMessage .= '<td class="threecolvalue">1</td>';
    $paymentMessage .= '<td class="threecolvalue">AUD$' . $price . '.00</td>';
    $paymentMessage .= '</tr><tr><td class="label" colspan="2">Total</td>';
    $paymentMessage .= '<td class="value">AUD$' . $price . '.00</td>';
    $paymentMessage .= '	</tr><tr><td colspan="3">';
    $paymentMessage .= '<hr width="100%" /></td>';
    $paymentMessage .= '</tr><tr><td align="RIGHT" colspan="2">Surcharge Rate:</td>';
    $paymentMessage .= '	<td align="RIGHT">0%</td>';
    $paymentMessage .= '</tr><tr><td align="RIGHT" colspan="2">Surcharge Fee:</td>';
    $paymentMessage .= '	<td align="RIGHT">							AUD$ 							0						</td>					</tr><tr><td align="RIGHT" colspan="2">Surcharge:</td>';
    $paymentMessage .= '<td align="RIGHT">						AUD$						0					</td>				</tr><tr><td align="RIGHT" colspan="2"><b>Total with Surcharge:</b></td>';
    $paymentMessage .= '<td align="RIGHT">						<b>AUD$' . $price . '.00</b>					</td>';
    $paymentMessage .= '</tr><tr><td colspan="3"><hr /></td></tr></table><table id="datatable" width="450"><tr class="header"><td colspan="2">Customer Information</td></tr></table></div></div><br />';
    $paymentMessage .= "<span>Regards,</span> <br />";
    $paymentMessage .= "<span>PoliceTax</span> </body></html>";
	return $paymentMessage;
}

function processCreditCardEmail() {
	if(!isset($_SESSION)) session_start();
	try {
	    $mail = SendMail::getSendMail();
        $salutationAndName = $_SESSION["fname"].' '.$_SESSION["lname"];
        $packageName = "Appointment Diary Service";
		$mail->setSubjectAndClient($_SESSION["email"], $_SESSION["fname"].' '.$_SESSION["lname"], "Payment Receipt | " . $packageName . " | " . $salutationAndName);
		$mail->setClientInfoBCC ("policetax0@gmail.com", "Credit Card Police Tax");
		$mail->setHTML(true);
		$mail->setBodyHTMLOnly(prepareCreditCardHtml());
		$rs2 = $mail->sendMail();
		if($rs2) {
			return "Success";
		} else {
			return $mail->getErrorInfo();
		}

	} catch (Exception $ex) {
		return $ex;
	}
}



function ses($str) {
	if(isset($_SESSION[$str])) return $_SESSION[$str];
	else return "";
}
function prepareConfirmHtml() {
	if(!isset($_SESSION)) session_start();
    $html  = '<p>Client Name: ' . ses('fname') . ' ' . ses('lname') . '</p>';
    $html .= '<p>Service: ' . ses('taxServiceName') . '</p>';
    $html .= '<p>Delivered By: ' . ses('delivery') . '</p>';
    $html .= '<p>With Consultant: ' . ses('consultantName') . '</p>';
    $html .= '<p>Date Booked: ' . ses('selectedDate') . '</p>';
    $html .= '<p>Start Time: ' . ses('selectedTime') . '</p>';
    $html .= '<p>Duration: ' . ses('service_duration') . ' minutes</p>';
    $html .= '<p>Total: ' . ses('price') . ' AUD</p>';
    $html .= '<p>Receipt Number: ' . ses('ReceiptId') . '</p>';
    $html .= '<p>Tax Year: ' . ses('taxYear') . '</p>';
    $html .= '<p>Office Location: ' . ses('officeLocation') . '</p>';
    $html .= '<p>Notes to Accountant: ' . ses('notes') . '</p>';
	return $html;
}
function prepareChangeofAddressorBSBHtml() {
	if(!isset($_SESSION)) session_start();
    $html  = '<h2>Client Details: </h2>';
    $html  .= '<p>Client Name: ' . ses('fname') . ' ' . ses('lname') . '</p>';
    $html .= '<p>Service: ' . ses('taxServiceName') . '</p>';
    $html .= '<p>Delivered By: ' . ses('delivery') . '</p>';
    $html .= '<p>With Consultant: ' . ses('consultantName') . '</p>';
    $html .= '<p>Date Booked: ' . ses('selectedDate') . '</p>';
    $html .= '<p>Start Time: ' . ses('selectedTime') . '</p>';
    $html .= '<p>Duration: ' . ses('service_duration') . ' minutes</p>';
    $html .= '<p>Total: ' . ses('price') . ' AUD</p><br/><br/>';
    $html .= '<p>--------------------------------------------------</p>';
    $html  .= '<h2>Change of Address and BSB: </h2>';
    $html .= '<p>--------------------------------------------------</p>';
    $html .= '<p>Address: ' . ses('street') . '</p>';
    $html .= '<p>Suburb: ' . ses('suburb') . '</p>';
    $html .= '<p>City: ' . ses('city') . '</p>';
    $html .= '<p>State: ' . ses('state') . '</p>';
    $html .= '<p>Postcode: ' . ses('postcode') . '</p>';
	
    $html .= '<p>BSB: ' . ses('bsb') . '</p>';
	$html .= '<p>Account: ' . ses('account') . '</p>';
	return $html;
}
function processChangeofAddressorBSBEmail() {
	if(!isset($_SESSION)) session_start();
	try {
	    $mail = SendMail::getSendMail();
		$mail->setSubjectAndClient("policetax0@gmail.com", "Appointment Police Tax", "Change of Address Summary");
		$mail->setClientInfoBCC ("policetax0@gmail.com", "Appointment Police Tax");
		
		$mail->setHTML(true);
		$mail->setBodyHTMLOnly(prepareChangeofAddressorBSBHtml());
		$rs2 = $mail->sendMail();
		if($rs2) {
			return "Success";
		} else {
			return $mail->getErrorInfo();
		}

	} catch (Exception $ex) {
		return $ex;
	}
}
function processConfirmEmail() {
	if(!isset($_SESSION)) session_start();
	try {
	    $mail = SendMail::getSendMail();
		$mail->setSubjectAndClient($_SESSION["provider_email"], $_SESSION["fname"].' '.$_SESSION["lname"], "Appointment Summary");
		$mail->setClientInfoBCC ("policetax0@gmail.com", "Appointment Police Tax");
		$mail->setHTML(true);
		$mail->setBodyHTMLOnly(prepareConfirmHtml());
		$rs2 = $mail->sendMail();
		if($rs2) {
			return "Success";
		} else {
			return $mail->getErrorInfo();
		}

	} catch (Exception $ex) {
		return $ex;
	}
}

function processSaving() {
    if(!isset($_SESSION)) session_start();
	if($_SESSION["exist"] == "checked" && !empty($_SESSION['id'])) {
		$a = updateUser();
		return insertAppo();
	} else {
		$a = insertUser();
		if($a == 1) {
			$newUserId = selectNewUser();
			if(isset($newUserId->id)) {
				$_SESSION['id'] = $newUserId->id;
				return insertAppo();
			}
			else return $newUserId;
		}
		else return $a;
	}
}
function findAppo($booktime) {
	$db = Database::getDatabase(true);
	$para = array('phoneNumber' => '2021-10-01 05:55 AM');//'%d/%m/%Y %h:%i %p'
	$query = "SELECT * FROM ea_appointments WHERE book_datetime = STR_TO_DATE(':phoneNumber','%Y-%m-%d %h:%i %p')";//'2021-10-01 05:55:00'
	$rs = $db->query($query, $para);
	$arr = array();
	if(is_bool($rs)) return $query;
	else {
	    while($obj = $rs->fetch_object()) {
	    	array_push($arr, $obj);
	    }
	    $json = json_encode($arr);
	    return $json;
	}
}
function insertAppo() {
    if(!isset($_SESSION)) session_start();
	$query = "INSERT INTO ea_appointments(book_datetime, start_datetime, end_datetime, hash, id_users_provider, id_users_customer, id_services, staff_name, SendEmail, CreditCardNumber, ReceiptNumber, method, delivery, officeLocation, IsSelf ) VALUES ( CURRENT_TIMESTAMP, STR_TO_DATE(:ival2,'%d/%m/%Y %h:%i %p'), STR_TO_DATE(:ival3,'%d/%m/%Y %h:%i %p') + INTERVAL :ival4 MINUTE, :ival5, :ival6, :ival7, :ival8, :ival9, :ival10, :ival11, :ival12, :ival13, :ival14, :ival15, 1)";
	try{
	    $db_name     = DB_NAME;
	    $db_user     = DB_USERNAME;
	    $db_password = DB_PASSWORD;
	    $db_host     = DB_SERVER;
	    $pdo = new PDO('mysql:host=' . $db_host . '; dbname=' . $db_name, $db_user, $db_password);
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	    $stmt = $pdo->prepare($query);
	    $pdo->beginTransaction();
	    $selectedDate = $_SESSION["selectedDate"];
	    $selectedTime = $_SESSION["selectedTime"];
	    $startTime = $selectedDate.' '.$selectedTime;
	    $duration = $_SESSION["service_duration"];
	    $hash = $_SESSION["hash"];
	    $consultant = $_SESSION["consultant"];
	    $userId = $_SESSION['id'];
	    $service_id = $_SESSION["service_id"];
	    $taxService = $_SESSION["taxService"];
	    $consultantName = $_SESSION["consultantName"];
	    $emailSent = $_POST["emailSent"];
		$CreditCardNumber = $_POST['CreditCardNumber'];
		$ReceiptId = $_POST['ReceiptId'];
		$method = $_SESSION['howDone'];
		$delivery = $_SESSION['delivery'];
		$officeLocation = $_SESSION['officeLocation'];
	    $stmt->bindValue(':ival2', $startTime);
	    $stmt->bindValue(':ival3', $startTime);
	    $stmt->bindValue(':ival4', $duration);
	    $stmt->bindValue(':ival5', $hash);
	    $stmt->bindValue(':ival6', $consultant);
	    $stmt->bindValue(':ival7', $userId);
	    $stmt->bindValue(':ival8', $service_id);
	    $stmt->bindValue(':ival9', $consultantName);
	    $stmt->bindValue(':ival10', $emailSent);
		$stmt->bindValue(':ival11', $CreditCardNumber);
		$stmt->bindValue(':ival12', $ReceiptId);
		$stmt->bindValue(':ival13', $method);
		$stmt->bindValue(':ival14', $delivery);
		$stmt->bindValue(':ival15', $officeLocation);
	    $res = $stmt->execute();
		$pdo->commit();
		$pdo = null;
		return $res;
	} catch (PDOException $ex) {
		return $ex;
	}
}
function updateUser() {
    if(!isset($_SESSION)) session_start();
	$query = "UPDATE ea_users SET email=:uval2, mobile_number=:uval3, phone_number=:uval4, address=:uval5, suburb=:uval6, city=:uval7, bsb=:uval8, bank_account=:uval9, tfn=:uval10, spouse_yes_no=:uval11, occupation_role=:uval12, station_locale=:uval13, rank=:uval14, state=:uval15, zip_code=:uval16, married=:uval17, branch=:uval18, role=:uval19, address_changed=:uval20, bank_changed=:uval21, spouse_firstname=:uval22, spouse_lastname=:uval23 WHERE id=:uval1";
	try{
	    $db_name     = DB_NAME;
	    $db_user     = DB_USERNAME;
	    $db_password = DB_PASSWORD;
	    $db_host     = DB_SERVER;
	    $pdo = new PDO('mysql:host=' . $db_host . '; dbname=' . $db_name, $db_user, $db_password);
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	    $stmt = $pdo->prepare($query);
	    $pdo->beginTransaction();
	    $userId = $_SESSION['id'];
	    $email = $_SESSION['email'];
	    $mob = $_SESSION['mob'];
	    $street = $_SESSION["street"];
	    $suburb = $_SESSION["suburb"];
	    $city = $_SESSION["city"];
	    $bsb = $_SESSION["bsb"];
	    $account = $_SESSION["account"];
	    $tfn = $_SESSION["tfn"];
	    $spouseTax = ($_SESSION["spouseTax"] == 'checked') ? 'Yes' : 'No';
		$workSector = $_SESSION["workSector"];
		$station = $_SESSION["station"];
		$Rank = $_SESSION["Rank"];
		$state = $_SESSION["state"];
		$postcode = $_SESSION["postcode"];
		$spouse = ($_SESSION["spouse"] == 'checked') ? 'Yes' : 'No';
		$branch = $_SESSION["branch"];
		$role = $_SESSION["role"];
		$address = ($_SESSION["address"] == 'checked') ? 'Yes' : 'No';
		$bank = ($_SESSION["bank"] == 'checked') ? 'Yes' : 'No';
		$spouseFirstName = $_SESSION["spouseFirstName"];
		$spouseLastName = $_SESSION["spouseLastName"];
		$stmt->bindValue(':uval1', $userId);
	    $stmt->bindValue(':uval2', $email);
	    $stmt->bindValue(':uval3', $mob);
	    $stmt->bindValue(':uval4', $mob);
	    $stmt->bindValue(':uval5', $street);
	    $stmt->bindValue(':uval6', $suburb);
	    $stmt->bindValue(':uval7', $city);
	    $stmt->bindValue(':uval8', $bsb);
	    $stmt->bindValue(':uval9', $account);
	    $stmt->bindValue(':uval10', $tfn);
	    $stmt->bindValue(':uval11', $spouseTax);
		$stmt->bindValue(':uval12', $workSector);
		$stmt->bindValue(':uval13', $station);
		$stmt->bindValue(':uval14', $Rank);
		$stmt->bindValue(':uval15', $state);
		$stmt->bindValue(':uval16', $postcode);
		$stmt->bindValue(':uval17', $spouse);
		$stmt->bindValue(':uval18', $branch);
		$stmt->bindValue(':uval19', $role);
		$stmt->bindValue(':uval20', $address);
		$stmt->bindValue(':uval21', $bank);
		$stmt->bindValue(':uval22', $spouseFirstName);
		$stmt->bindValue(':uval23', $spouseLastName);
	    $res = $stmt->execute();
		$pdo->commit();
		$pdo = null;
		return $res;
	} catch (PDOException $ex) {
		return $ex;
	}
}
function insertUser() {
    if(!isset($_SESSION)) session_start();
	$query = "INSERT INTO ea_users(first_name, last_name, email, mobile_number, phone_number, address, suburb, city, dob, bsb, bank_account, tfn, spouse_yes_no, occupation_role, station_locale, rank, state, zip_code, id_roles, married, branch, role, address_changed, bank_changed, spouse_firstname, spouse_lastname) VALUES (:ival1, :ival2, :ival3, :ival4, :ival5, :ival6, :ival7, :ival8, :ival9, :ival10, :ival11, :ival12, :ival13, :ival14, :ival15, :ival16, :ival17, :ival18, 3, :ival19, :ival20, :ival21, :ival22, :ival23, :ival24, :ival25)";
	try{
	    $db_name     = DB_NAME;
	    $db_user     = DB_USERNAME;
	    $db_password = DB_PASSWORD;
	    $db_host     = DB_SERVER;
	    $pdo = new PDO('mysql:host=' . $db_host . '; dbname=' . $db_name, $db_user, $db_password);
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	    $stmt = $pdo->prepare($query);
	    $pdo->beginTransaction();
	    $fname = $_SESSION['fname'];
	    $lname = $_SESSION['lname'];
	    $email = $_SESSION['email'];
	    $mob = $_SESSION['mob'];
	    $street = $_SESSION["street"];
	    $suburb = $_SESSION["suburb"];
	    $city = $_SESSION["city"];
	    $dob = $_SESSION['dob'];
	    $bsb = $_SESSION["bsb"];
	    $account = $_SESSION["account"];
	    $tfn = $_SESSION["tfn"];
	    $spouseTax = ($_SESSION["spouseTax"] == 'checked') ? 'Yes' : 'No';
		$workSector = $_SESSION["workSector"];
		$station = $_SESSION["station"];
		$Rank = $_SESSION["Rank"];
		$state = $_SESSION["state"];
		$postcode = $_SESSION["postcode"];
		$spouse = ($_SESSION["spouse"] == 'checked') ? 'Yes' : 'No';
		$branch = $_SESSION["branch"];
		$role = $_SESSION["role"];
		$address = ($_SESSION["address"] == 'checked') ? 'Yes' : 'No';
		$bank = ($_SESSION["bank"] == 'checked') ? 'Yes' : 'No';
		$spouseFirstName = $_SESSION["spouseFirstName"];
		$spouseLastName = $_SESSION["spouseLastName"];
	    $stmt->bindValue(':ival1', $fname);
	    $stmt->bindValue(':ival2', $lname);
	    $stmt->bindValue(':ival3', $email);
	    $stmt->bindValue(':ival4', $mob);
	    $stmt->bindValue(':ival5', $mob);
	    $stmt->bindValue(':ival6', $street);
	    $stmt->bindValue(':ival7', $suburb);
	    $stmt->bindValue(':ival8', $city);
	    $stmt->bindValue(':ival9', $dob);
	    $stmt->bindValue(':ival10', $bsb);
		$stmt->bindValue(':ival11', $account);
		$stmt->bindValue(':ival12', $tfn);
	    $stmt->bindValue(':ival13', $spouseTax);
	    $stmt->bindValue(':ival14', $workSector);
	    $stmt->bindValue(':ival15', $station);
	    $stmt->bindValue(':ival16', $Rank);
	    $stmt->bindValue(':ival17', $state);
	    $stmt->bindValue(':ival18', $postcode);
	    $stmt->bindValue(':ival19', $spouse);
	    $stmt->bindValue(':ival20', $branch);
	    $stmt->bindValue(':ival21', $role);
	    $stmt->bindValue(':ival22', $address);
	    $stmt->bindValue(':ival23', $bank);
	    $stmt->bindValue(':ival24', $spouseFirstName);
	    $stmt->bindValue(':ival25', $spouseLastName);
	    $res = $stmt->execute();
		$pdo->commit();
		$pdo = null;
		return $res;
	} catch (PDOException $ex) {
		return $ex;
	}
}
function selectNewUser() {
	$db = Database::getDatabase(true);
	$query2 = 'SELECT MAX(id) id FROM ea_users';
	$rs2 = $db->query($query2);
	//return json_encode($rs2->fetch_object());
	return $rs2->fetch_object();
}
?>