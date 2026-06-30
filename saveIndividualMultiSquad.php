<?php
date_default_timezone_set('Australia/Melbourne');
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

$squadId = $_POST['SquadId'];
$fullName = $_POST['FullName'];
$mobile = $_POST['Mobile'];
$email = $_POST['Email'];
$newid = uniqid();

$sql = "INSERT INTO tblMultiSquadDetails(Id, MultiSquadId, Name, Email, Phone, IsActive, CreatedDate, UpdatedDate)
VALUES  ('" . $newid . "', '" . $squadId . "', '" . $fullName . "', '" . $email . "', '" . $mobile . "', '1', '" . date("Y-m-d") . "', '" . date("Y-m-d") . "')";

if ($conn->query($sql) === TRUE) {
    $sqlData = "SELECT Code FROM tblPromoCodeInfo where MultiSquadId = '" . $squadId . "'";
    
    $result = $conn->query($sqlData);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
          $data[] = $row;
        }
        echo json_encode(array("true",$newid,$data[0]));
    }else{
        echo "false";
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>
