<?php
require_once './database.php';
require_once '../cron/encdec.php';
$db = Database::getDatabase(true);
$arr = array();
$limit = $_POST['limit'];
$offset = $_POST['offset'];
$where = "WHERE a.Ref <> 'Ref'";
$para = array('limit' => $limit, 'offset' => $offset);
if( isset($_POST['status']) ) {
	$status = $_POST['status'];
	$where .= " AND a.Status = :status";
	$para['status'] = $status;
}
if( isset($_POST['clientName']) ) {
	$clientName = $_POST['clientName'];
	$where .= " AND (l.FirstName LIKE '%:clientName%' OR l.LastName LIKE '%:clientName%')";
	$para['clientName'] = $clientName;
}
if( isset($_POST['phoneNumber']) ) {
	$phoneNumber = $_POST['phoneNumber'];
	$where .= " AND (l.MobileNo LIKE '%:phoneNumber%' OR l.PhoneNo LIKE '%:phoneNumber%')";
	$para['phoneNumber'] = $phoneNumber;
}
if( isset($_POST['clientEmail']) ) {
	$clientEmail = $_POST['clientEmail'];
	$where .= " AND (l.EMail LIKE '%:clientEmail%')";
	$para['clientEmail'] = $clientEmail;
}
if( isset($_POST['clientPostcode']) ) {
	$clientPostcode = $_POST['clientPostcode'];
	$where .= " AND (l.PostCode LIKE '%:clientPostcode%')";
	$para['clientPostcode'] = $clientPostcode;
}
$order = '';
if( isset($_POST['order']) ) {
	$order = " ORDER BY a." . $_POST['order'].", l." . $_POST['order'];	
	if( isset($_POST['desc']) ) $order = " ORDER BY a." . $_POST['order']." DESC, l." . $_POST['order'] . " DESC";
}
$query = "SELECT l.*, a.Status,a.Refund,a.Estimate,a.TaxIncome,a.LodgeDate,a.OccCode,a.OccDescription, (select count(*) from amended) as full_count FROM amended a LEFT JOIN lookup l ON a.Ref = l.Ref " . $where . $order . " LIMIT :limit OFFSET :offset";
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