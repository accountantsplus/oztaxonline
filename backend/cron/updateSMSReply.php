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

$reply = $_POST['SMSReply'];
$messageId = $_POST['MessageId'];

$sql = "UPDATE `tblSMSData` SET SMSReply = '" . $reply . "' where MessageId='" . $messageId . "'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo json_encode(array("true",$row["JsonValue"]));;
    }
} else {
    echo "false";
}
$conn->close();

?>
