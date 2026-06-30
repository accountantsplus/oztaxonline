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

$table = "tblRequestCallBack";
$condition = "";
$likeCondition = "police";
if($_POST['occupation'] == "AirlineTax"){
    $likeCondition = "airline";
}else if($_POST['occupation'] == "DefenceForceTax"){
    $likeCondition = "defence";
}else if($_POST['occupation'] == "NurseTax"){
    $likeCondition = "nurse";
}else if($_POST['occupation'] == "TeachersTax"){
    $likeCondition = "teachers";
}else if($_POST['occupation'] == "TradiesTax"){
    $likeCondition = "tradies";
}else if($_POST['occupation'] == "All"){
    $likeCondition = "";
}


$sql = "SELECT Id FROM tblWebsite_Occupation WHERE Name like '%" . $likeCondition . "%'";

$result = $conn->query($sql);
$occupationId = "";
if ($result->num_rows > 0) {
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $occupationId = $row["Id"];
  }
}


$sql = "SELECT tblRequestCallBack.*, STR_TO_DATE(tblRequestCallBack.ModifiedDate,'%d/%m/%Y %H:%i:%s') as 'ModDate', o.Name as 'Occupation' FROM " . $table;
$sql .= " INNER JOIN tblWebsite_Occupation o ON o.Id = tblRequestCallBack.occupationId";
$sql .= " where tblRequestCallBack.isactive = '1' and tblRequestCallBack.firstname not like '%test%' and tblRequestCallBack.isactive = '1' and tblRequestCallBack.lastname not like '%asd%'";

if($likeCondition != "")
{
    $sql .= " and OccupationId = '" . $occupationId . "'";
}

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
