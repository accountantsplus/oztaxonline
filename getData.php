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

$id = $_POST['returnid'];
$sql = "SELECT * FROM tblFormValuePoliceTax where Id='" . $id . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo json_encode(array("true",$row["JsonValue"], $row["HasCreditCardEmail"], $row["ValidationCode"], $row["ValidationLifeline"], date("d/m/Y")));
    }
} else {
    echo "false";
}

$conn->close();

?>
