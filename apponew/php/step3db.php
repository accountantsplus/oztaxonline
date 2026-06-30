<?php

require_once './database.php';
$db = Database::getDatabase(true);
$action = $_POST['action'];
if($action == 'consultantQuery') {
	//$query = "select DISTINCT id_users, first_name, last_name, email from ea_services_providers LEFT JOIN ea_users us ON id_users = id WHERE IsActive = 1 ORDER BY IsMain DESC";
	$query = "select DISTINCT id_users, first_name, last_name, email from ea_services_providers LEFT JOIN ea_users us ON id_users = id";
	$rs = $db->query($query);
	$arr = array();
	if(is_bool($rs)) echo $query;
	else {
		while($obj = $rs->fetch_object()) {
			array_push($arr, $obj);
		}
		$json = json_encode($arr);
		echo $json;
	}
} else if($action == 'consultantChange') {
	$id = $_POST['id'];
	$query = "SELECT id_users, id_services, se.name name, se.description description, se.duration duration, se.price price, sc.name service_category_names FROM ea_services_providers LEFT JOIN ea_services se ON id_services = se.id JOIN ea_service_categories sc ON se.id_service_categories = sc.id WHERE id_users = ".$id;
	$rs = $db->query($query);
	$arr = array();
	if(is_bool($rs)) echo $query;
	else {
		while($obj = $rs->fetch_object()) {
			array_push($arr, $obj);
		}
		$json = json_encode($arr);
		echo $json;
	}
} else if($action == 'timeGap') {
	$provider_id = $_POST['provider_id'];
	$selectedDate = $_POST['selectedDate'];
	$service_duration = $_POST['service_duration'];
	$query = "SELECT ea_user_settings.id_users, ea_user_settings.working_plan, ea_appointments.id id, TIME(start_datetime), TIME(end_datetime), HOUR(start_datetime) shour, MINUTE(start_datetime) smin, HOUR(end_datetime) ehour, MINUTE(end_datetime) emin FROM ea_appointments JOIN ea_user_settings on ea_user_settings.id_users = ea_appointments.id_users_provider WHERE id_users_provider = ".$provider_id." AND DATE(start_datetime) = STR_TO_DATE('".$selectedDate."','%d/%m/%Y') ORDER BY start_datetime";
	//$query = "SELECT ea_appointments.id id, TIME(start_datetime), TIME(end_datetime), HOUR(start_datetime) shour, MINUTE(start_datetime) smin, HOUR(end_datetime) ehour, MINUTE(end_datetime) emin FROM ea_appointments WHERE id_users_provider = ".$provider_id." AND DATE(start_datetime) = STR_TO_DATE('14/07/2020','%d/%m/%Y') ORDER BY start_datetime";
	$rs = $db->query($query);
	$arr = array();
	if(is_bool($rs)) echo $query;
	else {
		while($obj = $rs->fetch_object()) {
			array_push($arr, $obj);
		}
		$json = json_encode($arr);
		echo $json;
	}
} else if($action == 'companyWorking') {
	$query = "SELECT * FROM ea_settings";
	$rs = $db->query($query);
	$arr = array();
	if(is_bool($rs)) echo $query;
	else {
		while($obj = $rs->fetch_object()) {
			array_push($arr, $obj);
		}
		$json = json_encode($arr);
		echo $json;
	}
}  else if($action == 'bookingTimeOut') {
	$query = "SELECT value FROM ea_settings WHERE id = 2";
	$rs = $db->query($query);
	$arr = array();
	if(is_bool($rs)) echo $query;
	else {
		while($obj = $rs->fetch_object()) {
			array_push($arr, $obj);
		}
		$json = json_encode($arr);
		echo $json;
	}
}  else if($action == 'getServicesOptions') {
	$service_id = $_POST['service_id'];
	$query = "SELECT * FROM ea_services_options WHERE service_id = ".$service_id;
	$rs = $db->query($query);
	$arr = array();
	if(is_bool($rs)) echo $query;
	else {
		while($obj = $rs->fetch_object()) {
			array_push($arr, $obj);
		}
		$json = json_encode($arr);
		echo $json;
	}
} else if($action == 'session') {
	if(!isset($_SESSION)) session_start();
	$_SESSION["howDone"] = $_POST['howDone'];
	$_SESSION["provider_id"] = $_POST['provider_id'];
	$_SESSION["provider_email"] = $_POST['provider_email'];
	$_SESSION["consultant"] = $_POST['consultant'];
	$_SESSION["consultantName"] = $_POST['consultantName'];
	$_SESSION["delivery"] = $_POST['delivery'];
	$_SESSION["noAttend"] = $_POST['noAttend'];
	$_SESSION["service_id"] = $_POST['service_id'];
	$_SESSION["taxService"] = $_POST['taxService'];	
	$_SESSION["taxServiceName"] = $_POST['taxServiceName'];
	$_SESSION["taxServiceDescription"] = $_POST['taxServiceDescription'];
	$_SESSION["selectedDate"] = $_POST['selectedDate'];
	$_SESSION["selectedTime"] = $_POST['selectedTime'];
	$_SESSION["service_duration"] = $_POST['service_duration'];
	$_SESSION["initialprice"] = $_POST['price'];
	$_SESSION["discountamount"] = ((intval($_POST['price']) * 5)/100);
	$_SESSION["price"] = $_POST['price'] - ((intval($_POST['price']) * 5)/100);
	$_SESSION["spouseFirstName"] = $_POST['spouseFirstName'];
	$_SESSION["spouseLastName"] = $_POST['spouseLastName'];
	$_SESSION["spouseDOB"] = $_POST['spouseDOB'];
	$_SESSION["taxYear"] = $_POST['taxYear'];
	$_SESSION["officeLocation"] = $_POST['officeLocation'];
	$_SESSION["notes"] = $_POST['notes'];
}
?>