<?php

include "config.php";

$data = $_POST['data'];

$sql = "INSERT INTO click_to_call (MobileNumber, CallStatus)
VALUES ($data, '1')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
}else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>