<?php

require_once './database2.php';
$db = Database::getDatabase(true);
$action = $_POST['action'];
if($action == 'promocode') {
	$promo_code = $_POST['promo_code'];
	$query = "SELECT * FROM tblPromoCodeInfo WHERE code = '".$promo_code."' AND isactive = 1 And AppliedDate <='" . date("Y-m-d") . "' And (ExpiryDate is NULL or ExpiryDate >= '" . date("Y-m-d") . "')";
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
	$_SESSION["name"] = $_POST['name'];
	$_SESSION["number"] = $_POST['number'];	
	$_SESSION["exp"] = $_POST['exp'];
	$_SESSION["cvv"] = $_POST['cvv'];
}
?>