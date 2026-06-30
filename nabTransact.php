<?php
//$merchantId="4H70010"; //first account
$merchantId="AV00010";//Accountants Plus Pty Ltd
//$merchantId="AV00110";//Benson
$dateFormat="YmdHis"; //set the date format
  $timeNdate=gmdate($dateFormat, time()); //get GMT date - 4
$dateReference = "dmY";
$testReference = gmdate($dateReference, time());
//echo $timeNdate;
//$str = "4H70010|Bdb9uV42|0|" . $testReference . "|"; //first account
$str = "AV00010|w1VKorgi|0|" . $testReference . "|";//Accountants Plus Pty Ltd
//$str = "AV00110|zSjln57o|0|" . $testReference . "|";//Benson
$url = filter_input(INPUT_GET, 'package', FILTER_SANITIZE_URL);



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

$table = "tblWebsite_Packages";


$sql = "SELECT tblWebsite_Packages.FieldValues FROM tblWebsite_Packages inner join tblWebsite_Occupation occ on occ.Id = tblWebsite_Packages.OccupationId ";
$sql .= "WHERE occ.Name like '%police%' and tblWebsite_Packages.FieldName like '%" . $url . "%'";

$result = $conn->query($sql);
$price = "125";
if ($result->num_rows > 0) {
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $price = $row["FieldValues"];
  }
}

$str .= $price . ".00|" . $timeNdate;
$price .= ".00";
// if($url == "budget"){
// $str .= $price . ".00|" . $timeNdate;
// }else if($url == "express"){
// $str .= $price . ".00|" . $timeNdate;
// }else if($url == "standard"){
// $str .= "99.00|" . $timeNdate;
// }else if($url == "premium"){
// $str .= "125.00|" . $timeNdate;
// }else if($url == "rental"){
// $str .= "175.00|" . $timeNdate;
// }else if($url == "soleTrader"){
// $str .= "195.00|" . $timeNdate;
// }else if($url == "newRecruit"){
// $str .= "155.00|" . $timeNdate;
// }else if($url == "spouse"){
// $str .= "75.00|" . $timeNdate;
// }else if($url == "kids"){
// $str .= "35.00|" . $timeNdate;
// }else if($url == "multiFix"){
// $str .= "195.00|" . $timeNdate;
// }
$timeStampValue= sha1($str);

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <title> NAB Transact</title>
		<link rel="icon" href="favicon.png" type="image/png" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
<style>
body {
  font-family: Arial;
  font-size: 17px !important;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text], input[type=number], select {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
  font-size:15px !important;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #548ce5;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
-webkit-appearance: none;
-moz-appearance: none;
}

.btn:hover {
  background-color: #3f83f1;
}

a {
  color: #2196F3;
}
#ccnum-error{
    position: absolute;
    margin-top: -86px;
    margin-left: 119px;
    color: red;

}
#expmonth-error, #expiryYear-error, #email-error{
    position: absolute;
    margin-top: -86px;
    margin-left: 68px;
    color: red;

}

#cvv-error, #fname-error{
    position: absolute;
    margin-top: -86px;
    margin-left: 88px;
    color: red;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  position: absolute;
  top: 40%;
  left: 50%;
  z-index: 100;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}
#loading {
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  position: fixed;
  display: block;
  opacity: 0.7;
  background-color: #fff;
  z-index: 99;
  text-align: center;
}
/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</head>
<body>
    <div id="loading" style="display:none;">
     <div class="loader"></div> 
    </div>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form id="myform" method="post"  action="">
                <input type="hidden" id="hasDiscounted" value="0" />
