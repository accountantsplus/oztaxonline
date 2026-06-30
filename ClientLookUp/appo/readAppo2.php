<?php

require_once './database.php';
$db = Database::getDatabase(true);
$rs = $db->query("USE accoun40_accounta_scheduler_tax");

$query = "SELECT ea_appointments.id id, start_datetime, end_datetime, TIMEDIFF(end_datetime, start_datetime) AS duration, MOD(HOUR(TIMEDIFF(end_datetime, start_datetime)), 24) hours, MINUTE(TIMEDIFF(end_datetime, start_datetime)) minutes, first_name, last_name, email, phone_number, address, suburb, city, id_users_customer, ea_services.name service_name, attendants_number, rental_property, rank, station_locale, years_in_job, is_done, estimate, hecs, count(ea_appointments.id) OVER() full_count FROM ea_appointments LEFT JOIN ea_users ON ea_appointments.id_users_customer = ea_users.id LEFT JOIN ea_services ON ea_appointments.id_services = ea_services.id WHERE id_users_customer IS NOT NULL AND is_done = 0 AND YEAR(start_datetime) = YEAR(CURDATE()) AND MONTH(start_datetime) = MONTH(CURDATE()) ORDER BY start_datetime DESC LIMIT 10 OFFSET 0";

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