<?php
if(!isset($_SESSION)) session_start();
if(!isset($_SESSION["email"])){
    header("location: index.php");
    exit;
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
function isselected($str,$val) {
	if(!isset($_SESSION[$str])) return "";
	else if($_SESSION[$str] == $val) return "selected";
	else return "";
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
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/vendor/bootstrap-datetimepicker-4.7.14.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/vendor/durandal-2.1.0.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/vendor/jquery.reject-1.1.0.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/vendor/animate.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/ato/fonts-v2.2.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/ato/v3/v3.01.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/ato/v3/browser-print-v3.min.css">
 	<script id="jquery-1.11.1.min" src="ui/scripts/vendor/jquery-1.11.1.min.js"></script>
 	<script id="jquery.reject-1.1.0.min" src="ui/scripts/vendor/jquery.reject-1.1.0.min.js"></script>
 	<script id="jquery.cookie-1.4.1.min" src="ui/scripts/vendor/jquery.cookie-1.4.1.min.js"></script>
	<script id="moment.min.js" src="ui/scripts/vendor/moment.min.js"></script>
 	<script id="bootstrap-3.3.7.min" src="ui/scripts/vendor/bootstrap-3.3.7.min.js"></script>
    <script id="bootstrap-datetimepicker-4.7.14.min.js" src="ui/scripts/vendor/bootstrap-datetimepicker-4.7.14.min.js"></script>
    <script src="js/step3.js"></script>
	<style>
		#available-hoursAM .available-hour, #available-hoursPM .available-hour {
			font-size: 15px;
			padding: 10px;
			display: inline-block;
		}

		#available-hoursAM .available-hour:hover, #available-hoursPM .available-hour:hover {
			font-weight: bold;
			background-color: #CAEDF3;
			cursor: pointer;
		}

		#available-hoursAM .selected-hour, #available-hoursPM .selected-hour {
			color: #0088cc;
			font-weight: bold;
		}
		.form-control optgroup {font-weight: 700}
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

                         <li class="active">
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

                         <li>
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
                                 <span data-bind="html: title">Tax Service Selection</span>
                              </h2>
                           </div>
                        </div>
                     </div>
                  </ato-heading>
               </addclient-header>
               <section>
				  
                  <div class="field-section">
                     <ato-radio>
                        <div class="ato-radio row component-active">
                           <div class="form-group col-xs-12">
                              <fieldset>
                                 <div class="form-group col-xs-12 col-sm-12 col-md-4 no-gutters-left">
                                    <div class="row no-gutters-right">
                                       <div class="col-xs-12">
                                          <ato-label><label class="control-label" for="howDone">Location/Method<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <select class="form-control" id="howDone">                                         
                                                <option value="Remote"  <?=isselected("howDone","Remote")?>>Remote Video</option>
                                                <option value="Office"  <?=isselected("howDone","Office")?>>In Our Office</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 service-delivery-data">
                                          <ato-label><label class="control-label" for="delivery">Service delivery<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <select class="form-control" id="delivery">
                                                <option value="">Select method</option>
                                                <option value="Skype" <?=isselected("delivery","Skype")?>>Skype</option>
                                                <option value="WhatsApp" <?=isselected("delivery","WhatsApp")?>>WhatsApp</option>
                                                <option value="Facetime" <?=isselected("delivery","Facetime")?>>Apple Facetime</option>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group col-xs-12 col-sm-12 col-md-4 no-gutters-left">
                                    <div class="row no-gutters-right">
                                       <div class="col-xs-12">
                                          <ato-label><label class="control-label" for="consultant">Tax Consultant<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
										  <input type="hidden" class="form-control" id="consultantValue" required="required" value="<?=ses("consultant")?>">
                                          <select class="form-control" name="consultant" id="consultant">                                          
											 <option value="">Select Tax Consultant</option>
                                          </select>
                                       </div>
                                       <div class="col-xs-12">
                                          <ato-label><label class="control-label" for="tax-year">Tax Year<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <select class="form-control" id="tax-year">
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group col-xs-12 col-sm-12 col-md-4 no-gutters-left">
                                    <div class="row no-gutters-right">
                                       <div class="col-xs-12">
                                          <ato-label><label class="control-label" for="taxService">Tax Service<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
											 <input type="hidden" class="form-control" id="taxServiceValue" required="required" value="<?=ses("taxService")?>">
                                             <select class="form-control" id="taxService">
												<option value="">Select Tax Service</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-xs-12">
                                          <ato-label><label class="control-label" for="office-location">Office Location<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <select class="form-control" id="office-location">
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div id="serviceOptions"></div>
                                 <!--
                                 <div id="serviceOptions">
                                     <div class="form-group col-xs-12 col-sm-12 no-gutters-left">
                                        <div class="row no-gutters-right">
                                           <div class="col-xs-12">
                                              <div class="col-xs-12 col-sm-12 no-gutters-left no-gutters-right">
                                              <ato-label><label class="control-label">Click to choose which years you want to fix tax:</label></ato-label>
                                                <div class="btn-group col-xs-12" id="op4" data-toggle="buttons">
                                                    <label class="btn btn-default yearBtn">
                                                        <input type="checkbox" name="op2024" id="op2024" value="2024">2024
                                                    </label>
                                                    <label class="btn btn-default yearBtn">
                                                        <input type="checkbox" name="op2023" id="op2023" value="2023">2023
                                                    </label>
                                                    <label class="btn btn-default yearBtn">
                                                        <input type="checkbox" name="op2022" id="op2022" value="2022">2022
                                                    </label>
                                                    <label class="btn btn-default yearBtn">
                                                        <input type="checkbox" name="op2021" id="op2021" value="2021">2021
                                                    </label>
                                                    <label class="btn btn-default yearBtn">
                                                        <input type="checkbox" name="op2020" id="op2020" value="2020">2020
                                                    </label>
                                                    <label class="btn btn-default yearBtn">
                                                        <input type="checkbox" name="op2019" id="op2019" value="2019">2019
                                                    </label>
                                                </div>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="form-group col-xs-12 col-sm-12 col-md-4 no-gutters-left">
                                        <div class="row no-gutters-right">
                                           <div class="col-xs-12">
                                              <div class="col-xs-12 col-sm-12 no-gutters-left no-gutters-right">
                                              <ato-label><label class="control-label" for="op1">Number of people</label></ato-label>
                                                 <input type="text" class="form-control" id="op1" value="<?=ses("op1")?>">
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="form-group col-xs-12 col-sm-12 col-md-4 no-gutters-left">
                                        <div class="row no-gutters-right">
                                           <div class="col-xs-12">
                                              <div class="col-xs-12 col-sm-12 no-gutters-left no-gutters-right">
                                              <ato-label><label class="control-label" for="op2">Number of properties</label></ato-label>
                                                 <input type="text" class="form-control" id="op2" value="<?=ses("op2")?>">
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 no-gutters-left">
                                       <fieldset>
                                          <legend class="pad-for-horizontal">
                                             <ato-label><label class="control-label">Depreciation</label></ato-label>
                                          </legend>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <div>
                                                <div class="row no-gutters-right fld-group">
                                                   <div class="col-xs-12 col-sm-6 fld-group-item">
                                                      <div class="radio">
                                                         <input type="radio" name="Depreciation" id="DepreciationItem0" value="5" <?=isnotchecked("Depreciation")?>>
                                                         <label class="justify" for="DepreciationItem0">No</label>
                                                      </div>
                                                   </div>
                                                   
                                                   <div class="col-xs-12 col-sm-6 fld-group-item">
                                                      <div class="radio">
                                                         <input type="radio" name="Depreciation" id="DepreciationItem1" value="10" <?=ischecked("Depreciation")?>>
                                                         <label class="justify" for="DepreciationItem1">Yes</label>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </fieldset>
                                    </div>
                                 </div>-->
                                 <div class="form-group col-xs-12 col-sm-12 col-md-12 no-gutters-left">
                                    <div class="row no-gutters-right">
                                       <div class="col-xs-12">
                                          <ato-label><label class="control-label" for="notes-for-accountant">Notes</label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <textarea id="notes-for-accountant" style="width: 364px;height: 102px;resize: none;"></textarea>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </fieldset>
                           </div>
                        </div>
                     </ato-radio>
                  </div>
                  
                  
				  

                  <ato-heading>
                     <div class="row">
                        <div class="col-xs-12">
                           <div class="ato-heading page-sub-header">
                              <h2>
                                 <span data-bind="html: title">Select Date & Time
                                 </span>
                              </h2>
                           </div>
                        </div>
                     </div>
                  </ato-heading>

                  <div class="field-section" id="step3datetime" style="display: none">
					<div class="row component-active">
					   <div class="form-group col-xs-12 col-xm-12 col-md-4 col-lg-4">
						  <fieldset>
							<legend>
								<ato-label><label class="control-label" id="lbl-atoo-clientadd-select-your-client-type-001">Pick the date<abbr class="required-indicator" title="Required"> *</abbr></label></ato-label>
							</legend>
							<div style="overflow:hidden;">
							   <div class="form-group">
								  <div class="row">
									 <div class="col-md-8">
										<input type="hidden" class="form-control" id="selectedDateValue" required="required" value="<?=ses("selectedDate")?>">
										<div id="datetimepicker12"></div>
									 </div>
								  </div>
							   </div>
							</div>
						  </fieldset>
					   </div>
					   <div class="form-group col-xs-12 col-xm-12 col-md-5 col-lg-4">
						  <fieldset>
							<legend>
								<input type="hidden" class="form-control" id="selectedTimeValue" required="required" value="<?=ses("selectedTime")?>">
								<div class="form-group col-xs-6">
									<ato-label><label class="control-label" id="lbl-atoo-clientadd-select-your-client-type-001">Pick the time<abbr class="required-indicator" title="Required"> *</abbr></label></ato-label>
								</div>
								<div class="form-group col-xs-3">
									<button role="button" class="ato-button btn-success btn-sm" id="timeAM">AM</button>
								</div>
								<div class="form-group col-xs-3">
									<button role="button" class="ato-button btn-warning btn-sm" id="timePM">PM</button>
								</div>
							</legend>
							<div class="col-xs-12 no-gutters">
								<div id="available-hoursAM"></div>
								<div id="available-hoursPM" style="display: none"></div>
								<!--
                                <div id="available-hours"><div class="col-xs-4"><span class="available-hour selected-hour">9:00 AM</span><br><span class="available-hour">9:15 AM</span><br><span class="available-hour">9:30 AM</span><br><span class="available-hour">9:45 AM</span><br><span class="available-hour">10:00 AM</span><br><span class="available-hour">10:15 AM</span><br><span class="available-hour">10:30 AM</span><br><span class="available-hour">10:45 AM</span><br><span class="available-hour">11:00 AM</span><br><span class="available-hour">11:15 AM</span><br></div><div class="col-xs-4"><span class="available-hour">11:30 AM</span><br><span class="available-hour">1:00 PM</span><br><span class="available-hour">1:15 PM</span><br><span class="available-hour">1:30 PM</span><br><span class="available-hour">1:45 PM</span><br><span class="available-hour">2:00 PM</span><br><span class="available-hour">2:15 PM</span><br><span class="available-hour">2:30 PM</span><br><span class="available-hour">2:45 PM</span><br><span class="available-hour">3:00 PM</span><br></div><div class="col-xs-4"><span class="available-hour">3:15 PM</span><br><span class="available-hour">3:30 PM</span><br><span class="available-hour">3:45 PM</span><br><span class="available-hour">4:00 PM</span><br><span class="available-hour">4:15 PM</span><br><span class="available-hour">4:30 PM</span><br><span class="available-hour">4:45 PM</span><br><span class="available-hour">5:00 PM</span><br><span class="available-hour">5:15 PM</span><br><span class="available-hour">5:30 PM</span><br></div></div>-->
                            </div>
						  </fieldset>
					   </div>
					   <div class="form-group col-xs-12 col-xm-12 col-md-3 col-lg-4">
						  <fieldset>
							 <legend>
								<ato-label><label class="control-label" id="lbl-atoo-clientadd-select-your-client-type-001">Appointment Summary</label></ato-label>
							 </legend>
							 <div class="col-sm-12 no-gutters" style="margin-top: 34px;">
                              <div class="alert alert-block alert-info" id="atoo-clientadd-alertpanel-001-container" data-icon="" role="alert" aria-live="polite" tabindex="-1">
                                 <span class="sr-only" data-bind="html: accessibleType">information</span>
                                 <div class="ato-alert-content" id="atoo-clientadd-alertpanel-001-content">
									<p>Client Name : <?=ses("fname")?> <?=ses("lname")?></p>
									
									<!-------- added by Garry----------->
									<p>Service : <span id="taxServiceSum"><?=ses("taxServiceName")?></span></p>
									<p>Description : <span id="taxServiceDescription"><?=ses("taxServiceDescription")?></span></p>
									<p>Tax Year : <span id="taxYearSum"><?=ses("taxYear")?></span></p>
									<p>Office Location : <span id="officeLocationSum"><?=ses("officeLocation")?></span></p>
									<p>Delivered by : <span id="deliverySum"><?=ses("delivery")?></span></p>
									<p>With Consultant : <span id="consultantSum"><?=ses("consultantName")?></span></p>
									<!------------------------------------>
									
                                    <p>Date booked : <span id="selectDate"><?=ses("selectedDate")?></span></p>
                                    <p>Start Time : <span id="selectTime"><?=ses("selectedTime")?></span></p>
									<p>Duration : <span id="duration"><?=ses("service_duration")?> minutes</span></p>
									<p>Total : $<span id="price"><?=ses("price")?></span></p>
                                 </div>
                              </div>
							 </div>
						  </fieldset>
					   </div>
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
						   <form id="step3form" action="step4.php">
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
                              <a href="step2.php" type="button" role="button" class="ato-button btn btn-default btnHalf" id="step3back">Back</a>
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
                              <button type="submit" role="button" class="ato-button btn btn-secondary btnHalf" id="step3next" data-submit="true" disabled>Next</button>
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
</body>
</html>