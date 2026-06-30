<?php

require_once './database.php';
$db = Database::getDatabase(true);
$action = $_POST['action'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$dob = $_POST['dob'];
if($action == 'selectuser') {
	$query = "SELECT * FROM ea_users WHERE first_name LIKE '%".$fname."%' AND last_name LIKE '%".$lname."%' AND dob = STR_TO_DATE('".$dob."','%d/%m/%Y')";
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
} if($action == 'session') {
	if(!isset($_SESSION)) session_start();
	$_SESSION["exist"] = $_POST['exist'];
	$_SESSION["fname"] = $_POST['fname'];
	$_SESSION["lname"] = $_POST['lname'];
	$_SESSION["dob"] = $_POST['dob'];
	$_SESSION["email"] = $_POST['email'];
	$_SESSION["mob"] = $_POST['mob'];
	$_SESSION["tfn"] = $_POST['tfn'];
}
?>