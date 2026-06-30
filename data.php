<?php
//setting header to json
header('Content-Type: application/json');

//database
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'accoun40_root');
define('DB_PASSWORD', 'Dusty@007');
define('DB_NAME', 'accoun40_accounta_sampledatabase1');

//get connection
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$mysqli) {
    die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = sprintf("select id, count(id) from ea_appointments where start_datetime >= '1500' and book_datetime > '20200101' group by start_datetime");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
