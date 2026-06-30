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
$fieldPrice = $_POST['fieldPrice'];
$fieldCode = $_POST['fieldCode'];
$fieldTotalNumber = $_POST['fieldTotalNumber'];
$fieldAppliedDate = $_POST['fieldAppliedDate'];
$fieldExpiryDate = $_POST['fieldExpiryDate'];
$occupationId = $_POST['occupationId'];
$newid = uniqid();

$sql = "INSERT INTO tblPromoCodeInfo(OccupationId, Name, Price, Code, TotalNumber, AppliedDate, ExpiryDate, IsActive, CreatedDate, ModifiedDate)
VALUES  ('" . $occupationId . "', '" . $fieldName . "', '" . $fieldPrice . "', '" . $fieldCode . "', '" . $fieldTotalNumber . "', '" . $fieldAppliedDate . "', '" . $fieldExpiryDate . "', '1', '" . date("Y-m-d") . "', '" . date("Y-m-d") . "')";

if($id != ""){

    $sql = "UPDATE tblPromoCodeInfo SET OccupationId='" . $occupationId . "', Name='" . $fieldName . "', AppliedDate='" . $fieldAppliedDate . "', ExpiryDate='" . $fieldExpiryDate . "', IsActive = '1', TotalNumber='" . $fieldTotalNumber . "', Price='" . $fieldPrice . "', Code='" . $fieldCode . "', ModifiedDate = '" . date("Y-m-d") . "' where Id='" . $id . "'";
}

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("true",$newid));
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>
