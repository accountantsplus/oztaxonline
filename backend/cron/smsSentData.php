<?php

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

$table = "ea_users";

$sql = "select smsData.Content, smsData.SMSReply, smsData.CreatedDate as 'SMSsent', user.first_name, user.last_name, user.email, user.mobile_number, user.phone_number, accountant.first_name as 'accountant_firstname', accountant.last_name as 'accountant_lastname', appoint.* from tblSMSData smsData 
inner join ea_appointments appoint on appoint.id = smsData.AppointmentId 
inner join ea_users user on user.Id = appoint.id_users_customer
inner join ea_users accountant on accountant.Id = appoint.id_users_provider
where start_datetime > (NOW()) and end_datetime <= (NOW() + INTERVAL 1 DAY) order by appoint.start_datetime asc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
      $data[] = $row;
    }
    
    $results = ["sEcho" => 1,
        	"iTotalRecords" => count($data),
        	"iTotalDisplayRecords" => count($data),
        	"aaData" => $data ];

    echo json_encode($results);
} else {
    echo "false";
}

$conn->close();

?>