<input type="hidden" name="EPS_MERCHANT" value="<?php echo($merchantId);?>">
<input type="hidden" name="EPS_TXNTYPE" value="0">
<input type="hidden" name="EPS_REFERENCEID" value="<?php echo($testReference);?>">
<input type="hidden" name="EPS_TIMESTAMP" value="<?php echo($timeNdate);?>">
<input type="hidden" name="EPS_FINGERPRINT" value="<?php echo($timeStampValue);?>">
<input type="hidden" name="EPS_REDIRECT" value="TRUE">
<input type="hidden" name="EPS_AMOUNT" value="<?php echo($price);?>">
      
        <div class="row">
          <div class="col-50">
            <h3>Contact Detail</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Full Name">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="Email">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="Address">
            <label for="city"><i class="fa fa-institution"></i> Suburb</label>
            <input type="text" id="city" name="city" placeholder="Suburb">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="State">
              </div>
              <div class="col-50">
                <label for="zip">Post Code</label>
                <input type="text" id="zip" name="zip" placeholder="Post Code">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <div class="icon-container" style="margin-top: 44px;">
              <i class="fa fa-cc-visa" style="color:#0157a2;"></i>
              <i class="fa fa-cc-amex" style="color:#007bc1;"></i>
              <i class="fa fa-cc-mastercard" style="color:#0a3a82;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="Name on Card">
            <label for="ccnum">Credit card number</label>
            <input type="text" class="left" maxlength="19" data-stripe="number" id="ccnum" name="EPS_CARDNUMBER" placeholder="Card Number">
            <label for="expmonth">Exp Month</label>
            <input type="number" id="expmonth" name="EPS_EXPIRYMONTH" placeholder="MM">
            <div class="row">
              <div class="col-50">
                <label for="expiryYear">Exp Year</label>
                <input type="hidden" id="expyear" name="EPS_EXPIRYYEAR" placeholder="YYYY">
                <select id="expiryYear" name="yearSelect">
                    <!--<option>Select</option>-->
                </select>
              </div>
              <div class="col-50">
                <label for="cvv">Security Code</label>
                <input type="number" id="cvv" name="EPS_CCV" placeholder="Security Code">
              </div>
            </div>
          </div>
          
        </div>
        
        <input type="submit" value="Continue to Complete your tax return" class="btn btn-complete">
      </form>
    </div>
  </div>
  
<div class="col-25">

<img src="/img/imgs-form/NAB3.jpg" style="width:36%;" />
<img src="/img/logos/credit-cards.png" style="width: 50%;margin-left: 10%;">
    <div class="container">
<div id="product_price">
      <h4>Product <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>1</b></span></h4>
      
    </div>
    </div>
<div class="">
</div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
 	<script src="https://www.google.com/recaptcha/api.js?render=6Ld-ODkfAAAAAGvOlu7s5LolENGPaFoT_axSv1ii"></script>
<script>
document.querySelector('#ccnum').oninput = function () {
    var foo = this.value.split(" ").join("");
    if (foo.length > 0) {
        foo = foo.match(new RegExp('.{1,4}', 'g')).join(" ");
    }
    this.value = foo;
};
// just for the demos, avoids form submit
jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-Z ]+$/i.test(value);
}, "Please enter a valid Full Name");
jQuery.validator.addMethod("yearSelect", function(value, element) {
    if ($('#expiryYear option:selected').text() == 'Select') {
        return false;
    } else {
        return true;
    } 
}, "Please select a valid Year");
$( "#myform" ).validate({
  rules: {
    EPS_CARDNUMBER: {
      required: true,
      creditcard: true
    },
    EPS_EXPIRYMONTH: {
      required: true,
      number: true,
max: 12,
min:1,
minlength: 2,
maxlength:2
    },
    yearSelect: {
      required: true,
    },
EPS_CCV: {
      required: true,
      number: true,

minlength: 3,
maxlength:3
    },
    firstname: {
      required: true,
lettersonly: true
    },
    email: {
      required: true,
email: true
    }
  }
});



