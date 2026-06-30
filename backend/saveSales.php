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
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$leadSource = $_POST['leadSource'];
$leadStatus = $_POST['leadStatus'];
$meetingNotes = $_POST['meetingNotes'];
$callStatus = $_POST['callStatus'];
$appointmentStatus = $_POST['appointmentStatus'];
$followupNotes = $_POST['followupNotes'];
$isFollowUpRequired = $_POST['isFollowUpRequired'];
$communicationPreference = $_POST['communicationPreference'];
$appointmentDate = $_POST['appointmentDate'];
$followupDate = $_POST['followupDate'];
$notes = $_POST['notes'];
$salesClientId = $_POST['salesClientId'];
$newid = uniqid();

$sql = "INSERT INTO tblSalesAppointment(Id, SalesClientId, FirstName, LastName, Email, Phone, LeadSource, LeadStatus, MeetingNotes, 
            CallStatus, LastContactedDate, AppointmentStatus, AppointmentDate, 
            FollowupNotes, IsFollowUpRequired, FollowupDate, Notes, CommunicationPreference, IsDelete, CreatedDate, CreatedById, UpdatedDate)
VALUES  ('" . $newid . "', '" . $salesClientId . "', '" . $firstName . "', '" . $lastName . "', '" . $email . "', '" . $phone . "', '" . $leadSource . "', '" . $leadStatus . "', '" . $meetingNotes . "'
            , '" . $callStatus . "', '" . date("Y-m-d") . "', '" . $appointmentStatus . "', '" . $appointmentDate . "', 
            '" . $followupNotes . "', '" . $isFollowUpRequired . "', '" . $followupDate . "', '" . $notes . "', '" . $communicationPreference . "', '0', '" . date("Y-m-d") . "', '" . $_SESSION["user"] . "', '" . date("Y-m-d") . "')";

if($id != ""){

    $sql = "UPDATE tblSalesAppointment SET FirstName='" . $firstName . "', LastName='" . $lastName . "', Email='" . $email . "', Phone='" . $phone . "', LeadSource='" . $leadSource . "'
    , LeadStatus='" . $leadStatus . "', MeetingNotes='" . $meetingNotes . "', CallStatus='" . $callStatus . "', LastContactedDate='" . date("Y-m-d") . "', AppointmentStatus='" . $appointmentStatus . "', AppointmentDate='" . $appointmentDate . "', FollowupDate='" . $followupDate . "'
    , FollowupNotes='" . $followupNotes . "', IsFollowUpRequired='" . $isFollowUpRequired . "', FollowupDate='" . date("Y-m-d") . "', Notes='" . $notes . "', CommunicationPreference='" . $communicationPreference . "', IsDelete = '0', UpdatedById = '" . $_SESSION["user"] . "', UpdatedDate = '" . date("Y-m-d") . "' where Id='" . $id . "'";
}

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("true",$newid));
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>
