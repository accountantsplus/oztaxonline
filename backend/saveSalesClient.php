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
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$suburb = $_POST['suburb'];
$postCode = $_POST['postCode'];
$state = $_POST['state'];
$country = $_POST['country'];
$industry = $_POST['industry'];
$isSendEmail = $_POST['isSendEmail'];
$notes = $_POST['notes'];
$companyName = $_POST['companyName'];
$potentialBusiness = $_POST['potentialBusiness'];
$communicationPreference = $_POST['communicationPreference'];
$newid = uniqid();

$filename = $_POST['fileName'];
$ceofilename = $_POST['ceoPictureName'];
if ( 0 < $_FILES['file']['error'] ) {
    
} else {
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/salesClient/' . $newid . $_FILES['file']['name']);
    
    
    if($_FILES['file']['name'] != ""){
     
    $filename = 'uploads/salesClient/' . $newid . $_FILES['file']['name'];
    }
}
if ( 0 < $_FILES['ceoPicture']['error'] ) {
    
} else {
    move_uploaded_file($_FILES['ceoPicture']['tmp_name'], 'uploads/salesClient/' . $newid . $_FILES['ceoPicture']['name']);
    
    if($_FILES['ceoPicture']['name'] != ""){
     
    $ceofilename = 'uploads/salesClient/' . $newid . $_FILES['ceoPicture']['name'];   
    }
}

$sql = "INSERT INTO tblSalesClient(Id, Name, CompanyName, PotentialBusiness, Notes, Email, Phone, Address, Suburb, Postcode, 
            CompanyLogo, CEOPicture, State, Country, Industry, IsSendEmail, CommunicationPreference, IsDelete, CreatedDate, CreatedById)
VALUES  ('" . $newid . "', '" . $name . "', '" . $companyName . "', '" . $potentialBusiness . "', '" . $notes . "', '" . $email . "', '" . $phone . "', '" . $address . "', '" . $suburb . "', '" . $postCode . "'
            , '"  . $filename . "', '"  . $ceofilename . "', '" . $state . "', '" . $country . "', '" . $industry . "', '" . $isSendEmail . "', '" . $communicationPreference . "', '0', '" . date("Y-m-d") . "', '" . $_SESSION["user"] . "')";

if($id != ""){

    $sql = "UPDATE tblSalesClient SET Name='" . $name . "', PotentialBusiness='" . $potentialBusiness . "', CompanyName='" . $companyName . "', Notes='" . $notes . "', Email='" . $email . "', Phone='" . $phone . "', Address='" . $address . "'
    , Suburb='" . $suburb . "', Postcode='" . $postCode . "', State='" . $state . "', Country='" . $country . "', Industry='" . $industry . "', IsSendEmail='" . $isSendEmail . "'
    , CompanyLogo='"  . $filename . "', CEOPicture='"  . $ceofilename . "', CommunicationPreference='" . $communicationPreference . "', IsDelete = '0' where Id='" . $id . "'";
}

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("true",$newid));
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>
