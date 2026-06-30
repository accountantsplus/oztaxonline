<?php
require_once './database.php';
$db = Database::getDatabase(true);
$arr = array();
$query = "SELECT Ref, Status, DateAdded FROM lookup";
$rs = $db->query($query);
if(is_bool($rs)) echo $query;
else {
    while($obj = $rs->fetch_object()) {
    	array_push($arr, $obj);
    }
}
$arr2 = array();
$query = "SELECT Ref, Status, DateAdded FROM amended";
$rs = $db->query($query);
if(is_bool($rs)) echo $query;
else {
    while($obj = $rs->fetch_object()) {
    	array_push($arr2, $obj);
    }
}
$result = array_merge($arr, $arr2);
$json = json_encode($result);
echo $json;
?>