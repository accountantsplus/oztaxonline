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

$name = $_POST['Name'];
$email = $_POST['Email'];
$phone = $_POST['Phone'];
$dob = $_POST['Dob'];

$sql = "INSERT INTO Bulk_Email(name, email, phone, DOB, CreatedDate)
VALUES  ('" . $name . "', '" . $email . "', '" . $phone . "', STR_TO_DATE('$dob', '%d/%m/%Y'), CURDATE())";


if ($conn->query($sql) === TRUE) {
    echo json_encode(array("true",$newid));
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>