$(document).ready(function(){
  var fullname = "";
  var currentTime = new Date();
  var inityear = currentTime.getFullYear();
  var price = $("input[name='EPS_AMOUNT']").val();
  for(var i=0; i< 15; i++){
    $("#expiryYear").append($('<option>', {value:inityear, text:inityear}));
    inityear += 1;
  }

  $.post("getData.php", {returnid: getUrlParameter('sessionid')}, function(response){
    response = JSON.parse(response);

    console.log(response);

    if(response[0] == "true"){
      var jsondata = JSON.parse(response[1]);
      $.each(jsondata, function(i, v){
        if(i == "FirstName"){
          fullname  += v + " "; 
          $("form").append('<input type="hidden" name="EPS_FIRSTNAME" value="' + v + '">');
        }
        else if(i == "SurName"){
          
          fullname  += v + " "; 
          $("form").append('<input type="hidden" name="EPS_LASTNAME" value="' + v + '">');
        }
        else if(i == "Email"){
          $("#email").val(v); 
            $("form").append('<input type="hidden" name="EPS_EMAILADDRESS" value="' + v + '">');
        }

        else if(i == "StreetAddress"){
          $("#adr").val(v); }
        else if(i == "Suburb"){
          $("#city").val(v); }
        else if(i == "State"){
          if(v != "select"){
            $("#state").val(v); 
          }
        }
        else if(i == "PostCode"){
          $("#zip").val(v);
        }
      });
    }

    $("#fname").val(fullname);
  });



  var package = getUrlParameter('package');
  //console.log(package);
  if(package == "budget"){
    var userid = getUrlParameter('sessionid');
    $("#product_price").append('<p><a href="packages-menu" target="_blank">Budget Tax</a> <span class="price">$' + price + '</span></p>  <p>Discount Code<span><input type="text" id="discountCode"><button type="button" value="Apply" class="pull-right btn btn-applyDiscount" style="width: 40%;">Apply Discount</button></span></p><br/><br/>    <hr>      <p>Total <span class="price" style="color:black"><b>$' + price + '</b></span></p>');
    // $("form").append('<input type="hidden" name="EPS_AMOUNT" value="39.00">');
    $("form").append('<input type="hidden" name="EPS_RESULTURL" value="https://www.policetax.com.au/new-budget-tax?returnval=' + userid  + '">');

  }else if(package == "express"){
    var userid = getUrlParameter('sessionid');
    $("#product_price").append('<p><a href="packages-menu" target="_blank">Express Tax</a> <span class="price">$' + price + '</span></p>  <p>Discount Code<span><input type="text" id="discountCode"><button type="button" value="Apply" class="pull-right btn btn-applyDiscount" style="width: 40%;">Apply Discount</button></span></p><br/><br/>       <hr>      <p>Total <span class="price" style="color:black"><b>$' + price + '</b></span></p>');
    // $("form").append('<input type="hidden" name="EPS_AMOUNT" value="69.00">');
    $("form").append('<input type="hidden" name="EPS_RESULTURL" value="https://www.policetax.com.au/packages?packageName=' + package + '&returnval=' + userid  + '">');
  }else if(package == "standard"){
    var userid = getUrlParameter('sessionid');
    $("#product_price").append('<p><a href="packages-menu" target="_blank">Standard Tax</a> <span class="price">$' + price + '</span></p>  <p>Discount Code<span><input type="text" id="discountCode"><button type="button" value="Apply" class="pull-right btn btn-applyDiscount" style="width: 40%;">Apply Discount</button></span></p><br/><br/>       <hr>      <p>Total <span class="price" style="color:black"><b>$' + price + '</b></span></p>');
    // $("form").append('<input type="hidden" name="EPS_AMOUNT" value="99.00">');
    $("form").append('<input type="hidden" name="EPS_RESULTURL" value="https://www.policetax.com.au/packages?packageName=' + package + '&returnval=' + userid  + '">');
  }else if(package == "premium"){
    var userid = getUrlParameter('sessionid');
    $("#product_price").append('<p><a href="packages-menu" target="_blank">Premium Plus Tax</a> <span class="price">$' + price + '</span></p> <p>Discount Code<span><input type="text" id="discountCode"><button type="button" value="Apply" class="pull-right btn btn-applyDiscount" style="width: 40%;">Apply Discount</button></span></p><br/><br/>        <hr>      <p>Total <span class="price" style="color:black"><b>$' + price + '</b></span></p>');
    // $("form").append('<input type="hidden" name="EPS_AMOUNT" value="125.00">');
    $("form").append('<input type="hidden" name="EPS_RESULTURL" value="https://www.policetax.com.au/packages?packageName=' + package + '&returnval=' + userid  + '">');
  }else if(package == "rental"){
    var userid = getUrlParameter('sessionid');
    $("#product_price").append('<p><a href="packages-menu" target="_blank">Rental Plus Tax</a> <span class="price">$' + price + '</span></p>  <p>Discount Code<span><input type="text" id="discountCode"><button type="button" value="Apply" class="pull-right btn btn-applyDiscount" style="width: 40%;">Apply Discount</button></span></p><br/><br/>       <hr>      <p>Total <span class="price" style="color:black"><b>$' + price + '</b></span></p>');
    // $("form").append('<input type="hidden" name="EPS_AMOUNT" value="175.00">');
    $("form").append('<input type="hidden" name="EPS_RESULTURL" value="https://www.policetax.com.au/packages?packageName=' + package + '&returnval=' + userid  + '">');
  }else if(package == "soleTrader"){
  var userid = getUrlParameter('sessionid');
    $("#product_price").append('<p><a href="packages-menu" target="_blank">Sole Trader Tax</a> <span class="price">$' + price + '</span></p>  <p>Discount Code<span><input type="text" id="discountCode"><button type="button" value="Apply" class="pull-right btn btn-applyDiscount" style="width: 40%;">Apply Discount</button></span></p><br/><br/>       <hr>      <p>Total <span class="price" style="color:black"><b>$' + price + '</b></span></p>');
    // $("form").append('<input type="hidden" name="EPS_AMOUNT" value="195.00">');
    $("form").append('<input type="hidden" name="EPS_RESULTURL" value="https://www.policetax.com.au/packages?packageName=' + package + '&returnval=' + userid  + '">');
  }else if(package == "spouse"){
    var userid = getUrlParameter('sessionid');
    $("#product_price").append('<p><a href="packages-menu" target="_blank">Spouse/Family Tax</a> <span class="price">$' + price + '</span></p>  <p>Discount Code<span><input type="text" id="discountCode"><button type="button" value="Apply" class="pull-right btn btn-applyDiscount" style="width: 40%;">Apply Discount</button></span></p><br/><br/>       <hr>      <p>Total <span class="price" style="color:black"><b>$' + price + '</b></span></p>');
    // $("form").append('<input type="hidden" name="EPS_AMOUNT" value="75.00">');
    $("form").append('<input type="hidden" name="EPS_RESULTURL" value="https://www.policetax.com.au/packages?packageName=' + package + '&returnval=' + userid  + '">');
  }else if(package == "kids"){
    var userid = getUrlParameter('sessionid');
    $("#product_price").append('<p><a href="packages-menu" target="_blank">Young/Adult Tax</a> <span class="price">$' + price + '</span></p> <p>Discount Code<span><input type="text" id="discountCode"><button type="button" value="Apply Discount" class="pull-right btn btn-applyDiscount" style="width: 40%;">Apply Discount</button></span></p><br/><br/>        <hr>      <p>Total <span class="price" style="color:black"><b>$' + price + '</b></span></p>');
    // $("form").append('<input type="hidden" name="EPS_AMOUNT" value="35.00">');
    $("form").append('<input type="hidden" name="EPS_RESULTURL" value="https://www.policetax.com.au/packages?packageName=' + package + '&returnval=' + userid  + '">');
  }else if(package == "multiFix"){
    var userid = getUrlParameter('sessionid');
    $("#product_price").append('<p><a href="packages-menu" target="_blank">Multi Fix Tax</a> <span class="price">$' + price + '</span></p>  <p>Discount Code<span><input type="text" id="discountCode"><button type="button" value="Apply" class="pull-right btn btn-applyDiscount" style="width: 40%;">Apply Discount</button></span></p><br/><br/>       <hr>      <p>Total <span class="price" style="color:black"><b>$' + price + '</b></span></p>');
    // $("form").append('<input type="hidden" name="EPS_AMOUNT" value="195.00">');
    $("form").append('<input type="hidden" name="EPS_RESULTURL" value="https://www.policetax.com.au/packages?packageName=' + package + '&returnval=' + userid  + '">');
  }else if(package == "newRecruit"){
    var userid = getUrlParameter('sessionid');
    $("#product_price").append('<p><a href="packages-menu" target="_blank">New Recruit Tax</a> <span class="price">$' + price + '</span></p>  <p>Discount Code<span><input type="text" id="discountCode"><button type="button" value="Apply" class="pull-right btn btn-applyDiscount" style="width: 40%;">Apply Discount</button></span></p><br/><br/>       <hr>      <p>Total <span class="price" style="color:black"><b>$' + price + '</b></span></p>');
    // $("form").append('<input type="hidden" name="EPS_AMOUNT" value="155.00">');
    $("form").append('<input type="hidden" name="EPS_RESULTURL" value="https://www.policetax.com.au/packages?packageName=' + package + '&returnval=' + userid  + '">');
  }

      //document.getElementById("myForm").submit();
});

