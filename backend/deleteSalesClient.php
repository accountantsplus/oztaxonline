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

$id = $_POST['id'];
$table = "tblPromoCodeInfo";


$sql = "Update tblSalesClient SET IsDelete = '1' where id = '" . $id . "'";

$result = $conn->query($sql);


if ($conn->query($sql) === TRUE) {
    echo json_encode(array("true"));
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>
