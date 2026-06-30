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

$table = "tblWebsite_Packages";

$code = $_POST['code'];
$price = $_POST['price'];
$sql = "SELECT * FROM tblWebsite_Packages inner join tblWebsite_Occupation on tblWebsite_Occupation.Id = tblWebsite_Packages.OccupationId where tblWebsite_Occupation.Name='Police'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
      $data[] = $row;
    }
    
    $results = ["sEcho" => 1,
        	"iTotalRecords" => count($data),
        	"iTotalDisplayRecords" => count($data),
        	"success" => true,
        	"aaData" => $data ];

    echo json_encode($results);
} else {
    echo "false";
}

$conn->close();

?>
