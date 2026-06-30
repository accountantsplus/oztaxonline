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

$table = "ea_users";
$condition = "";
$searchText = "";


$sql = "SELECT * FROM `ea_users` where dob is null or dob= '' and first_name not like '%asd%'" . $condition . $searchText;
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
