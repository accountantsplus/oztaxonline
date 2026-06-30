<?php

require_once './database.php';
$db = Database::getDatabase(true);
$action = $_POST['action'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$dob = $_POST['dob'];
if($action == 'selectuser') {
	$query = "SELECT * FROM ea_users WHERE LOWER(first_name) = LOWER('".$fname."') AND LOWER(last_name) = LOWER('".$lname."') AND dob = '".$dob."'";
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
	$_SESSION["new"] = $_POST['new'];
	$_SESSION["id"] = $_POST['id'];
	$_SESSION["fname"] = $_POST['fname'];
	$_SESSION["lname"] = $_POST['lname'];
	$_SESSION["dob"] = $_POST['dob'];
	$_SESSION["email"] = $_POST['email'];
	$_SESSION["mob"] = $_POST['mob'];
	$_SESSION["tfn"] = $_POST['tfn'];
	
	if($_POST['exist'] != 'checked'){
		$_SESSION["street"] = $_POST['street'];
		$_SESSION["suburb"] = $_POST['suburb'];
		$_SESSION["city"] = $_POST['city'];
		$_SESSION["state"] = $_POST['state'];
		$_SESSION["postcode"] = $_POST['postcode'];
		$_SESSION["bsb"] = $_POST['bsb'];
		$_SESSION["account"] = $_POST['account'];
	}
	
	$_SESSION["loggedin"] = true;
}
?>