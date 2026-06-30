<?php
date_default_timezone_set('Australia/Melbourne');
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

$content = $_POST['Content'];
$appointmentId = $_POST['Id'];
$messageId = $_POST['MessageId'];

$sql = "INSERT INTO tblSMSData(AppointmentId, Content, MessageId, CreatedDate)
VALUES  ('" . $appointmentId . "', '" . $content . "', '" . $messageId . "', '" . date("Y-m-d") . "')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("true",$newid));
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>
