<?php
require_once './database.php';
require_once '../cron/encdec.php';
$db = Database::getDatabase(true);
$arr = array();
$limit = $_POST['limit'];
$offset = $_POST['offset'];
$where = "WHERE Ref <> 'Ref'";
$para = array('limit' => $limit, 'offset' => $offset);
if( isset($_POST['status']) ) {
	$status = $_POST['status'];
	$where .= " AND Status = :status";
	$para['status'] = $status;
}
if( isset($_POST['clientName']) ) {
	$clientName = $_POST['clientName'];
	$where .= " AND (FirstName LIKE '%:clientName%' OR LastName LIKE '%:clientName%')";
	$para['clientName'] = $clientName;
}
if( isset($_POST['phoneNumber']) ) {
	$phoneNumber = $_POST['phoneNumber'];
	$where .= " AND (MobileNo LIKE '%:phoneNumber%' OR PhoneNo LIKE '%:phoneNumber%')";
	$para['phoneNumber'] = $phoneNumber;
}
if( isset($_POST['clientEmail']) ) {
	$clientEmail = $_POST['clientEmail'];
	$where .= " AND (EMail LIKE '%:clientEmail%')";
	$para['clientEmail'] = $clientEmail;
}
if( isset($_POST['clientPostcode']) ) {
	$clientPostcode = $_POST['clientPostcode'];
	$where .= " AND (PostCode LIKE '%:clientPostcode%')";
	$para['clientPostcode'] = $clientPostcode;
}
$order = '';
if( isset($_POST['order']) ) {
	$order = " ORDER BY " . $_POST['order'];
	if( isset($_POST['desc']) ) $order = $order . " DESC"; 
}
$query = "SELECT *, (select count(*) from lookup) as full_count FROM lookup " . $where . $order . " LIMIT :limit OFFSET :offset";
$rs = $db->query($query, $para);
if(is_bool($rs)) echo $query;
else {
    while($obj = $rs->fetch_object()) {
    	$obj->TFN = encrypt_decrypt('decrypt', $obj->TFN);
    	array_push($arr, $obj);
    }
    $json = json_encode($arr);
    echo $json;
}
?>