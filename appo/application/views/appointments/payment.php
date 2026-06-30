<!DOCTYPE html>
<html>

<head>
    <?php
    header("Access-Control-Allow-Origin: *");
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#35A768">

    <title><?= lang('page_title') . ' ' .  $company_name ?></title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="icon" type="image/x-icon" href="<?= asset_url('assets/img/favicon.ico') ?>">
    <link rel="icon" sizes="192x192" href="<?= asset_url('assets/img/logo.png') ?>">
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

.btn:disabled {
  background: #ccc;
  cursor: not-allowed;
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
     <img id="loader-img" src="https://static.wixstatic.com/media/d27180_8ba5d7d0d8ce459aa955f57c6ff5782b~mv2.gif" style="margin-top: 13%;">
    </div>
    
    <div class="row">
      <div class="col-75">
        <div class="container">

                <?php
                $merchantId = "AV00010";
                $dateFormat = "YmdHis"; //set the date format
                $timeNdate = gmdate($dateFormat, time()); //get GMT date - 4
                $dateReference = "dmY";
                $testReference = gmdate($dateReference, time());
                $str = "AV00010|w1VKorgi|0|" . $testReference . "|" . $priceData . "|" . $timeNdate;
                $timeStampValue = sha1($str);
                ?>
                
                <input type="hidden" id="hasDiscounted" value="0" />
      <form id="myform" method="post"  action="https://transact.nab.com.au/live/directpostv2/authorise">
                    <input type="hidden" name="EPS_MERCHANT" value="<?php echo ($merchantId); ?>">
                    <input type="hidden" name="EPS_TXNTYPE" value="0">
                    <input type="hidden" name="EPS_REFERENCEID" value="<?php echo ($testReference); ?>">
                    <input type="hidden" name="EPS_TIMESTAMP" value="<?php echo ($timeNdate); ?>">
                    <input type="hidden" name="EPS_FINGERPRINT" value="<?php echo ($timeStampValue); ?>">
                    <input type="hidden" name="EPS_REDIRECT" value="true">
                    <input type="hidden" name="EPS_RESULTURL" value="<?= $urlData ?>" >
                    <input type="hidden" name="EPS_AMOUNT" value="<?= $priceData ?>">
      
        <div class="row">
          <!--<div class="col-50">
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
          </div>-->
        <div class="col-10">
            </div>
          <div class="col-90" style="margin-left: 12%;">
            <h3>Payment</h3>
            <div class="icon-container" style="margin-top: 44px;">
              <i class="fa fa-cc-visa" style="color:#0157a2;"></i>
              <i class="fa fa-cc-amex" style="color:#007bc1;"></i>
              <i class="fa fa-cc-mastercard" style="color:#0a3a82;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="Name on Card">
            <label for="ccnum">Credit card number</label>
            <input type="text" class="left" maxlength="19" data-stripe="number" id="ccnum" name="EPS_CARDNUMBER" placeholder="Card Number" required>
            <label for="expmonth">Exp Month</label>
            <input type="number" id="expmonth" name="EPS_EXPIRYMONTH" placeholder="MM" required>
            <div class="row">
              <div class="col-50">
                <label for="expiryYear">Exp Year</label>
                <input type="hidden" id="expyear" name="EPS_EXPIRYYEAR" placeholder="YYYY">
                <select id="expiryYear" name="yearSelect" required>
                    <!--<option>Select</option>-->
                </select>
              </div>
              <div class="col-50">
                <label for="cvv">Security Code</label>
                <input type="number" id="cvv" name="EPS_CCV" placeholder="Security Code" required>
              </div>
            </div>
            <div class="row">
                <!--<div class="col-20">
                    <input type="button" value="Back" id="back-btn" class="btn btn-default">
                </div>&nbsp;&nbsp;&nbsp;&nbsp;-->
                <div class="col-70">
                    <input type="button" value="Confirm Payment" id="payment-submit" class="btn btn-success">
                </div>
            </div>
          </div>
          
        </div>
      </form>
            </div>
        </div>
        <div class="col-25">

<img src="/img/imgs-form/NAB3.jpg" style="width:36%;" />
<img src="/img/logos/credit-cards.png" style="width: 50%;margin-left: 10%;">
    <div class="container">
<div id="product_price">
      <h4>Product <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>1</b></span></h4>
      <p><a href="/appo/index.php" target="_blank">Appointment</a> <span class="price">$<?php echo($priceData);?></span></p>  
       <p>Discount Code<span><input type="text" id="discountCode" placeholder="Discount Code"><button type="button" value="Apply" class="pull-right btn btn-applyDiscount" style="width: 40%;">Apply Discount</button></span></p><br/><br/>       
      <hr>      
      <p>Total <span class="price" style="color:black"><b>$<?php echo($priceData);?></b></span></p>
    </div>
    </div>
<div class="">
</div>
    </div>
    <script>
        var GlobalVariables = {
            availableServices: <?= json_encode($available_services) ?>,
            availableProviders: <?= json_encode($available_providers) ?>,
            baseUrl: <?= json_encode(config('base_url')) ?>,
            manageMode: <?= $manage_mode ? 'true' : 'false' ?>,
            customerToken: <?= json_encode($customer_token) ?>,
            dateFormat: <?= json_encode($date_format) ?>,
            timeFormat: <?= json_encode($time_format) ?>,
            displayCookieNotice: <?= json_encode($display_cookie_notice === '1') ?>,
            appointmentData: <?= json_encode($appointment_data) ?>,
            providerData: <?= json_encode($provider_data) ?>,
            customerData: <?= json_encode($customer_data) ?>,
            csrfToken: <?= json_encode($this->security->get_csrf_hash()) ?>,
            AJAX_SUCCESS: 'SUCCESS'
        };
        
        var EALang = <?= json_encode($this->lang->language) ?>;
        var availableLanguages = <?= json_encode($this->config->item('available_languages')) ?>;
        
        function getUrlVars() {
            var vars = [],
                hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for (var i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        }
    </script>

    <script src="<?= asset_url('assets/js/general_functions.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/jquery/jquery.min.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/jquery-ui/jquery-ui.min.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/jquery-qtip/jquery.qtip.min.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/cookieconsent/cookieconsent.min.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/datejs/date.js') ?>"></script>
    <script src="<?= asset_url('assets/js/frontend_book_api.js') ?>"></script>
    <script src="<?= asset_url('assets/js/frontend_book.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {

            var currentTime = new Date();
            var inityear = currentTime.getFullYear();
            for (var i = 0; i < 15; i++) {
                $("#expiryYear").append($('<option>', {
                    value: inityear,
                    text: inityear
                }));
                inityear += 1;
            }

            document.querySelector('#ccnum').oninput = function() {
                var foo = this.value.split(" ").join("");
                if (foo.length > 0) {
                    foo = foo.match(new RegExp('.{1,4}', 'g')).join(" ");
                }
                this.value = foo;
            };
            
            $("#back-btn").on("click", function(e) {
                e.preventDefault();
                $.removeCookie("ea_back");
                $.cookie("ea_back", 1, { expires : 100, path : '/' });
                location.href="https://policetax.com.au/appo/index.php/";

            });
            
            $("#payment-submit").on("click", function(e) {
                e.preventDefault();
                
                if ($("#myform").valid()) {
                    var ccnumArray = $("#ccnum").val().split(" ");
                    var selectedYear = $("#expiryYear option:selected").val();
                    var ccnum = ccnumArray[0] + ccnumArray[1] + ccnumArray[2] + ccnumArray[3];
                    //console.log(ccnum);
                    $("#loading").show();
                    $(".btn").attr("disabled", true);
                    $("#ccnum").val(ccnum);
                    $("#expyear").val(selectedYear);
                    $("form").submit();
                }

            });
        });
        $(document).ready(function(){
           
            var data = $(`input[name='EPS_RESULTURL']`).val();
            
            var dataURL = getUrlVars();
            var urlData = data + "?book=" + dataURL.book;
            $(`input[name='EPS_RESULTURL']`).val(urlData);
 
        });
        
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