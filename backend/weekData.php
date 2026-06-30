<?php

$servername = "localhost";
$username = "accoun40_root";
$password = "Dusty@0007";
$dbName = "accoun40_accounta_PoliceTax";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$table = "tblFormValuePoliceTax";
$condition = "";
if($_POST['occupation'] == "AirlineTax"){
    $table = "tblFormValueAirlineTax";
}else if($_POST['occupation'] == "DefenceForceTax"){
    $table = "tblFormValueDefenceTax";
}else if($_POST['occupation'] == "NurseTax"){
    $table = "tblFormValue";
}else if($_POST['occupation'] == "TeachersTax"){
    $table = "tblFormValueTeachersTax";
}else if($_POST['occupation'] == "TradiesTax"){
    $table = "tblFormValueTradiesTax";
}else if($_POST['occupation'] == "AussieTax"){
    $table = "tblFormValueAussieTax";
}

$selectedYear = $_POST['years'];
$futureYear = $_POST['years'] + 1;
$fullyear = $selectedYear . "-07-01";
$fullfutureyear = $futureYear . "-07-01";

$condition = " and date(STR_TO_DATE(CreatedDate, '%d/%m/%Y %H:%i:%s')) >= '" . $fullyear . "' and date(STR_TO_DATE(CreatedDate, '%d/%m/%Y %H:%i:%s')) < '" . $fullfutureyear ."'";
$condition .= " and HasPaymentDone = '1' and filemakerData <> '' GROUP BY CONCAT(YEAR(date(STR_TO_DATE(CreatedDate, '%d/%m/%Y %H:%i:%s'))), '/', WEEK(date(STR_TO_DATE(CreatedDate, '%d/%m/%Y %H:%i:%s'))))";

$sql = "SELECT *, DATE(DATE(date(STR_TO_DATE(CreatedDate, '%d/%m/%Y %H:%i:%s'))) + INTERVAL (7 - DAYOFWEEK(DATE(date(STR_TO_DATE(CreatedDate, '%d/%m/%Y %H:%i:%s'))))) DAY) as 'EndingDate', CONCAT(YEAR(date(STR_TO_DATE(CreatedDate, '%d/%m/%Y %H:%i:%s'))), '/', WEEK(date(STR_TO_DATE(CreatedDate, '%d/%m/%Y %H:%i:%s')))) as 'YearWeek', WEEK(date(STR_TO_DATE(CreatedDate, '%d/%m/%Y %H:%i:%s'))) as 'Week', count(*) as 'Total' FROM " . $table . " where JsonValue not like '%test%' and jsonvalue not like '%asd%' " . $condition;
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
