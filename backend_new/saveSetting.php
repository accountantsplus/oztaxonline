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

$id = $_POST['id'];
$fieldName = $_POST['fieldName'];
$fieldValue = $_POST['fieldValue'];
$occupationId = $_POST['occupationId'];
$newid = uniqid();

$sql = "INSERT INTO tblWebsite_Packages(Id, OccupationId, FieldName, FieldValues, CreatedDate, ModifiedDate)
VALUES  ('" . $newid . "', '" . $occupationId . "', '" . $fieldName . "', '" . $fieldValue . "', '" . date("d/m/Y") . " " . date("h:i:sa") . "', '" . date("d/m/Y") .  " " . date("h:i:sa") . "')";

if($id != ""){

    $sql = "UPDATE tblWebsite_Packages SET OccupationId='" . $occupationId . "', FieldName='" . $fieldName . "', FieldValues='" . $fieldValue . "', ModifiedDate = '" . date("d/m/Y") . " " . date("h:i:sa") . "' where Id='" . $id . "'";
}

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("true",$newid));
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>
