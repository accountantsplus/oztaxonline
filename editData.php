<?php
date_default_timezone_set('Australia/Melbourne');
$servername = "localhost";
$username = "accoun40_root";
$password = "Dusty@0007";
$dbName = "accoun40_accounta_PoliceTax";
$Today=date('d/m/Y');

// add 3 days to date
$NewDate=Date('d/m/Y', strtotime("+2 days"));


// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$fileMaker = $_POST['filemakerData'];
$submit = $_POST['from'];
$sql = "UPDATE tblFormValuePoliceTax SET FileMakerData='" . $fileMaker . "', ModifiedDate = '" . date("d/m/Y") . " " . date("h:i:sa") . "' where Id='" . $id . "'";

if($submit == "finalSubmit"){
$sql = "UPDATE tblFormValuePoliceTax SET HasFinalSubmit = '1', ModifiedDate = '" . date("d/m/Y") . " " . date("h:i:sa") . "' where Id='" . $id . "'";
}else if($submit == "confirmPayment"){
$bankid = $_POST['bankid'];
$sql = "UPDATE tblFormValuePoliceTax SET HasPaymentDone = '1', BankAuthorization = '" . $bankid . "', ModifiedDate = '" . date("d/m/Y") . " " . date("h:i:sa") . "' where Id='" . $id . "'";
}else if($submit == "CreditCardSubmit"){
    $validity = $_POST['validity'];
    $hasValidTime = $_POST['hasValidTime'];
    if($hasValidTime == "1"){
        
        $sql = "UPDATE tblFormValuePoliceTax SET HasCreditCardEmail = '1', ValidationCode = '" . $validity . "', ValidationLifeline = '" . $NewDate . " " . date("h:i:sa") . "', ModifiedDate = '" . date("d/m/Y") . " " . date("h:i:sa") . "' where Id='" . $id . "'";
    }else{
        
        $sql = "UPDATE tblFormValuePoliceTax SET HasCreditCardEmail = '1', ModifiedDate = '" . date("d/m/Y") . " " . date("h:i:sa") . "' where Id='" . $id . "'";
    }
}else if($submit == "ExpenseSubmit"){
    $sql = "UPDATE tblFormValuePoliceTax SET HasExpenses = '1', ModifiedDate = '" . date("d/m/Y") . " " . date("h:i:sa") . "' where Id='" . $id . "'";
}
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
