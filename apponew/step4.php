<?php
require_once __DIR__."/php/paypal.class.php";
require_once __DIR__."/php/database.php";
//sandbox credentials
//$base = "https://api-m.sandbox.paypal.com";
//$id = "AXnrl_ug1qHek7exuv-QQ53dC81Nu-r5bV7CpCoSfasuKzLVWBUIdnoPg8ozmTSnGv_qIf4-7LkKa5KJ";
//$secret = "EGyhTm0F9xw8Tk9fOdMthbRL4y2j9l1SvdbE7euVgSgPdIA7Kvo8NUlMykkOEB2xuLDkkCKwLkvgby9e";
//live credentials
$base = "https://api-m.paypal.com";
//$id = "ASEHjelQ1dV3jIgu29JnznQwgqtGsP1s_Y9S6ZGF_EPfwvHOLlFCJjk9qEwQhHB4dqSG-SX2CeC7cHwy";
//$secret = "ENQW5iGaEJmhdtEnib7giuWmXAPwvl4lTVA5EL5CA279Kjgqhq6qz73fIfFar0tcoMl4gQj3PDoU3vPP";
$id = "Ad4vheKlBHLX_e3HXjXlcESTfj9NhCEQJNcNkXUKRoHacBwd8iKyV8dUHoZwx7nUyFIh12FyvvDI41S8";
$secret = "EBi599kWdyQayc75ZFH3q6dDAcmIzHhYV7mRNLANOPSNcx7Ek_ApFjsm8u1VCdf3mYuoqDMkVIOO7qfo";
$paypal = new paypalCurl();
$paypal->init($id,$secret,$base);
$db = Database::getDatabase(true);
if (isset($_GET["token"]) && isset($_SESSION["paypal"]) && $_SESSION['paypal'] == true) {
    $token = $_GET["token"];
    $query = "select * FROM paypal_trans WHERE token = '".$token."'";
    $rs = $db->query($query);
    $arr = array();
    $valid = true;
    if(is_bool($rs)) $valid = false;
    else {
    	while($obj = $rs->fetch_object()) {
    		array_push($arr, $obj);
    	}
    }
    if (count($arr) <= 0) $valid = false;
    if ($valid) {
        if(!isset($_SESSION)) session_start();
        $session = json_decode($arr[0] -> session);
        foreach ($session as $key => $value) {
            $_SESSION[$key] = $value;
        }
    } else {
        header("location: index.php");
        exit;
    }
} else {
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION["taxService"]) || !isset($_SESSION["selectedDate"]) || !isset($_SESSION["selectedTime"])){
        header("location: index.php");
        exit;
    }
}
if(!isset($_SESSION["useCreditCard"])){
    $_SESSION["useCreditCard"] = true;
}
function ses($str) {
	if(isset($_SESSION[$str])) echo $_SESSION[$str];
	else echo "";
}
function ischecked($str) {
	if(!isset($_SESSION[$str])) return "";
	else if($_SESSION[$str] == "checked") return "checked";
	else return "";
}
function isnotchecked($str) {
	if(!isset($_SESSION[$str])) return "";
	else if($_SESSION[$str] != "checked") return "checked";
	else return "";
}
$paypalResult = new stdClass();
if (isset($_POST['paypal']) && $_POST["paypal"] == "yes") {
    $_SESSION['paypal'] = true;
    $order = time();
    $name = $_SESSION["taxServiceName"];
    $price = $_SESSION["price"];
    $currency = "AUD";
    $return = "https://www.policetax.com.au/apponew/step4.php";
    $paypalResult = $paypal->makePaymentURL($order,$name,$price,$currency,$return);
    if ($paypalResult->status === true) {
        $lines = explode('?token=', $paypalResult->url);
        if (count($lines) > 0) {
            $token = $lines[1];
            $session = json_encode($_SESSION);
            $db = Database::getDatabase(true);
            $query = "INSERT INTO paypal_trans (token, session) VALUES ('".$token."','". $session."') ON DUPLICATE KEY UPDATE session = '".$session."'";
            $rs = $db->query($query);
            header("location:". $paypalResult->url);
        }
    }
}
?>
<html lang="en" style="" class="js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths win chrome chrome93 webkit webkit5">
<head id="Head1">
 	<title>Book an appointment | Police Tax</title>
 	<script type="text/javascript">
 		var PageStartTime = new Date().getTime();
 		var ServerTime = "11/09/2021";
 		var ServerTimeFull = "2021-09-11 15:56:15Z";
 	</script>
 	<script type="text/javascript">
 		function navigateToMain() { $('#Main').focus(); }
 	</script>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
 	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
 	<meta name="DCTERMS.creator" content="scheme=AGLSTERMS.GOLD; c=AU; o=Commonwealth of Australia; ou=Australian Taxation Office">
 	<meta name="DCTERMS.type" content="Service">
 	<meta name="AGLSTERMS.function" scheme="AGLSTERMS.AGIFT" content="Taxation">
 	<meta name="DCTERMS.language" content="English">
 	<meta name="DCTERMS.date" content="2021-08-26">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/vendor/bootstrap-3.3.7-ato.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/vendor/bootstrap-datetimepicker-2.3.4.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/vendor/durandal-2.1.0.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/vendor/jquery.reject-1.1.0.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/vendor/animate.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/ato/fonts-v2.2.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/ato/v3/v3.01.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/ato/v3/browser-print-v3.min.css">
 	<script id="jquery-1.11.1.min" src="ui/scripts/vendor/jquery-1.11.1.min.js"></script>
 	<script id="jquery.reject-1.1.0.min" src="ui/scripts/vendor/jquery.reject-1.1.0.min.js"></script>
 	<script id="jquery.cookie-1.4.1.min" src="ui/scripts/vendor/jquery.cookie-1.4.1.min.js"></script>
	<script src="ui/scripts/vendor/jquery.mask.min.js"></script>	
 	<script id="bootstrap-3.3.7.min" src="ui/scripts/vendor/bootstrap-3.3.7.min.js"></script>
 	<script id="bootstrap-datetimepicker-2.3.4-dds.min" src="ui/scripts/vendor/bootstrap-datetimepicker-2.3.4-dds.min.js"></script>
 	<script src="https://www.google.com/recaptcha/api.js?render=6Ld-ODkfAAAAAGvOlu7s5LolENGPaFoT_axSv1ii"></script>
    <script src="js/step4.js"></script>
	<style>
		.glyphicon.spinning {
			animation: spin 1s infinite linear;
			-webkit-animation: spin2 1s infinite linear;
		}

		@keyframes spin {
			from { transform: scale(1) rotate(0deg); }
			to { transform: scale(1) rotate(360deg); }
		}

		@-webkit-keyframes spin2 {
			from { -webkit-transform: rotate(0deg); }
			to { -webkit-transform: rotate(360deg); }
		}
	</style>
