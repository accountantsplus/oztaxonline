<?php

require_once './database.php';
$db = Database::getDatabase(true);
$action = $_POST["action"];
if($action == 'selectuser') {
	$id = $_POST['id'];
	$query = "SELECT * FROM ea_users WHERE id = ".$id;
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
	$_SESSION["address"] = $_POST['address'];
	$_SESSION["spouse"] = $_POST['spouse'];
	$_SESSION["bank"] = $_POST['bank'];
	$_SESSION["spouseTax"] = $_POST['spouseTax'];
	$_SESSION["workSector"] = $_POST['workSector'];
	$_SESSION["station"] = $_POST['station'];
	$_SESSION["Rank"] = $_POST['Rank'];
	$_SESSION["branch"] = $_POST['branch'];
	$_SESSION["role"] = $_POST['role'];
	$_SESSION["spouseFirstName"] = $_POST['spouseFirstName'];
	$_SESSION["spouseLastName"] = $_POST['spouseLastName'];
	$_SESSION["spouseDOB"] = $_POST['spouseDOB'];
	
	if($_POST['street'] != ''){
		$_SESSION["street"] = $_POST['street'];
		$_SESSION["suburb"] = $_POST['suburb'];
		$_SESSION["city"] = $_POST['city'];
		$_SESSION["state"] = $_POST['state'];
		$_SESSION["postcode"] = $_POST['postcode'];
		$_SESSION["bsb"] = $_POST['bsb'];
		$_SESSION["account"] = $_POST['account'];
	}
} if($action == 'select_jobs') {
}

?>