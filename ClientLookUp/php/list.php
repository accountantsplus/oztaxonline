<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ClientLookUp";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM LookUp";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "HT_Ref: " . $row["HT_Ref"]. " - Name: " . $row["FirstName"]. " " . $row["Surname"]. " - TFN: " . $row["TFN"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>