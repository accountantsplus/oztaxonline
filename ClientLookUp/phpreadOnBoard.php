<?php
/*
require_once './database.php';
$db = Database::getDatabase(true);
//$fromDate = $_POST['fromDate'];
//$toDate = $_POST['toDate'];
//$query = "SELECT Ref, LodgeDate FROM lookup WHERE (LodgeDate BETWEEN STR_TO_DATE('".$fromDate."','%d/%m/%Y') AND STR_TO_DATE('".$toDate."','%d/%m/%Y')) GROUP BY LodgeDate ORDER BY LodgeDate DESC";
//$query = 'SELECT COUNT(Ref) AS Count, WEEK(LodgeDate) AS Week FROM lookup WHERE LodgeDate >= IF(CURDATE()>DATE(CONCAT(YEAR(CURDATE()),"-07-01")), DATE(CONCAT(YEAR(CURDATE()),"-07-01")), DATE(CONCAT(YEAR(CURDATE()) - 1,"-07-01"))) GROUP BY Week LIMIT 3 OFFSET 6';
$query = 'SELECT COUNT(Ref) AS Count, WEEK(LodgeDate) AS Week, YEAR(LodgeDate) AS Year, DATE(LodgeDate + INTERVAL (6 - WEEKDAY(LodgeDate)) DAY) AS WeekEnding FROM lookup WHERE LodgeDate >= IF(CURDATE()>DATE(CONCAT(YEAR(CURDATE()),"-07-01")), DATE(CONCAT(YEAR(CURDATE()),"-07-01")), DATE(CONCAT(YEAR(CURDATE()) - 1,"-07-01"))) GROUP BY Week';
$rs = $db->query($query);
$arr = array();
if(is_bool($rs)) echo $query;
else {
    while($obj = $rs->fetch_object()) {
    	array_push($arr, $obj);
    }
	$json = json_encode($arr);
    echo $json;
}*/
?>

<?php
require_once './database.php';
$db = Database::getDatabase(true);
$query = 'SELECT (select count(*) from lookup) as Count, WEEK(LodgeDate, 1) AS Week, YEAR(LodgeDate) AS Year, DATE(LodgeDate + INTERVAL (6 - WEEKDAY(LodgeDate)) DAY) AS WeekEnding FROM lookup WHERE LodgeDate >= IF(CURDATE()>DATE(CONCAT(YEAR(CURDATE()) - 2,"-07-01")), DATE(CONCAT(YEAR(CURDATE()) - 2,"-07-01")), DATE(CONCAT(YEAR(CURDATE()) - 1 - 2,"-07-01"))) GROUP BY Week, LodgeDate';
$rs = $db->query($query);
$arr = array();
if(is_bool($rs)) echo $query;
else {
    while($obj = $rs->fetch_object()) {
    	array_push($arr, $obj);
    }
}
$query2 = 'SELECT (select count(*) from amended) as Count, WEEK(LodgeDate, 1) AS Week, YEAR(LodgeDate) AS Year, DATE(LodgeDate + INTERVAL (6 - WEEKDAY(LodgeDate)) DAY) AS WeekEnding FROM amended WHERE LodgeDate >= IF(CURDATE()>DATE(CONCAT(YEAR(CURDATE()) - 2,"-07-01")), DATE(CONCAT(YEAR(CURDATE()) - 2,"-07-01")), DATE(CONCAT(YEAR(CURDATE()) - 1 - 2,"-07-01"))) GROUP BY Week, LodgeDate';
$rs2 = $db->query($query2);
$arr2 = array();
if(is_bool($rs2)) echo $query2;
else {
    while($obj = $rs2->fetch_object()) {
    	array_push($arr2, $obj);
    }
}
$merge = array_merge($arr, $arr2);
$result = array();
foreach ($merge as $obj) {
	if (array_key_exists($obj->WeekEnding, $result)) {
		$result[$obj->WeekEnding]->Count += $obj->Count;
	} else {
		$result[$obj->WeekEnding] = $obj;
	}
}
$result2 = array();
foreach ($result as $key => $value) {
	array_push($result2, $value);
}
$json = json_encode($result2);
echo $json;
?>