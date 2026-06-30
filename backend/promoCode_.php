<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

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

$table = "tblPromoCodeInfo";

$code = $_POST['code'];
$price = (float)$_POST['price'];
$sql = "SELECT price FROM tblPromoCodeInfo where IsActive = '1' and code = '" . $code . "'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
      $data[] = $row;
    }
    
    foreach($data as $key=>$val){
      $discountPrice = $val["price"];
    }
    $priceData = number_format((float)($price - (($discountPrice * $price) / 100)), 2, '.', '');
    $dateFormat = "YmdHis"; //set the date format
    $timeNdate = gmdate($dateFormat, time()); //get GMT date - 4
    $dateReference = "dmY";
    $testReference = gmdate($dateReference, time());
    $str = "AV00010|w1VKorgi|0|" . $testReference . "|" . $priceData . "|" . $timeNdate;
    $timeStampValue = sha1($str);
    
    $results = ["sEcho" => 1,
        	"iTotalRecords" => count($data),
        	"iTotalDisplayRecords" => count($data),
        	"aaData" => $data,
            "timeNDate" => $timeNdate,
            "testReference" => $testReference,
            "price" => $priceData,
            "str" => $str,
            "timeStampValue" => $timeStampValue ];

    echo json_encode($results);
} else {
    echo "false";
}

$conn->close();

?>