</head>
<body>
   <div class="ato-spa-container">
      <section id="content" style="min-height: 448px;">
         <div class="durandal-wrapper">
            <article role="main">
               <addclient-header>
                  <ato-page-header>
                     <ato-heading>
                        <div class="row">
                           <div class="col-xs-12">
                              <div class="ato-heading page-header">
                                 <h1>
                                    <span>My New Tax Appointment</span>
                                 </h1>
                              </div>
                           </div>
                        </div>
                     </ato-heading>
                  </ato-page-header>
                  <ato-wizard>
                     <ul class="ato-wizard progress-tabs nav nav-tabs wizard-tabs">
                         <li>
                             <a id="step1link" href="index.php">
                                 <span class="wizard-tab-title">
                                     <span data-bind="html: tab.heading">Client details</span>
                                     <span class="triangle"></span>
                                 </span>
                                 <span class="sr-only">Tab</span>
                                 <span class="wizard-tabs-number" data-bind="text: tab.number">1</span>
                                 <span class="sr-only" data-bind="text: ' of ' + $component.tabs().length"> of 4</span>
                                 <span class="sr-only" data-bind="text: tab.ariaText">current step</span>
                             </a>
                         </li>

                         <li>
                             <a id="step2link" href="step2.php">
                                 <span class="wizard-tab-title">
                                     <span data-bind="html: tab.heading">Questions</span>
                                     <span class="triangle"></span>
                                 </span>
                                 <span class="sr-only">Tab</span>
                                 <span class="wizard-tabs-number" data-bind="text: tab.number">2</span>
                                 <span class="sr-only" data-bind="text: ' of ' + $component.tabs().length"> of 4</span>
                                 <span class="sr-only" data-bind="text: tab.ariaText">future step</span>
                             </a>
                         </li>

                         <li>
                             <a id="step3link" href="step3.php">
                                 <span class="wizard-tab-title">
                                     <span data-bind="html: tab.heading">Booking</span>
                                     <span class="triangle"></span>
                                 </span>
                                 <span class="sr-only">Tab</span>
                                 <span class="wizard-tabs-number" data-bind="text: tab.number">3</span>
                                 <span class="sr-only" data-bind="text: ' of ' + $component.tabs().length"> of 4</span>
                                 <span class="sr-only" data-bind="text: tab.ariaText">future step</span>
                             </a>
                         </li>

                         <li class="active">
                             <a id="step4link" href="step4.php">
                                 <span class="wizard-tab-title">
                                     <span data-bind="html: tab.heading">Payment</span>
                                     <span class="triangle"></span>
                                 </span>
                                 <span class="sr-only">Tab</span>
                                 <span class="wizard-tabs-number" data-bind="text: tab.number">4</span>
                                 <span class="sr-only" data-bind="text: ' of ' + $component.tabs().length"> of 4</span>
                                 <span class="sr-only" data-bind="text: tab.ariaText">future step</span>
                             </a>
                         </li>
                     </ul>
                  </ato-wizard>
                  <ato-heading>
                     <div class="row">
                        <div class="col-xs-12">
                           <div class="ato-heading page-sub-header">
                              <h2>
                                 <span data-bind="html: title">Payment</span>
                              </h2>
                           </div>
                        </div>
                     </div>
                  </ato-heading>
               </addclient-header>
               
               
        
               <!------------------------------->
               <section>
                  <div class="field-section">
					<div class="form-group col-xs-12">
						<img src="https://www.policetax.com.au/assets/img/Credit Cards1.jpg">
					</div>
					<div class="field-section" id="clientDetails" >
                     <ato-radio>
                        <div class="ato-radio row component-active">
                           <div class="form-group col-xs-12">
                              <fieldset>
                                 <div class="col-xs-12 no-gutters">
                                    <div class="row no-gutters-right">
                                       <div class="col-xs-12 col-sm-12 col-md-4">
                                          <ato-label><label class="control-label" for="name">Select payment method<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr>  </abbr></label></ato-label>
                                         <div class="col-xs-12 col-sm-12 no-gutters">
                                            <div>
                                               <div class="row no-gutters-right">
                                                  <div class="col-xs-12">
                                                     <div class="radio">
                                                        <input type="radio" name="choosePayMethod" id="creditCardMethod" value="10" <?=ischecked("useCreditCard")?>>
                                                        <label class="justify" for="creditCardMethod">Credit Card</label>
                                                     </div>
                                                  </div>
                                                  <div class="col-xs-12">
                                                     <div class="radio">
                                                        <input type="radio" name="choosePayMethod" id="paypalMethod" value="20" <?=isnotchecked("useCreditCard")?>>
                                                        <label class="justify" for="paypalMethod">Paypal</label>
                                                     </div>
                                                  </div>
                                               </div>
                                            </div>
                                         </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="col-xs-12 no-gutters" id="creditCardDetails" style="<?php if(!isset($_SESSION['exist'])) echo 'display: none'; ?>">
                                    <div class="row no-gutters-right">
                                       <div class="col-xs-12 col-sm-12 col-md-4">
                                          <ato-label><label class="control-label" for="name">Name on Card<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr>  </abbr></label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <div class="sel-input">
                                                <input type="search" class="form-control" id="name" placeholder="Full Name on Card" required="required" value="<?=ses("name")?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-12 col-md-4">
                                          <ato-label><label class="control-label" for="number">Number on Card<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <div class="sel-input">
												<input autocomplete="on" style="opacity: 0; position: absolute; pointer-events: none">
                                                <input autocomplete="off" type="text" class="form-control" id="number" placeholder="XXXX XXXX XXXX XXXX" size="16" maxlength="16" required="required" value="<?=ses("number")?>">
                                             </div>
                                          </div>
                                       </div>

                                       <div class="col-xs-6 col-sm-6 col-md-2">
                                          <ato-label><label class="control-label" for="exp">Expiry date<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <div class="sel-input">
												<input autocomplete="on" style="opacity: 0; position: absolute; pointer-events: none">
												<input autocomplete="off" type="text" class="form-control" id="exp" required="required" placeholder="mm/yy" value="<?=ses("exp")?>">
                                             </div>
                                          </div>
                                       </div>
									   
                                       <div class="col-xs-6 col-sm-6 col-md-2">
                                          <ato-label><label class="control-label" for="cvv">CVV<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <div class="sel-input">
                                                <input type="text" class="form-control" id="cvv" size="4" maxlength="4" required="required" placeholder="Back of card" value="<?=ses("cvv")?>">
                                             </div>
                                          </div>
                                       </div>

                                    </div>
                                 </div>
                                 <div class="col-xs-12 no-gutters">
                                    <div class="row no-gutters-right">
                                       <div class="col-xs-12 col-sm-12 col-md-4">
                                          <ato-label><label class="control-label" for="email">Customer name<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <div class="sel-input">
                                                <input type="text" class="form-control" id="cname" required="required" disabled readonly value="<?=ses("fname")?> <?=ses("lname")?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-12 col-md-4">
                                          <ato-label><label class="control-label" for="mob">Customer email<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <div class="sel-input">
                                                <input type="text" class="form-control" id="cemail" required="required" disabled readonly value="<?=ses("email")?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-12 col-md-4">
                                          <ato-label><label class="control-label" for="tfn">Amount<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <div class="sel-input">
												<input type="hidden" class="form-control" id="initialpriceValue" required="required" value="<?=ses("initialprice")?>">
                                                <input type="text" class="form-control" id="initialprice" required="required" placeholder="$" disabled readonly value="$<?=ses("initialprice")?> AUD">
                                             </div>
                                          </div>
                                       </div>
                                       
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                          <ato-label><label class="control-label" for="tfn"><abbr aria-hidden="true" class="required-indicator" title="Required"> </abbr></label></ato-label>
                                       
                                        </div>
                                       
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                          <ato-label><label class="control-label" for="tfn"><abbr aria-hidden="true" class="required-indicator" title="Required"> </abbr></label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                            
                                          </div>
                                       </div>
                                       
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                          <ato-label><label class="control-label" for="tfn"><b>Less Early payment Disc.(5%)</b><abbr aria-hidden="true" class="required-indicator" title="Required"> </abbr></label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <div class="sel-input">
												<input type="hidden" class="form-control" id="discountAmountValue" required="required" value="<?=ses("discountamount")?>">
                                                <input type="text" class="form-control" id="discountAmount" required="required" placeholder="$" disabled readonly value="$<?=ses("discountamount")?> AUD">
                                             </div>
                                          </div>
                                       </div>
                                       
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                          
                                         
                                        </div>
                                       
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                          
                                          
                                        </div>
                                       
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                          <ato-label><label class="control-label" for="promo-code"><b>Promo code</b></label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <div class="sel-input">
                                                <div class="col-xs-8 col-sm-8 no-gutters">
                                                    <input type="text" class="form-control" id="promo-code" placeholder="Promo code">
                                                </div>
                                                <div class="col-xs-4 col-sm-4 no-gutters">
                                                    <button type="button" role="button" class="ato-button btn btnHalf btn-primary" id="submit-promo" data-submit="true">Enter</button>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       
                                        <div class="promo-data" style="display:none;">
                                            <div class="col-xs-12 col-sm-12 col-md-4">
                                              
                                             
                                            </div>
                                           
                                            <div class="col-xs-12 col-sm-12 col-md-4">
                                              
                                              
                                            </div>
                                           
                                            <div class="col-xs-12 col-sm-12 col-md-4">
                                              <ato-label><label class="control-label" for="promo-code"><b>Promo discount applied</b></label></ato-label>
                                              <div class="col-xs-12 col-sm-12 no-gutters">
                                             <div class="sel-input">
                                                <input type="text" class="form-control" id="promocodeAmount" required="required" placeholder="$" disabled readonly value="">
                                             </div>
                                          </div>
                                           </div>
                                        </div>
                                       
                                       
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                          
                                         
                                        </div>
                                       
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                          
                                          
                                        </div>
                                       
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                          <ato-label><label class="control-label" for="tfn"><b>Final Amount to charge</b><abbr aria-hidden="true" class="required-indicator" title="Required"> </abbr></label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <div class="sel-input">
												<input type="hidden" class="form-control" id="priceValue" required="required" value="<?=ses("price")?>">
                                                <input type="text" class="form-control" id="price" required="required" placeholder="$" disabled readonly value="$<?=ses("price")?> AUD">
                                             </div>
                                          </div>
                                       </div>
                                       
                                       
                                    </div>
                                 </div>
                              </fieldset>
                           </div>
                        </div>
                     </ato-radio>
                  </div>
                  </div>
                  <ato-action-bar params="deleteIsVisible: false,
                     deleteIsEnabled: false,
                     deleteModalEnabled: false,
                     cancelAction: $root.cancelAction,
                     saveText: 'Next',
                     saveAction: $root.nextAction">
                     <div class="row ato-action-bar">
                        <div class="col-xs-12">
                           <hr>
                           <!-- ko foreach: visibleButtons -->
                           <!-- ko ifnot: printCompose -->
                           <form id="step4form" action="step4.php" method="post">
                           <ato-button params="btnClass: css,
                              btnText: text,
                              btnTitle: title,
                              ariaLabel: ariaLabel,
                              visible: isVisible,
                              enabled: isEnabled,
                              btnAction: action,
                              btnLoadingAction: loadingAction,
                              submittable: isSubmittable,
                              btnIconClass: btnIconClass,
                              hasFocus: hasFocus,
                              id: id">
                              <a href="step3.php" type="button" role="button" class="ato-button btn btn-default btnHalf" id="step4back">Back</a>
                              <!-- ko if: fld --><!-- /ko -->
                           </ato-button>
                           <!-- /ko -->
                           <!-- ko if: printCompose --><!-- /ko -->
                           <!-- ko ifnot: printCompose -->
                           <ato-button params="btnClass: css,
                              btnText: text,
                              btnTitle: title,
                              ariaLabel: ariaLabel,
                              visible: isVisible,
                              enabled: isEnabled,
                              btnAction: action,
                              btnLoadingAction: loadingAction,
                              submittable: isSubmittable,
                              btnIconClass: btnIconClass,
                              hasFocus: hasFocus,
                              id: id">
                              <input type="hidden" name="paypal" id="paypal" value="no">
                              <button type="submit" role="button" class="ato-button btn btn-secondary btnHalf" id="step4next" data-submit="true" disabled>Submit</button>
                              <!-- ko if: fld --><!-- /ko -->
                           </ato-button>
                           </form>
                           <!-- /ko -->
                           <!-- ko if: printCompose --><!-- /ko -->
                           <!-- /ko -->
                        </div>
                     </div>
                     <div data-bind="foreach: visibleModals">
                        <ato-modal-confirm params="type: type,
                           title: title,
                           modalText: confirmModalText,
                           id: id, 
                           modalBtns: [{ btnText: 'No', btnAction: confirmNoAction }, { btnAction: confirmYesAction }],
                           modalParentSelector: modalParentSelector,
                           closeAction: closeAction">
                           <div data-bind="component: { name: 'ato-modal', params: $component.params }"></div>
                        </ato-modal-confirm>
                     </div>
                  </ato-action-bar>
               </section>
            </article>
         </div>
      </section>
   </div>
	<div id="js-notice-modal" class="modal fade">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title">Notice</h4>
		  </div>
		  <div class="modal-body">
			<p id="noticeBody">
			  The payment is failed. Please try again with another credit card or contact your bank.
			</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger js-first-focus" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	<div id="js-spinner-modal" class="modal fade">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">Please wait for a while</h4>
		  </div>
		  <div class="modal-body text-center">
			<button class="btn btn-lg btn-primary" style="float: none; font-size: 30px">
				<span class="glyphicon glyphicon-refresh spinning"></span> Waiting...    
			</button>
			<p class="text-danger">
			  Please be patient. The payment is processing. It may take up to 60 seconds depending on Network quality. Please don't close your browser or press Back button or turn off your device or unexpected error will occur.
			</p>
		  </div>
		</div>
	  </div>
	</div>
<?php
if (isset($_POST['paypal']) && $_POST["paypal"] == "yes" && $_SESSION['paypal'] == true) {
    if ($paypalResult->status !== true) {
        echo "<script>showError('Payment is not successful. Please try again');</script>";
        $_SESSION['paypal'] = false;
    }
}
if (isset($_GET["token"]) && isset($_SESSION["paypal"])) {
    $token = $_GET["token"];
    if (isset($_GET["PayerID"])) {
        $result = $paypal->verify($token);
        //var_dump($result);
        if ($result -> state === true && $result -> ref === "COMPLETED" && is_string($result -> id) && $result -> id !== '' ) {
            echo "<script>processPaymentPaypal('".$result -> id."', '".$_GET["PayerID"]."');</script>";
        } else {
            if ( is_string($result -> ref) && $result -> ref !== '' ) {
                $ref = $result -> ref;
                $ref = strtolower($ref);
                $ref = str_replace('_', ' ', $ref);
                echo "<script>showError('Payment via Paypal is not successful because ".$ref.". Please try again');</script>";
                
            } else {
                echo "<script>showError('Payment via Paypal is not successful . Please try again');</script>";
            }
            $_SESSION['paypal'] = false;
        }
    }
}
?>
</body>
</html>