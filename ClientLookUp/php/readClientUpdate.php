<?php
require_once './database.php';
$db = Database::getDatabase(true);
$query = "SELECT * FROM clientupdate";
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
?>