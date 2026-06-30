<?php

require_once './database.php';
$db = Database::getDatabase(true);
$period = $_POST['period'];
if($period == 'month')
$query = "SELECT COUNT(*) FROM ea_appointments WHERE id_users_customer IS NOT NULL AND is_done = 0 AND YEAR(start_datetime) = YEAR(CURDATE()) AND MONTH(start_datetime) = MONTH(CURDATE())";
else if($period == 'week')
$query = "SELECT COUNT(*) FROM ea_appointments WHERE id_users_customer IS NOT NULL AND is_done = 0 AND YEAR(start_datetime) = YEAR(CURDATE()) AND IF(DAYOFWEEK(CURDATE()) = 1, WEEK(start_datetime) = WEEK(CURDATE()) - 1, WEEK(start_datetime) = WEEK(CURDATE()))";
else if($period == 'today')
$query = "SELECT COUNT(*) FROM ea_appointments WHERE id_users_customer IS NOT NULL AND is_done = 0 AND DATE(start_datetime) = DATE(CURDATE())";
else if($period == 'tomorrow')
$query = "SELECT COUNT(*) FROM ea_appointments WHERE id_users_customer IS NOT NULL AND is_done = 0 AND DATE(start_datetime) = DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
else if($period == 'new')
$query = "SELECT COUNT(*) FROM ea_appointments WHERE id_users_customer IS NOT NULL AND is_done = 0 AND (promo = 0 OR wre = 0 OR pf = 0 OR bsb = 0) AND start_datetime >= CURRENT_TIMESTAMP()";
$rs = $db->query($query);
$arr = array();
if(is_bool($rs)) echo $query;
else echo $db->getValue();
?>