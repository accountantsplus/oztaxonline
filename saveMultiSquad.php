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
$squadEmail = $_POST['SquadEmail'];
$squadNumber = $_POST['SquadNumber'];
$newid = uniqid();
$unique = uniqid('', true);
$code = "SQFRE" . substr($unique, strlen($unique) - 4, strlen($unique));

$sql = "INSERT INTO tblMultiSquad(Id, SquadId, SquadLeaderName, SquadLeaderEmail, SquadLeaderPhone, TotalSquadMembers, EmailList, IsDeleted, CreatedDate, ModifiedDate)
VALUES  ('" . $newid . "', '" . $squadId . "', '" . $fullName . "', '" . $email . "', '" . $mobile . "', '" . $squadNumber . "', '" . $squadEmail . "', '0', '" . date("Y-m-d") . "', '" . date("Y-m-d") . "')";

$sqlPromo = "INSERT INTO tblPromoCodeInfo(Name, Price, Code, TotalNumber, AppliedDate, IsActive, Percentage, IsMultiSquad, MultiSquadId, TotalCount, CreatedDate, ModifiedDate)
    VALUES  ('Multi Squad Tax', '0', '" . $code . "', '100', '" . date("Y-m-d") . "', '1', '10', '1', '" . $newid . "', '". $squadNumber . "','" . date("d/m/Y") . " " . date("h:i:sa") . "', '" . date("d/m/Y") .  " " . date("h:i:sa") . "')";


if ($conn->query($sql) === TRUE) {
    if ($conn->query($sqlPromo) === TRUE) {
        echo json_encode(array("true",$newid,$code));
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>
