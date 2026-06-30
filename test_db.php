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

$jsonVal = $_POST['userdata'];
$newid = uniqid();
$sql = "INSERT INTO tblFormValuePoliceTax(Id, JsonValue, CreatedDate, ModifiedDate)
VALUES  ('" . $newid . "', '" . $jsonVal . "', '" . date("d/m/Y") . " " . date("h:i:sa") . "', '" . date("d/m/Y") .  " " . date("h:i:sa") . "')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("true",$newid));
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>
