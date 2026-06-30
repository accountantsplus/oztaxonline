<?php
if(!isset($_SESSION)) session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
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
   <script id="bootstrap-3.3.7.min" src="ui/scripts/vendor/bootstrap-3.3.7.min.js"></script>
   <script id="bootstrap-datetimepicker-2.3.4-dds.min" src="ui/scripts/vendor/bootstrap-datetimepicker-2.3.4-dds.min.js"></script>
   <script id="bootstrap-datetimepicker-2.3.4-dds.min" src="ui/scripts/vendor/bootstrap-datetimepicker-2.3.4-dds.min.js"></script>
   <script src="js/step5.js"></script>
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
                                    <span>Appointment Confirmation Successful</span>
                                 </h1>
                              </div>
                           </div>
                        </div>
                     </ato-heading>
                  </ato-page-header>
               </addclient-header>
               <section>
                  <div class="field-section">
                     <ato-text>
                        An email will be on its way to you at : <?= ses('email')?><br>You hit the Green button below to go back to homepage.
                     </ato-text>
                  </div>
                  <div class="field-section">
                     <ato-text>
                        See you soon at your tax appointment. 
                        <!--<img src="https://www.policetax.com.au/assets/img/printer22.png" alt="pic" width="60" height="60">-->
                        
                    </ato-text>
                  </div>
                  <ato-alert style="">
                        <div class="row ato-alert">
                           <div class="col-xs-12">
                              <div class="alert alert-block alert-info" id="atoo-clientadd-alertpanel-001-container" data-icon="" role="alert" aria-live="polite" tabindex="-1">
                                 <span class="sr-only" data-bind="html: accessibleType">information</span>
                                 <div class="ato-alert-content" id="atoo-clientadd-alertpanel-001-content">
                                    <p>Client Name: <?= ses('fname')?> <?= ses('lname')?></p>
                                    <p>Service: <?= ses('taxServiceName')?></p>
                                    <p>Delivered By: <?= ses('delivery')?></p>
                                    <p>With Consultant: <?= ses('consultantName')?></p>
                                    <p>Date Booked: <?= ses('selectedDate')?></p>
                                    <p>Start Time: <?= ses('selectedTime')?></p>
                                    <p>Duration: <?= ses('service_duration')?> minutes</p>
                                    <p>Total: $<?= ses('price')?> AUD</p>
                                    <p>Receipt Number: <?= ses('ReceiptId')?></p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </ato-alert>

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
                           <form action="step5.html">
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
                              <a href="http://www.policetax.com.au" role="button" class="ato-button btn btn-success btnHalf" id="step5next" data-submit="true">Return to Homepage</a>
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