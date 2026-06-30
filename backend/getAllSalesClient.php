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

$table = "tblSalesAppointment";
$condition = "";
$additionalSearch = "";

if($_POST['filter'] != ""){
    $condition = " and occ.PotentialBusiness = '" . $_POST['filter'] .  "'";
}

if($_POST['clientSearch'] != ""){
    $additionalSearch = " and (occ.Name like '%" . $_POST['clientSearch'] .  "%' or occ.CompanyName like '%" . $_POST['clientSearch'] .  "%')";
}


$sql = "SELECT occ.* FROM tblSalesClient occ where occ.IsDelete = '0' " . $condition . $additionalSearch;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
      $data[] = $row;
    }
    
    $results = ["sEcho" => 1,
        	"iTotalRecords" => count($data),
        	"iTotalDisplayRecords" => count($data),
        	"query" => $sql,
        	"aaData" => $data ];

    echo json_encode($results);
} else {
    echo "false";
}

$conn->close();

?>
