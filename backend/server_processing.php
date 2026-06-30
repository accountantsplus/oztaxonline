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


if($_POST['filter'] == "PotentialClient"){
    $condition = " and HasPaymentDone = '0' and filemakerData = ''";
}else if($_POST['filter'] == "SubmitError"){
    $condition = " and HasFinalSubmit = '0'";
}else if($_POST['filter'] == "Complete"){
    $condition = " and HasFinalSubmit = '1'";
}else if($_POST['filter'] == "TaxProcessed"){
    $condition = " and HasProcessed = '1' and HasPaymentDone <> '0'";
}else if($_POST['filter'] == "TaxNotProcessed"){
    $condition = " and (HasProcessed <> '1' or HasProcessed is null) and HasPaymentDone <> '0'";
}
$searchText = "";


$sql = "SELECT *, WEEK(date(STR_TO_DATE(ModifiedDate, '%d/%m/%Y %H:%i:%s'))) as 'Week', STR_TO_DATE(ModifiedDate, '%d/%m/%Y %H:%i:%s') as 'ModDate' FROM " . $table . " where JsonValue not like '%test%' and (YEAR(date(STR_TO_DATE(ModifiedDate, '%d/%m/%Y %H:%i:%s'))) >= YEAR(CURDATE()) - 1 and MONTH(date(STR_TO_DATE(ModifiedDate, '%d/%m/%Y %H:%i:%s'))) >= 5)  or (YEAR(date(STR_TO_DATE(ModifiedDate, '%d/%m/%Y %H:%i:%s'))) >= YEAR(CURDATE()) and MONTH(date(STR_TO_DATE(ModifiedDate, '%d/%m/%Y %H:%i:%s'))) < 5) and jsonvalue not like '%asd%' " . $condition . $searchText;
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
