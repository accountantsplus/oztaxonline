<?php

$servername = "localhost";
$username = "accoun40_root";
$password = "Dusty@0007";
$dbName = "accoun40_accounta_scheduler_tax";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$table = "ea_appointments";
$condition = "";
$selectedYear = $_POST['years'];
$futureYear = $_POST['years'] + 1;
$fullyear = $selectedYear . "-07-01";
$fullfutureyear = $futureYear . "-07-01";

$condition = " date(start_datetime) >= '" . $fullyear . "' and date(start_datetime) < '" . $fullfutureyear ."'";
$condition .= " GROUP BY CONCAT(YEAR(date(start_datetime)), '/', WEEK(date(start_datetime)))";
$sql = "SELECT *, DATE(DATE(start_datetime) + INTERVAL (7 - DAYOFWEEK(DATE(start_datetime))) DAY) as 'EndingDate', CONCAT(YEAR(start_datetime), '/', WEEK(date(start_datetime))) as 'YearWeek', WEEK(date(start_datetime)) as 'Week', count(*) as 'Total' FROM " . $table . " where " . $condition;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
      $data[] = $row;
    }
    
    $results = ["sEcho" => 1,
        	"iTotalRecords" => count($data),
        	"iTotalDisplayRecords" => count($data),
        	"aaData" => $data ];

    echo json_encode($results);
} else {
    echo "false";
}

$conn->close();

?>
