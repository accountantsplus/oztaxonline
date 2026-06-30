<?php
// Start the session

     session_start();
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

$username = strtolower($_POST['username']);
$password = md5($_POST['pass']);
$sql = "SELECT * FROM tblUserLogin where Username='" . $username . "' and Password='" . $password . "'";

// echo strtolower($_POST['username']);
// echo md5($_POST['pass']);

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $_SESSION["user"] = $row["Username"];
    }
    
    header("Location: home");
    exit;
} else {
    //echo "Error";
    header("Location: https://www.policetax.com.au/backend/login");
    exit;
}

$conn->close();

?>
