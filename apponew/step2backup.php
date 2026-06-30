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
	if(!isset($_SESSION[$str])) return "checked";
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
 	<!--<link rel="stylesheet" type="text/css" media="all" href="ui/styles/vendor/bootstrap-datetimepicker-2.3.4.min.css">-->
	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/vendor/bootstrap-datepicker3-1.9.0.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/vendor/durandal-2.1.0.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/vendor/jquery.reject-1.1.0.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/vendor/animate.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/ato/fonts-v2.2.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/ato/v3/v3.01.min.css">
 	<link rel="stylesheet" type="text/css" media="all" href="ui/styles/ato/v3/browser-print-v3.min.css">
 	<script id="jquery-1.11.1.min" src="ui/scripts/vendor/jquery-1.11.1.min.js"></script>
 	<script id="jquery.reject-1.1.0.min" src="ui/scripts/vendor/jquery.reject-1.1.0.min.js"></script>
 	<script id="jquery.cookie-1.4.1.min" src="ui/scripts/vendor/jquery.cookie-1.4.1.min.js"></script>
 	<script id="bootstrap-3.3.7.min" src="ui/scripts/vendor/bootstrap-3.3.7.min.js"></script>
 	<script id="bootstrap-datetimepicker-2.3.4-dds.min" src="ui/scripts/vendor/bootstrap-datetimepicker-2.3.4-dds.min.js"></script>
 	<script id="bootstrap-datetimepicker-2.3.4-dds.min" src="ui/scripts/vendor/bootstrap-datepicker-1.9.0.min.js"></script>
   <script src="js/step2.js"></script>
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

                         <li class="active">
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
                                 <span data-bind="html: title">Tax Questions</span>
                              </h2>
                           </div>
                        </div>
                     </div>
                  </ato-heading>
               </addclient-header>
               <section>

                  <div class="field-section">
                     <div class="ato-radio row component-active" style="">
                        <div class="form-group col-xs-12 col-sm-6">
                           <fieldset>
                              <legend class="pad-for-horizontal">
                                 <ato-label><label class="control-label">Your Address Changed?</label></ato-label>
                              </legend>
                              <div class="col-xs-12 col-sm-12 no-gutters">
                                 <div>
                                    <div class="row no-gutters-right fld-group">
                                       <div class="col-xs-12 col-sm-6 fld-group-item">
                                          <div class="radio">
                                             <input type="radio" name="addressChange" id="addressChangeItem0" value="5" <?=isnotchecked("address")?>>
                                             <label class="justify" for="addressChangeItem0">No</label>
                                          </div>
                                       </div>
                                       
                                       <div class="col-xs-12 col-sm-6 fld-group-item">
                                          <div class="radio">
                                             <input type="radio" name="addressChange" id="addressChangeItem1" value="10" <?=ischecked("address")?>>
                                             <label class="justify" for="addressChangeItem1">Yes</label>
                                          </div>
                                       </div>

                                       <div id="elementToToggle" class="hidden" style="margin-left:10px;">
                                          <b>Please change my address to:</b>
                                          <div class="ato-radio row component-active">
                                             <div class="form-group col-xs-12">
                                                <fieldset>
                                                   <div class="col-xs-12 no-gutters">
                                                      <div class="row no-gutters-right">
                                                         <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <ato-label><label class="control-label" for="street">Street Address</label></ato-label>
                                                            <div class="col-xs-12 col-sm-12 no-gutters">
                                                               <div class="sel-input">
                                                                  <input type="text" class="form-control" id="street" required="required" value="<?=ses("street")?>">
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="col-xs-12 col-sm-12 col-md-6">
                                                            <ato-label><label class="control-label" for="suburb">Suburb</label></ato-label>
                                                            <div class="col-xs-12 col-sm-12 no-gutters">
                                                               <div class="sel-input">
                                                                  <input type="text" class="form-control" id="suburb" required="required" value="<?=ses("suburb")?>">
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="col-xs-12 col-sm-12 col-md-6">
                                                            <ato-label><label class="control-label" for="city">City</label></ato-label>
                                                            <div class="col-xs-12 col-sm-12 no-gutters">
                                                               <div class="sel-input">
                                                                  <input type="text" class="form-control" id="city" value="<?=ses("city")?>">
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12 no-gutters">
                                                      <div class="row no-gutters-right">
                                                         <div class="col-xs-6 col-sm-6 col-md-6">
                                                            <ato-label><label class="control-label" for="state">State</label></ato-label>
                                                            <div class="col-xs-12 col-sm-12 no-gutters">
                                                               <div class="sel-input">
                                                                  <input type="text" class="form-control" id="state" required="required" value="<?=ses("state")?>"aria-required="true">
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="col-xs-6 col-sm-6 col-md-4">
                                                            <ato-label><label class="control-label" for="postcode">Postcode</label></ato-label>
                                                            <div class="col-xs-12 col-sm-12 no-gutters">
                                                               <div class="sel-input">
                                                                  <input type="number" class="form-control" id="postcode" required="required" value="<?=ses("postcode")?>"aria-required="true">
                                                               </div>
                                                            </div>
                                                         </div>
                                                         
                                                      
                                                      </div>
                                                   </div>
                                                </fieldset>
                                             </div>
                                          </div>
                                       </div>
                                       
                                    </div>
                                 </div>
                              </div>
                           </fieldset>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6">
                           <fieldset>
                              <legend class="pad-for-horizontal">
                                 <ato-label><label class="control-label">Bank Account Changed?</label></ato-label>
                              </legend>
                              <div class="col-xs-12 col-sm-12 no-gutters">
                                 <div>
                                    <div class="row no-gutters-right fld-group">
                                       <div class="col-xs-12 col-sm-6 fld-group-item">
                                          <div class="radio">
                                             <input type="radio" name="bankChange" id="bankChangeItem0" value="5" <?=isnotchecked("bank")?>>
                                             <label class="justify" for="bankChangeItem0">No</label>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6 fld-group-item">
                                          <div class="radio">
                                             <input type="radio" name="bankChange" id="bankChangeItem1" value="10" <?=ischecked("bank")?>>
                                             <label class="justify" for="bankChangeItem1">Yes</label>
                                          </div>
                                       </div>

                                       <div id="elementToToggle2" class="hidden">
                                          <div class="col-xs-6 col-sm-6 col-md-6">
                                             <ato-label><label class="control-label" for="bsb">BSB for Refund</label></ato-label>
                                             <div class="col-xs-12 col-sm-12 no-gutters">
                                                <div class="sel-input">
                                                   <input type="number" class="form-control" id="bsb" required="required" value="<?=ses("bsb")?>">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xs-6 col-sm-6 col-md-6">
                                             <ato-label><label class="control-label" for="account">Bank Account</label></ato-label>
                                             <div class="col-xs-12 col-sm-12 no-gutters">
                                                <div class="sel-input">
                                                   <input type="number" class="form-control" id="account" required="required" value="<?=ses("account")?>">
                                                </div>
                                             </div>
                                          </div>
                                       </div>                                       
                                       
                                    </div>
                                 </div>
                              </div>
                           </fieldset>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6">
                           <fieldset>
                              <legend class="pad-for-horizontal">
                                 <ato-label><label class="control-label">Have Spouse/defacto</label></ato-label>
                              </legend>
                              <div class="col-xs-12 col-sm-12 no-gutters">
                                 <div>
                                    <div class="row no-gutters-right fld-group">
                                       <div class="col-xs-12 col-sm-6 fld-group-item">
                                          <div class="radio">
                                             <input type="radio" name="spouse" id="spouseItem0" value="5" <?=isnotchecked("spouse")?>>
                                             <label class="justify" for="spouseItem0">No</label>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6 fld-group-item">
                                          <div class="radio">
                                             <input type="radio" name="spouse" id="spouseItem1" value="10" <?=ischecked("spouse")?>>
                                             <label class="justify" for="spouseItem1">Yes</label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </fieldset>
                        </div>                        
                        <div class="form-group col-xs-12 col-sm-6">
                           <fieldset>
                              <legend class="pad-for-horizontal">
                                 <ato-label><label class="control-label">Spouse wants tax done?</label></ato-label>
                              </legend>
                              <div class="col-xs-12 col-sm-12 no-gutters">
                                 <div>
                                    <div class="row no-gutters-right fld-group">
                                       <div class="col-xs-12 col-sm-6 fld-group-item">
                                          <div class="radio">
                                             <input type="radio" name="spouseTax" id="spouseTaxItem0" value="5" <?=isnotchecked("spouseTax")?>>
                                             <label class="justify" for="spouseTaxItem0">No</label>
                                          </div>
                                       </div>
                                       
                                       <div class="col-xs-12 col-sm-6 fld-group-item">
                                          <div class="radio">
                                             <input type="radio" name="spouseTax" id="spouseTaxItem1" value="10" <?=ischecked("spouseTax")?>>
                                             <label class="justify" for="spouseTaxItem1">Yes</label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-sm-12 no-gutters" id="spouseNameDiv" style="<?php if(!isset($_SESSION['spouse']) || $_SESSION['spouse'] != 'checked') echo 'display: none'; ?>">
                                 <div>
                                          <div class="col-xs-6 col-sm-6 no-gutters-left">
                                          <ato-label><label class="control-label" for="spouseFirstName">Spouse First Name</label></ato-label>
                                             <input type="text" class="form-control" id="spouseFirstName" placeholder="First Name" value="<?=ses("spouseFirstName")?>">
                                          </div>
                                          <div class="col-xs-6 col-sm-6 no-gutters-right">
                                          <ato-label><label class="control-label" for="spouseLastName">Spouse Last Name</label></ato-label>
                                             <input type="text" class="form-control" id="spouseLastName" placeholder="Last Name" value="<?=ses("spouseLastName")?>">
                                          </div>
                                          <div class="col-xs-6 col-sm-6 no-gutters-left">
                                          <ato-label><label class="control-label" for="spouseDOB">Spouse DOB</label></ato-label>
                                             <input type="text" class="form-control" id="spouseDOB" placeholder="Date of Birth" value="<?=ses("spouseDOB")?>">
                                          </div>
                                 </div>
                              </div>
                           </fieldset>
                        </div>
                     </div>
                  </div>
                  
                  <ato-heading>
                     <div class="row">
                        <div class="col-xs-12">
                           <div class="ato-heading page-sub-header">
                              <h2>
                                 <span data-bind="html: title">Job Questions</span>
                              </h2>
                           </div>
                        </div>
                     </div>
                  </ato-heading>

                  <div class="field-section" id="clientDetails">
                     <ato-radio>
                        <div class="ato-radio row component-active">
                           <div class="form-group col-xs-12">
                              <fieldset>
                                 <div class="col-xs-12 no-gutters">
                                    <div class="row no-gutters-right">
                                       <div class="col-xs-12 col-sm-12 col-md-6">
                                          <ato-label><label class="control-label" for="workSector">Work Sector</label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
											<input type="hidden" class="form-control" id="id" required="required" value="<?=ses("id")?>">
                                            <select class="form-control" id="workSector">
												<option value="">Select Work Sector</option>
                                                <option value="PoliceOfficer" <?=isselected("workSector","PoliceOfficer")?>>Police</option>
                                                <option value="PSO" <?=isselected("workSector","PSO")?>>Protective Services</option>
                                                <option value="Federal" <?=isselected("workSector","Federal")?>>Federal Police</option>
                                                <option value="BorderForce" <?=isselected("workSector","BorderForce")?>>Border Force</option>
                                                <option value="Other" <?=isselected("workSector","Other")?>>Other</option>
                                            </select>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-12 col-md-6">
                                          <ato-label><label class="control-label" for="station">Station/Name Locale</label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <div class="sel-input">
                                                <input type="hidden" id="stationValue" value="<?=ses("station")?>">
                                                <input type="text" class="form-control" id="station" required="required" placeholder="My Station Name">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-xs-12 no-gutters" id="rankCol">
                                    <div class="row no-gutters-right">
                                       <div class="col-xs-12 col-sm-12 col-md-6">
                                          <ato-label><label class="control-label" for="email">Rank</label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
											<input type="hidden" class="form-control" id="idRank" required="required" value="<?=ses("Rank")?>">
                                             <select class="form-control" id="Rank">
												<option value="">Select rank</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-xs-6 col-sm-6 col-md-3">
                                          <ato-label><label class="control-label" for="email">Branch Type</label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <select class="form-control" id="branch">
												<option value="">Select Branch Type</option>											 
                                                <option value="Uni" <?=isselected("branch","Uni")?>>Uniform </option>
                                                <option value="Detect" <?=isselected("branch","Detect")?>>Detective</option>
                                                <option value="PC" <?=isselected("branch","PC")?>>Plain Clothes</option>
                                                <option value="Tact" <?=isselected("branch","Tact")?>>Tactical</option>
                                                <option value="Special" <?=isselected("branch","Special")?>>Specialist</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-xs-6 col-sm-6 col-md-3">
                                          <ato-label><label class="control-label" for="role">Role Type if applicable </label></ato-label>
                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                             <div class="sel-input">
                                                <input type="text" class="form-control" id="role" maxlength="15" required="required" placeholder="Specialist area/ task force" value="<?=ses("role")?>">
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
						   <form id="step2form" action="step3.php">
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
                              <a href="index.php" type="button" role="button" class="ato-button btn btn-default btnHalf" id="step2back">Back</a>
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
                              <button type="submit" role="button" class="ato-button btn btn-primary btnHalf" id="step2next" data-submit="true">Next</button>
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