var getUrlParameter = function(prop){
  var params = {};
  var search = decodeURIComponent( window.location.href.slice( window.location.href.indexOf( '?' ) + 1 ) );
  var definitions = search.split( '&' );

  definitions.forEach( function( val, key ) {
    var parts = val.split( '=', 2 );
    params[ parts[ 0 ] ] = parts[ 1 ];
  });

  return ( prop && prop in params ) ? params[ prop ] : params;
}

$("input[type='submit']").on("click", function(){
  if($("form").valid() == true ) {
    var ccnumArray = $("#ccnum").val().split(" ");
    var selectedYear = $("#expiryYear option:selected").val();
    var ccnum = ccnumArray[0] + ccnumArray[1] + ccnumArray[2] + ccnumArray[3];
    //console.log(ccnum);
    //$(".btn").remove();
    $("#ccnum").val(ccnum);
    $("#expyear").val(selectedYear);
    processPayment();
  }

});


function processPayment() {
    $("#loading").show();
	var amount = $('input[name="EPS_AMOUNT"]').val();
	var cardNumber = $('#ccnum').val();
	var cvv = $('#cvv').val();
	var firstname = $("#fname").val().split(" ")[0];
	var lastname = $("#fname").val().split(" ")[1];
	var email = $("#email").val();
	var expiryDate = $('#expmonth').val() + "/" + $("#expyear").val().substring(2, 4);
	var cardHolderName = $('#cname').val();
	var sendData = { 'action':'sendPayment', 'fname': firstname, 'lname': lastname, 'email': email, 'amount': amount, 'cardNumber': cardNumber, 'cvv': cvv, 'expiryDate': expiryDate, 'cardHolderName': cardHolderName  };	
	if(typeof(grecaptcha) == "undefined") {
		alert('Please check your network and try again.');
        $("#loading").hide();
		return;
	}
    grecaptcha.ready(function() {
        grecaptcha.execute('6Ld-ODkfAAAAAGvOlu7s5LolENGPaFoT_axSv1ii', {action: 'submit'}).then(function(token) {
            sendData.token = token;
        	$.ajax({
        		url: 'https://www.policetax.com.au/apponew/php/sendp.php',
        		data: sendData,
        		type: 'POST',
        		success: function(data, sstatus) {
                    $("#loading").hide();
        			if(sstatus == 404) {
        				alert('The payment failed. Please check your network and try again.');
                        $("#loading").hide();
        				return;
        			}
        			if(data == '0') {
        				alert('The payment failed. Please try again with another credit card or contact your bank.');
                        $("#loading").hide();
        			} else {
        				var json = {};
        				try {
        					json = JSON.parse(data);
        				} catch (err) {
        					alert('There is some unknown error. Please try again.');
                            $("#loading").hide();
        					return;
        				}
        				var error = false;
        				var errorMessage = null;
        				if(json.error == null || json.error == true) error = true;
        				else {
        					var status = json.message.Status;
        					if(status == null) error = true;
        					else {
        						var statusCode = status.statusCode;
        						if(statusCode != "000") {
        							error = true;
        							errorMessage = status.statusDescription;
        						}
        						
        					}
        				}
        				if(error) {
        					if(errorMessage != null) alert('There is error: ' + errorMessage + '. Please try again.');
        					else alert('There is unknown error. Please try again.');
        					
                            $("#loading").hide();
        				} else {
        					var payment = json.message.Payment;
        					if(payment != null) {
        						var txnList = payment.TxnList;
        						if(txnList != null) {
        							var Txn = txnList.Txn;
        							if(Txn != null && Txn.approved == "No") {
        								error = true;
        								alert('There is error: ' + Txn.responseText + '. Please try again.');
                                        $("#loading").hide();
        								return;
        							} else if (Txn != null && Txn.approved == "Yes") {
        								var responseCode = Txn.responseCode;
        								if(responseCode == "08") {
        								    var returnVal = $("input[name='EPS_RESULTURL']").val();
        								    
        								    location.href=returnVal + "&summarycode=1&txnid=" + Txn.txnID + "&asd=";
        								    
    								    } else {
        									error = true;
        									alert('There is error: ' + Txn.responseText + '. Please try again.');
                                            $("#loading").hide();
        									return;
        								}
        							}
        						} else {
        							alert('There is some unknown error. Please try again.');
                                    $("#loading").hide();
        						}
        					} else {
        						alert('There is some unknown error. Please try again.');
                                $("#loading").hide();
        					}
        				}
        			}
        		},
        		error: function(xhr, desc, err) {
        			alert('There is some unknown error. Please try again.');
                    $("#loading").hide();
        		}
        	});

        });
    });
}


        
        $(document).on("click", ".btn-applyDiscount", function() {
            if($("#hasDiscounted").val() == "0"){
             
                $.post("https://www.policetax.com.au/backend/promoCode_", {code: $("#discountCode").val(), price: $("input[name='EPS_AMOUNT']").val() }, function(response){
                    response = JSON.parse(response);
                    if(response.price != undefined){
                     
                        $("input[name='EPS_AMOUNT']").val(response.price);
                        $("input[name='EPS_FINGERPRINT']").val(response.timeStampValue);
                        $("input[name='EPS_TIMESTAMP']").val(response.timeNDate);
                        $("input[name='EPS_REFERENCEID']").val(response.testReference);
                        $(".price").html(`<b>${response.price}</b>`);
                        $("#hasDiscounted").val("1");
                    } else{
                        alert("Invalid Discount Code");
                    }
                });    
            } else {
                alert("Discount code has already been added to this booking.");
                $("#discountCode").val("");
            }
        });

</script>

</body>
</html>


