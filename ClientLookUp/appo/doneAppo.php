<?php
require_once './database.php';
$db = Database::getDatabase(true);
$field = $_POST['field'];
$field_value = ($_POST['field_value'] == 'true') ? 1 : 0;
$id = $_POST['id'];
if( isset($_POST['estimate']) ) {
	$estimate = $_POST['estimate'];
	$hecs = $_POST['hecs'];
	$query = 'UPDATE ea_appointments SET '.$field.' = '.$field_value.', estimate = "'.$estimate.'", hecs = "'.$hecs.'" WHERE id = '.$id;
} else if( isset($_POST['delete']) ) {
	$query = 'DELETE FROM ea_appointments WHERE id = '.$id;
	//$query = 'DELETE FROM ea_appointments WHERE id = '.'999999999999999';
} else {
	$query = 'UPDATE ea_appointments SET '.$field.' = '.$field_value.' WHERE id = '.$id;
}
$rs = $db->query($query);
if( isset($_POST['iduser']) && isset($_POST['rank']) && isset($_POST['station']) && isset($_POST['years']) ) {
	$iduser = $_POST['iduser'];
	$rank = $_POST['rank'];
	$station = $_POST['station'];
	$years = $_POST['years'];
	$query2 = 'UPDATE ea_users SET rank = "'.$rank.'", station_locale = "'.$station.'", years_in_job = "'.$years.'" WHERE id = '.$iduser;
	$rs = $db->query($query2);
}
?>