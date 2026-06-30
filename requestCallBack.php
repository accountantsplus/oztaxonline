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

$table = "tblWebsite_Occupation";

$sql = "SELECT Id FROM tblWebsite_Occupation WHERE Name like '%police%'";

$result = $conn->query($sql);
$occupationId = "";
if ($result->num_rows > 0) {
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $occupationId = $row["Id"];
  }
}

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$state = $_POST['state'];
$subject = $_POST['subject'];
$postcode = $_POST['postcode'];
$contactby = $_POST['contactby'];
$bestTime = $_POST['bestTime'];
$notes = $_POST['notes'];
$requestFrom = $_POST['requestFrom'];
$additionalField = $_POST['additionalField'];
$newid = uniqid();
$sql = "INSERT INTO tblRequestCallBack(Id, FirstName, LastName, OccupationId, Email, Mobile, State, AdditionalField, Postcode, RequestFrom, Subject, ContactBy, BestTime, Notes, HasGotBack, IsActive, CreatedDate, ModifiedDate)
VALUES  ('" . $newid . "', '" . $firstName . "', '" . $lastName . "', '" . $occupationId . "', '" . $email . "', '" . $mobile . "', '" . $state . "', '" . $additionalField . "', '" . $postcode . "', '" . $requestFrom . "', '" . $subject . "', '" . $contactby . "', '" . $bestTime . "', '" . $notes . "', 'No', '1', '" . date("d/m/Y") . " " . date("h:i:sa") . "', '" . date("d/m/Y") .  " " . date("h:i:sa") . "')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("true",$newid));
} else {
    echo "Error: " . $sql . "<br>" . $occupationId .$conn->error;
}
$conn->close();

?>
