<link rel="stylesheet" type="text/css" href="<?= asset_url('/assets/ext/jquery-fullcalendar/fullcalendar.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= asset_url('/ui/styles/ato/v3/v3.01.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= asset_url('/ui/styles/ato/v3/browser-print-v3.min.css') ?>">
<script src="<?= asset_url('assets/ext/moment/moment.min.js') ?>"></script>
<script src="<?= asset_url('assets/ext/jquery-fullcalendar/fullcalendar.js') ?>"></script>
<script src="<?= asset_url('assets/ext/jquery-sticky-table-headers/jquery.stickytableheaders.min.js') ?>"></script>
<script src="<?= asset_url('assets/ext/jquery-ui/jquery-ui-timepicker-addon.js') ?>"></script>
<script src="<?= asset_url('assets/js/backend_calendar.js') ?>"></script>
<script src="<?= asset_url('assets/js/backend_calendar_default_view.js') ?>"></script>
<script src="<?= asset_url('assets/js/backend_calendar_table_view.js') ?>"></script>
<script src="<?= asset_url('assets/js/backend_calendar_google_sync.js') ?>"></script>
<script src="<?= asset_url('assets/js/backend_calendar_appointments_modal.js') ?>"></script>
<script src="<?= asset_url('assets/js/backend_calendar_unavailabilities_modal.js') ?>"></script>
<script src="<?= asset_url('assets/js/backend_calendar_api.js') ?>"></script>
<script>
    var GlobalVariables = {
        'csrfToken': <?= json_encode($this->security->get_csrf_hash()) ?>,
        'availableProviders': <?= json_encode($available_providers) ?>,
        'availableServices': <?= json_encode($available_services) ?>,
        'baseUrl': <?= json_encode($base_url) ?>,
        'bookAdvanceTimeout': <?= $book_advance_timeout ?>,
        'dateFormat': <?= json_encode($date_format) ?>,
        'timeFormat': <?= json_encode($time_format) ?>,
        'editAppointment': <?= json_encode($edit_appointment) ?>,
        'customers': <?= json_encode($customers) ?>,
        'secretaryProviders': <?= json_encode($secretary_providers) ?>,
        'calendarView': <?= json_encode($calendar_view) ?>,
        'user': {
            'id': <?= $user_id ?>,
            'email': <?= json_encode($user_email) ?>,
            'role_slug': <?= json_encode($role_slug) ?>,
            'privileges': <?= json_encode($privileges) ?>
        }
    };

    $(document).ready(function() {
        BackendCalendar.initialize(GlobalVariables.calendarView);
    });
</script>

<div id="calendar-page" class="container-fluid">
    <div id="calendar-toolbar">
        <div id="calendar-filter" class="form-inline col-xs-12 col-sm-5">
            <div class="form-group">
                <label for="select-filter-item"><?= lang('display_calendar') ?></label>
                <select id="select-filter-item" class="form-control" title="<?= lang('select_filter_item_hint') ?>">
                </select>
            </div>
           
            <p style="color:white;">Cumul. appoints until today: <?= $appointments_untilToday_count . ' * 204 = $' . $appointments_untilToday_count * 204?></p>
            <p style="color:white;"> Future appoints : <?= $appointments_untilFuture_count . ' * 204 = $' . $appointments_untilFuture_count * 204 ?> 
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;  Total appoints: <?= $appointments_count . ' * 204 = $' . $appointments_count * 204 ?>  </p>
            
            
       
        </div>
        <div class="col-xs-12 col-sm-3">
            <h3 style="color: white;    text-align: left;">PoliceTax Appoints.Backend</h3>
        </div>
        <div id="calendar-actions" class="col-xs-12 col-sm-4">
            <?php if (($role_slug == DB_SLUG_ADMIN || $role_slug == DB_SLUG_PROVIDER)
                && Config::GOOGLE_SYNC_FEATURE == TRUE
            ) : ?>
                <button id="google-sync" class="btn btn-primary" title="<?= lang('trigger_google_sync_hint') ?>">
                    <span class="glyphicon glyphicon-refresh"></span>
                    <span><?= lang('synchronize') ?></span>
                </button>

                <button id="enable-sync" class="btn btn-default" data-toggle="button" title="<?= lang('enable_appointment_sync_hint') ?>">
                    <span class="glyphicon glyphicon-calendar"></span>
                    <span><?= lang('enable_sync') ?></span>
                </button>
            <?php endif ?>

            <?php if ($privileges[PRIV_APPOINTMENTS]['add'] == TRUE) : ?>
                <button id="insert-appointment" class="btn btn-default" title="<?= lang('new_appointment_hint') ?>">
                    <span class="glyphicon glyphicon-plus"></span>
                    <?= lang('appointment') ?>
                </button>

                <button id="insert-unavailable" class="btn btn-default" title="<?= lang('unavailable_periods_hint') ?>">
                    <span class="glyphicon glyphicon-plus"></span>
                    <?= lang('unavailable') ?>
                </button>
            <?php endif ?>

            <button id="reload-appointments" class="btn btn-default" title="<?= lang('reload_appointments_hint') ?>">
                <span class="glyphicon glyphicon-repeat"></span>
                <?= lang('reload') ?>
            </button>

            <button id="toggle-fullscreen" class="btn btn-default">
                <span class="glyphicon glyphicon-fullscreen"></span>
            </button>
            <p style="color:white;">Total appointments this week: <span class="currentWeek currentWeekTotalAppintments"><?= $appointment_Total_ThisWeek_count ?></span></p>
            
 
        </div>
    </div>
    
    
    
    
    
    
    
    

    <div id="calendar">
        <!-- Dynamically Generated Content -->
    </div>
</div>

<!-- MANAGE APPOINTMENT MODAL -->

<div id="manage-appointment" class="modal fade" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="title-appointment-view" class="modal-title" style="margin-right:25px;"><?= lang('edit_appointment_title') ?></h3>

            </div>

            <div class="modal-body">
                <div class="modal-message alert hidden"></div>
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li id="tab-one-appointment" role="presentation" class="active"><a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab"><i id="step-1-checked" class="fa fa-check custom-color-done" aria-hidden="true"></i>
                                <i id="step-1-warning" class="fa fa-times custom-color-warning" aria-hidden="true"></i>
                                <?= lang('customer_details_title') ?></a>

                        </li>
                        <li id="tab-four-appointment" role="presentation"><a href="#confiTab" aria-controls="confiTab" role="tab" data-toggle="tab"><i id="step-4-checked" class="fa fa-check custom-color-done" aria-hidden="true"></i><i id="step-4-warning" class="fa fa-times custom-color-warning" aria-hidden="true"></i>
                            Questions</a>
                        </li>
                        <li id="tab-three-appointment" role="presentation"><a href="#proTab" aria-controls="proTab" role="tab" data-toggle="tab"><i id="step-3-checked" class="fa fa-check custom-color-done" aria-hidden="true"></i><i id="step-3-warning" class="fa fa-times custom-color-warning" aria-hidden="true"></i>
                            Bookings</a>
                        </li>
                        <li id="tab-two-appointment" role="presentation"><a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab"><i id="step-2-checked" class="fa fa-check custom-color-done" aria-hidden="true"></i><i id="step-2-warning" class="fa fa-times custom-color-warning" aria-hidden="true"></i> Payment</a>

                        </li>
                        <li id="tab-five-appointment" role="presentation"><a href="#finaliseTab" aria-controls="finaliseTab" role="tab" data-toggle="tab"><i id="step-5-checked" class="fa fa-check custom-color-done" aria-hidden="true"></i><i id="step-5-warning" class="fa fa-times custom-color-warning" aria-hidden="true"></i> <?= lang('finalise_details_title') ?></a>

                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <form id="appointment-form">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="uploadTab">
                                <section>
                                  <div class="field-section">
                                     <ato-radio>
                                        <div class="ato-radio row component-active">
                                           <div class="form-group col-xs-12">
                                              <fieldset>
                                                 <legend>
                                                    <ato-label><label class="control-label" id="lbl-atoo-clientadd-select-your-client-type-001">Been to us before?<abbr class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                                 </legend>
                                                 <div class="col-sm-6 no-gutters">
                                                    <div>
                                                       <div class="row no-gutters-right">
                                                          <div class="col-xs-12">
                                                             <div class="radio">
                                                                <input type="radio" name="chooseClient" id="existClient" value="10">
                                                                <label class="justify" for="existClient">Yes -Existing Client (Proceed to Express check in)</label>
                                                             </div>
                                                          </div>
                                                          <div class="col-xs-12">
                                                             <div class="radio">
                                                                <input type="radio" name="chooseClient" id="newClient" value="20" checked="">
                                                                <label class="justify" for="newClient">No -I am a New Client (More Information required)</label>
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
                
                                  <div class="field-section" id="clientDetails" style="">
                                     <ato-radio>
                                        <div class="ato-radio row component-active">
                                           <div class="form-group col-xs-12">
                                              <fieldset>
                                                 <div class="col-xs-12 no-gutters">
                                                    <div class="row no-gutters-right">
                                                       <div class="col-xs-12 col-sm-12 col-md-4">
                                                          <ato-label><label class="control-label" for="fname">First name<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                                             <div class="sel-input">
                												<input type="hidden" class="form-control" id="id" required="required" value="">
                                                                <input type="text" class="form-control" id="fname" required="required" value="test">
                                                             </div>
                                                          </div>
                                                       </div>
                                                       <div class="col-xs-12 col-sm-12 col-md-4">
                                                          <ato-label><label class="control-label" for="lname">Last name<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                                             <div class="sel-input">
                                                                <input type="text" class="form-control" id="lname" required="required" value="test">
                                                             </div>
                                                          </div>
                                                       </div>
                                                       <div class="col-xs-12 col-sm-12 col-md-4">
                                                          <ato-label><label class="control-label" for="dob">Date of birth<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                                             <div class="sel-input">
                                                                <input type="text" class="form-control" id="dob" required="required" placeholder="dd/mm/yyyy" size="10" maxlength="10" value="22/02/1990">
                                                             </div>
                                                          </div>
                										  <ul id="doberror" class="error text-danger" style="display: none">Please input correct date</ul>
                                                       </div>
                                                    </div>
                                                 </div>
                                                 <div class="col-xs-12 no-gutters">
                                                    <div class="row no-gutters-right">
                                                       <div class="col-xs-12 col-sm-12 col-md-4">
                                                          <ato-label><label class="control-label" for="email">Email<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                                             <div class="sel-input">
                                                                <input type="email" class="form-control" id="email" required="required" value="test@asd.com">
                                                             </div>
                                                          </div>
                                                <ul id="emailerror" class="error text-danger" style="display: none">Please input correct email</ul>
                                                       </div>
                                                       <div class="col-xs-12 col-sm-12 col-md-4">
                                                          <ato-label><label class="control-label" for="mob">Mobile<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                                             <div class="sel-input">
                                                                <input type="tel" class="form-control" id="mob" required="required" value="1231231231">
                                                             </div>
                                                          </div>
                                                       </div>
                                                       <div class="col-xs-12 col-sm-12 col-md-4">
                                                          <ato-label><label class="control-label" for="tfn">TFN</label> (Optional if known)</ato-label>
                                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                                             <div class="sel-input">
                												<input autocomplete="on" style="opacity: 0; position: absolute; pointer-events: none">
                                                                <input autocomplete="off" type="password" class="form-control" id="tfn" required="required" value="">
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
                				  
                				  
                				  <div class="field-section" id="clientDetails2" style="">
                					  <ato-heading>
                						 <div class="row">
                							<div class="col-xs-12">
                							   <div class="ato-heading page-sub-header">
                								  <h2>
                									 <span data-bind="html: title">Other Information</span>
                								  </h2>
                							   </div>
                							</div>
                						 </div>
                					  </ato-heading>
                
                                     <ato-radio>
                                        <div class="ato-radio row component-active">
                                           <div class="form-group col-xs-12">
                                              <fieldset>
                                                 <div class="col-xs-12 no-gutters">
                                                    <div class="row no-gutters-right">
                                                       <div class="col-xs-12 col-sm-12 col-md-4">
                                                          <ato-label><label class="control-label" for="street">Street Address</label></ato-label>
                                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                                             <div class="sel-input">
                                                                <input type="text" class="form-control" id="street" required="required" value="">
                                                             </div>
                                                          </div>
                                                       </div>
                                                       <div class="col-xs-12 col-sm-12 col-md-4">
                                                          <ato-label><label class="control-label" for="suburb">Suburb</label></ato-label>
                                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                                             <div class="sel-input">
                                                                <input type="text" class="form-control" id="suburb" required="required" value="">
                                                             </div>
                                                          </div>
                                                       </div>
                                                       <div class="col-xs-12 col-sm-12 col-md-4">
                                                          <ato-label><label class="control-label" for="city">City</label></ato-label>
                                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                                             <div class="sel-input">
                                                                <input type="text" class="form-control" id="city" value="">
                                                             </div>
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </div>
                                                 <div class="col-xs-12 no-gutters">
                                                    <div class="row no-gutters-right">
                                                       <div class="col-xs-6 col-sm-6 col-md-2">
                                                          <ato-label><label class="control-label" for="state">State</label></ato-label>
                                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                                             <div class="sel-input">
                                                                <input type="text" class="form-control" id="state" required="required" value="" aria-required="true">
                                                             </div>
                                                          </div>
                                                       </div>
                                                       <div class="col-xs-6 col-sm-6 col-md-2">
                                                          <ato-label><label class="control-label" for="postcode">Postcode</label></ato-label>
                                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                                             <div class="sel-input">
                                                                <input type="number" class="form-control" id="postcode" required="required" value="" aria-required="true">
                                                             </div>
                                                          </div>
                                                       </div>
                                                       <div class="col-xs-6 col-sm-6 col-md-2">
                                                          <ato-label><label class="control-label" for="bsb">BSB for Refund</label></ato-label>
                                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                                             <div class="sel-input">
                                                                <input type="number" class="form-control" id="bsb" required="required" value="">
                                                             </div>
                                                          </div>
                                                       </div>
                                                       <div class="col-xs-6 col-sm-6 col-md-2">
                                                          <ato-label><label class="control-label" for="account">Bank Account</label></ato-label>
                                                          <div class="col-xs-12 col-sm-12 no-gutters">
                                                             <div class="sel-input">
                                                                <input type="number" class="form-control" id="account" required="required" value="">
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
                                           <form id="step1form" action="step2.php">
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
                                              <button type="reset" role="button" class="ato-button btn btn-danger btnHalf" id="step1cancel">Reset</button>
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
                                              <button type="submit" role="button" class="ato-button btn btnHalf btn-primary" id="step1next" data-submit="true">Next</button>
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
                                <div class="modal-footer">
                                    <!-- <button id="first-tab-next" class="btn btn-primary"><?= lang('next') ?></button>
                                    <button id="first-tab-next-spouse" class="btn btn-primary"><?= lang('next') ?></button> -->
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="confiTab">
                                <fieldset>
                                    <input id="appointment-id" type="hidden">

                                    <div class="row">
                                        <div id="info-three" class="alert alert-info">
                                            <p id="info-three-p">Below fields are not mandatory. But, Please ask them if they have these info handy.</p>
                                        </div>
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
                                                                     <input type="radio" name="addressChange" id="addressChangeItem0" value="5">
                                                                     <label class="justify" for="addressChangeItem0">No</label>
                                                                  </div>
                                                               </div>
                                                               
                                                               <div class="col-xs-12 col-sm-6 fld-group-item">
                                                                  <div class="radio">
                                                                     <input type="radio" name="addressChange" id="addressChangeItem1" value="10">
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
                                                                                          <input type="text" class="form-control" id="street" required="required" value="">
                                                                                       </div>
                                                                                    </div>
                                                                                 </div>
                                                                                 <div class="col-xs-12 col-sm-12 col-md-6">
                                                                                    <ato-label><label class="control-label" for="suburb">Suburb</label></ato-label>
                                                                                    <div class="col-xs-12 col-sm-12 no-gutters">
                                                                                       <div class="sel-input">
                                                                                          <input type="text" class="form-control" id="suburb" required="required" value="">
                                                                                       </div>
                                                                                    </div>
                                                                                 </div>
                                                                                 <div class="col-xs-12 col-sm-12 col-md-6">
                                                                                    <ato-label><label class="control-label" for="city">City</label></ato-label>
                                                                                    <div class="col-xs-12 col-sm-12 no-gutters">
                                                                                       <div class="sel-input">
                                                                                          <input type="text" class="form-control" id="city" value="">
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
                                                                                          <input type="text" class="form-control" id="state" required="required" value=""aria-required="true">
                                                                                       </div>
                                                                                    </div>
                                                                                 </div>
                                                                                 <div class="col-xs-6 col-sm-6 col-md-4">
                                                                                    <ato-label><label class="control-label" for="postcode">Postcode</label></ato-label>
                                                                                    <div class="col-xs-12 col-sm-12 no-gutters">
                                                                                       <div class="sel-input">
                                                                                          <input type="number" class="form-control" id="postcode" required="required" value=""aria-required="true">
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
                                                                     <input type="radio" name="bankChange" id="bankChangeItem0" value="5">
                                                                     <label class="justify" for="bankChangeItem0">No</label>
                                                                  </div>
                                                               </div>
                                                               <div class="col-xs-12 col-sm-6 fld-group-item">
                                                                  <div class="radio">
                                                                     <input type="radio" name="bankChange" id="bankChangeItem1" value="10">
                                                                     <label class="justify" for="bankChangeItem1">Yes</label>
                                                                  </div>
                                                               </div>
                        
                                                               <div id="elementToToggle2" class="hidden">
                                                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                                                     <ato-label><label class="control-label" for="bsb">BSB for Refund</label></ato-label>
                                                                     <div class="col-xs-12 col-sm-12 no-gutters">
                                                                        <div class="sel-input">
                                                                           <input type="number" class="form-control" id="bsb" required="required" value="">
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                                                     <ato-label><label class="control-label" for="account">Bank Account</label></ato-label>
                                                                     <div class="col-xs-12 col-sm-12 no-gutters">
                                                                        <div class="sel-input">
                                                                           <input type="number" class="form-control" id="account" required="required" value="">
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
                                                                     <input type="radio" name="spouse" id="spouseItem0" value="5" >
                                                                     <label class="justify" for="spouseItem0">No</label>
                                                                  </div>
                                                               </div>
                                                               <div class="col-xs-12 col-sm-6 fld-group-item">
                                                                  <div class="radio">
                                                                     <input type="radio" name="spouse" id="spouseItem1" value="10">
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
                                                                     <input type="radio" name="spouseTax" id="spouseTaxItem0" value="5">
                                                                     <label class="justify" for="spouseTaxItem0">No</label>
                                                                  </div>
                                                               </div>
                                                               
                                                               <div class="col-xs-12 col-sm-6 fld-group-item">
                                                                  <div class="radio">
                                                                     <input type="radio" name="spouseTax" id="spouseTaxItem1" value="10">
                                                                     <label class="justify" for="spouseTaxItem1">Yes</label>
                                                                  </div>
                                                               </div>
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
                        											<input type="hidden" class="form-control" id="id" required="required" value="">
                                                                    <select class="form-control" id="workSector">
                        												<option value="">Select Work Sector</option>
                                                                        <option value="PoliceOfficer">Police</option>
                                                                        <option value="PSO">Protective Services</option>
                                                                        <option value="Federal">Federal Police</option>
                                                                        <option value="BorderForce">Border Force</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                  </div>
                                                               </div>
                                                               <div class="col-xs-12 col-sm-12 col-md-6">
                                                                  <ato-label><label class="control-label" for="station">Station/Name Locale</label></ato-label>
                                                                  <div class="col-xs-12 col-sm-12 no-gutters">
                                                                     <div class="sel-input">
                                                                        <input type="hidden" id="stationValue" value="">
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
                        											<input type="hidden" class="form-control" id="idRank" required="required" value="">
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
                                                                        <option value="Uni">Uniform </option>
                                                                        <option value="Detect">Detective</option>
                                                                        <option value="PC" >Plain Clothes</option>
                                                                        <option value="Tact" >Tactical</option>
                                                                        <option value="Special" >Specialist</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                               <div class="col-xs-6 col-sm-6 col-md-3">
                                                                  <ato-label><label class="control-label" for="role">Role Type if applicable </label></ato-label>
                                                                  <div class="col-xs-12 col-sm-12 no-gutters">
                                                                     <div class="sel-input">
                                                                        <input type="text" class="form-control" id="role" maxlength="15" required="required" placeholder="Specialist area/ task force" value="">
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
                                    </div>
                                </fieldset>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="proTab">
                                <fieldset>

                                    <div class="row">
                                        <div id="info-four" class="alert alert-info">
                                            <p id="info-four-p">Please make sure to collect below details from the client</p>
                                        </div>
                                        
                                        
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
                                                                        <option value="Remote" >Remote Video</option>
                                                                        <option value="Office">In Our Office</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                               <div class="col-xs-12 service-delivery-data">
                                                                  <ato-label><label class="control-label" for="delivery">Service delivery<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                                                  <div class="col-xs-12 col-sm-12 no-gutters">
                                                                     <select class="form-control" id="delivery">
                                                                        <option value="">Select method</option>
                                                                        <option value="Skype">Skype</option>
                                                                        <option value="Zoom">Zoom</option>
                                                                        <option value="Facetime">Apple Facetime</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="form-group col-xs-12 col-sm-12 col-md-4 no-gutters-left">
                                                            <div class="row no-gutters-right">
                                                               <div class="col-xs-12">
                                                                  <ato-label><label class="control-label" for="consultant">Tax Consultant<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                        										  <input type="hidden" class="form-control" id="consultantValue" required="required" value="">
                                                                  <select class="form-control" name="consultant" id="consultant">                                          
                        											 <option value="">Select Tax Consultant</option>
                                                                  </select>
                                                               </div>
                                                               <div class="col-xs-12">
                                                                  <ato-label><label class="control-label" for="noAttend">No.Attendees<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                                                  <div class="col-xs-12 col-sm-12 no-gutters">
                                                                     <select class="form-control" id="noAttend">
                                                                        <option value="1">Single  Taxpayer   &nbsp;x 1</option>
                                                                        <option value="2">Double/Couple   &nbsp; x 2</option>
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
                        											 <input type="hidden" class="form-control" id="taxServiceValue" required="required" value="">
                                                                     <select class="form-control" id="taxService">
                        												<option value="">Select Tax Service</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                               <div class="col-xs-12" id="spouseNameDiv" style="display: none">
                                                                  <div class="col-xs-6 col-sm-6 no-gutters-left">
                                                                  <ato-label><label class="control-label" for="spouseFirstName">Spouse First Name</label></ato-label>
                                                                     <input type="text" class="form-control" id="spouseFirstName" placeholder="First Name" value="">
                                                                  </div>
                                                                  <div class="col-xs-6 col-sm-6 no-gutters-right">
                                                                  <ato-label><label class="control-label" for="spouseLastName">Spouse Last Name</label></ato-label>
                                                                     <input type="text" class="form-control" id="spouseLastName" placeholder="Last Name" value="">
                                                                  </div>
                                                                  <div class="col-xs-6 col-sm-6 no-gutters-right">
                                                                  <ato-label><label class="control-label" for="spouseLastName">Spouse DOB</label></ato-label>
                                                                     <input type="text" class="form-control" id="spouseDOB" placeholder="Date of Birth" value="">
                                                                  </div>
                                                                  
                                                                  
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
                        										<input type="hidden" class="form-control" id="selectedDateValue" required="required" value="">
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
                        								<input type="hidden" class="form-control" id="selectedTimeValue" required="required" value="">
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
                                                      <div class="alert alert-block alert-info" id="atoo-clientadd-alertpanel-001-container" data-icon="" role="alert" aria-live="polite" tabindex="-1">
                                                         <span class="sr-only" data-bind="html: accessibleType">information</span>
                                                         <div class="ato-alert-content" id="atoo-clientadd-alertpanel-001-content">
                        									<p>Client Name : </p>
                        									
                        									<!-------- added by Garry----------->
                        									<p>Service : <span id="taxServiceSum"></span></p>
                        									<p>Tax Year : <span id="taxYearSum"></span></p>
                        									<p>Delivered by : <span id="deliverySum"></span></p>
                        									<p>With Consultant : <span id="consultantSum"></span></p>
                        									<!------------------------------------>
                        									
                                                            <p>Date booked : <span id="selectDate"></span></p>
                                                            <p>Start Time : <span id="selectTime"></span></p>
                        									<p>Duration : <span id="duration"> minutes</span></p>
                        									<p>Total : $<span id="price"></span></p>
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
                                    </div>
                                </fieldset>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="browseTab">
                                <fieldset>
                                    <legend><?= lang('appointment_details_title') ?></legend>

                                    <input id="appointment-id" type="hidden">

                                    <div class="row">
                                        <div id="info-five" class="alert alert-info">
                                            <p id="info-five-p">Please double check the appointment type, date and time from the client</p>
                                        </div>
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
                                                                  <ato-label><label class="control-label" for="name">Name on Card<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr>  </abbr></label></ato-label>
                                                                  <div class="col-xs-12 col-sm-12 no-gutters">
                                                                     <div class="sel-input">
                                                                        <input type="search" class="form-control" id="name" placeholder="Full Name on Card" required="required" value="">
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-xs-12 col-sm-12 col-md-4">
                                                                  <ato-label><label class="control-label" for="number">Number on Card<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                                                  <div class="col-xs-12 col-sm-12 no-gutters">
                                                                     <div class="sel-input">
                        												<input autocomplete="on" style="opacity: 0; position: absolute; pointer-events: none">
                                                                        <input autocomplete="off" type="text" class="form-control" id="number" placeholder="XXXX XXXX XXXX XXXX" size="16" maxlength="16" required="required" value="">
                                                                     </div>
                                                                  </div>
                                                               </div>
                        
                                                               <div class="col-xs-6 col-sm-6 col-md-2">
                                                                  <ato-label><label class="control-label" for="exp">Expiry date<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                                                  <div class="col-xs-12 col-sm-12 no-gutters">
                                                                     <div class="sel-input">
                        												<input autocomplete="on" style="opacity: 0; position: absolute; pointer-events: none">
                        												<input autocomplete="off" type="text" class="form-control" id="exp" required="required" placeholder="mm/yy" value="">
                                                                     </div>
                                                                  </div>
                                                               </div>
                        									   
                                                               <div class="col-xs-6 col-sm-6 col-md-2">
                                                                  <ato-label><label class="control-label" for="cvv">CVV<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                                                  <div class="col-xs-12 col-sm-12 no-gutters">
                                                                     <div class="sel-input">
                                                                        <input type="text" class="form-control" id="cvv" size="4" maxlength="4" required="required" placeholder="Back of card" value="">
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
                                                                        <input type="text" class="form-control" id="cname" required="required" disabled readonly value="">
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-xs-12 col-sm-12 col-md-4">
                                                                  <ato-label><label class="control-label" for="mob">Customer email<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                                                  <div class="col-xs-12 col-sm-12 no-gutters">
                                                                     <div class="sel-input">
                                                                        <input type="text" class="form-control" id="cemail" required="required" disabled readonly value="">
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="col-xs-12 col-sm-12 col-md-4">
                                                                  <ato-label><label class="control-label" for="tfn">Charge to card<abbr aria-hidden="true" class="required-indicator" title="Required"> *</abbr></label></ato-label>
                                                                  <div class="col-xs-12 col-sm-12 no-gutters">
                                                                     <div class="sel-input">
                        												<input type="hidden" class="form-control" id="initialpriceValue" required="required" value="">
                                                                        <input type="text" class="form-control" id="initialprice" required="required" placeholder="$" disabled readonly value="$ AUD">
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
                        												<input type="hidden" class="form-control" id="discountAmountValue" required="required" value="">
                                                                        <input type="text" class="form-control" id="discountAmount" required="required" placeholder="$" disabled readonly value="$ AUD">
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
                                                                  <ato-label><label class="control-label" for="tfn"><b>Final Amount to charge to card</b><abbr aria-hidden="true" class="required-indicator" title="Required"> </abbr></label></ato-label>
                                                                  <div class="col-xs-12 col-sm-12 no-gutters">
                                                                     <div class="sel-input">
                        												<input type="hidden" class="form-control" id="priceValue" required="required" value="">
                                                                        <input type="text" class="form-control" id="price" required="required" placeholder="$" disabled readonly value="$ AUD">
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
                                                   <form id="step4form" action="step5.php">
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
                                    </div>
                                </fieldset>
                                <!-- <div class="modal-footer">
                                    <button id="third-tab-back" class="btn btn-default"><?= lang('back') ?></button>
                                    <button id="third-tab-next" class="btn btn-primary"><?= lang('next') ?></button>
                                </div> -->
                            </div>

                            <div role="tabpanel" class="tab-pane" id="finaliseTab">
                                <input type="hidden" id="selectedPrice" value="" />
                                <fieldset>

                                    <div class="row">
                                        <div id="info-six" class="alert alert-info">
                                            <p id="info-six-p">Please don't forget to ask about the following from the client.</p>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">

                                            <div class="form-group">
                                                <label for="is-paid">Paid</label>
                                                <input type="checkbox" id="is-paid" name="is-paid" />
                                            </div>

                                            <div class="form-group">
                                                <label for="is-email-send">Send Email?</label>
                                                <input type="checkbox" id="is-email-send" name="is-email-send" checked />
                                            </div>

                                        </div>
                                        
                                          <!--How to connect video preference-->
                                        <div class="col-xs-12 col-sm-6">
                                        <!--Add/Remove Receptionists-->
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="staffMembers" class="control-label">Staff Member booking appointment</label>
                                                <select name="staffMembers" id="staffMembers" required="" class="form-control" aria-invalid="true">
                                                    <option value="">Select</option>
                                                    <option value="Anne" selected>Anne</option>
                                                    <option value="Soniya">Soniya</option>
                                                    <option value="Garry">Garry</option>
                                                    <option value="Reception 1">Reception 1</option>
                                                    <option value="Reception 2">Reception 2</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="modal-footer">
                                    <!-- <button id="fourth-tab-back" class="btn btn-default"><?= lang('back') ?></button> -->
                                    <button id="save-appointment" class="btn btn-primary"><?= lang('save') ?></button>
                                    <button id="cancel-appointment" class="btn btn-default" data-dismiss="modal"><?= lang('cancel') ?></button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>


            <br>


            </form>
        </div>
    </div>
</div>
</div>

<!-- MANAGE UNAVAILABLE MODAL -->

<div id="manage-unavailable" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><?= lang('new_unavailable_title') ?></h3>
            </div>
            <div class="modal-body">
                <div class="modal-message alert hidden"></div>

                <form>
                    <fieldset>
                        <input id="unavailable-id" type="hidden">

                        <div class="form-group">
                            <label for="unavailable-provider" class="control-label"><?= lang('provider') ?></label>
                            <select id="unavailable-provider" class="form-control"></select>
                        </div>

                        <div class="form-group">
                            <label for="unavailable-start" class="control-label"><?= lang('start') ?></label>
                            <input id="unavailable-start" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="unavailable-end" class="control-label"><?= lang('end') ?></label>
                            <input id="unavailable-end" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="unavailable-notes" class="control-label"><?= lang('notes') ?></label>
                            <textarea id="unavailable-notes" rows="3" class="form-control"></textarea>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button id="save-unavailable" class="btn btn-primary"><?= lang('save') ?></button>
                <button id="cancel-unavailable" class="btn btn-default" data-dismiss="modal"><?= lang('cancel') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- SELECT GOOGLE CALENDAR MODAL -->

<div id="select-google-calendar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><?= lang('select_google_calendar') ?></h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="google-calendar" class="control-label"><?= lang('select_google_calendar_prompt') ?></label>
                    <select id="google-calendar" class="form-control"></select>
                </div>
            </div>
            <div class="modal-footer">
                <button id="select-calendar" class="btn btn-primary"><?= lang('select') ?></button>
                <button id="close-calendar" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#select-filter-item").val(3107);
        $("#select-filter-item").trigger("change");
        
        $("#number-years-dd").attr("disabled", "disabled");
        $(".number-of-rental-property").hide();
        $("#rental-property-dd").val(0);
        fnValidate();
        
        $(document).on("click", ".fc-next-button", function(e){
            e.preventDefault();
            var currentMonday = $(document).find(".fc-mon").attr("data-date");
        });
        
        
        
        $(document).on("change", "#OccupationRole", function(e){
            e.preventDefault();
            var selectedVal = $("#OccupationRole option:selected").val();
            
            if(selectedVal == "PoliceOfficer"){
                $("#Rank").html("");
                $("#Rank").html(`<option value="Select">Select</option>
                                            <option value="Police Recruit">Police Recruit</option>
                                            <option value="SnrConstable">Snr Constable</option>
                                            <option value="1stConstable">First Constable</option>
                                            <option value="Constable">Constable</option>
                                            <option value="Leading Senior Constable">Leading Snr Constable</option>
                                            <option value="Sergeant">Sergeant</option>
                                            <option value="SnrSergeant">Snr Sergeant</option>
                                            <option value="Inspector">Inspector</option>
                                            <option value="Superintendent">Superintendent</option>
                                            <option value="HigherRank">Higher Rank</option>
                                            <option value="Rank">Rank</option>
                                            <option value="Other">Other</option>`);
            } else if(selectedVal == "PSO"){
                $("#Rank").html("");
                $("#Rank").html(`<option value="Select">Select</option>
                                            <option value="Recruit PSO"> Recruit PSO</option>
                                            <option value="PSO 1st Class">PSO 1st Class</option>
                                            <option value="PSO Senior">PSO Senior</option>
                                            <option value="PSO Sergent">PSO Sergent</option>
                                            <option value="PSO Supervisor">PSO Supervisor</option>
                                            <option value="PSO Snr Supervisor">PSO Snr Supervisor</option>
                                            <option value="Other">Other</option>`);
            } else if(selectedVal == "BorderForce"){
                $("#Rank").html("");
                $("#Rank").html(`<option value="Select">Select</option>
                                            <option value="Assist Officer">Assist Officer</option>
                                            <option value="Officer">Officer</option>
                                            <option value="Leading Officer">Leading Officer</option>
                                            <option value="Senior Officer">Senior Officer</option>
                                            <option value="Supervisor">Supervisor</option>
                                            <option value="Inspector">Inspector</option>
                                            <option value="Superintendent">Superintendent</option>
                                            <option value="Chief Superintendent">Chief Superintendent</option>
                                            <option value="HigherRank">Higher Rank</option>
                                            <option value="Commander">Commander</option>
                                            <option value="Other">Other</option>`);
            } else if(selectedVal == "Federal"){
                $("#Rank").html("");
                $("#Rank").html(`<option value="Select">Select</option>
                                            <option value="Recruit Trainee">Recruit Trainee</option>
                                            <option value="SnrConstable">Snr Constable</option>
                                            <option value="Constable">Constable</option>
                                            <option value="Leading Senior Constable">Leading Snr Constable</option>
                                            <option value="Sergeant">Sergeant</option>
                                            <option value="SnrSergeant">Snr Sergeant</option>
                                            <option value="Commander">Commander</option>
                                            <option value="HigherRank">Higher Rank</option>
                                            <option value="Other">Other</option>`);
            } else if(selectedVal == "Other") {
                $("#Rank").html("");
                $("#Rank").html(`<option value="Select">Select</option>
                                            <option value="Other">Other</option>`);
            } else {
                $("#Rank").html("");
                $("#Rank").html(`<option value="Select">Select</option>`);
            }
            
        });

        if ($('#first-name').val() != "") {
            $('#whois').append($(this).val());
        }

        $('#first-name').keyup(function() {
            $('#whois').append($(this).val());
        });

        $('input[type=radio][name="rental-property"]').change(function(e) {
            e.preventDefault();
            
            if($('input[type=radio][name="rental-property"]:checked').attr("id") == "rental-property-yes") {
                $("#rental-property-dd").val(1);
                $(".number-of-rental-property").show();
            } else {
                $(".number-of-rental-property").hide();
                $("#rental-property-dd").val(0);
            }
        });

        $('input[type=radio][name="overdue-Tax"]').change(function(e) {
            e.preventDefault();
            
            if($('input[type=radio][name="overdue-Tax"]:checked').attr("id") == "overdue-Tax-no") {
                $("#number-years-dd").val("1");
                $("#number-years-dd").attr("disabled", "disabled");
            } else {
                $("#number-years-dd").removeAttr("disabled");
            }
        });

        $('#spouse-details-yes').click(function() {
            if ($('#spouse-details-yes').is(':checked')) {
                $('#spouse-tab').toggle();
                $('#first-tab-next').hide();
                $('#first-tab-next-spouse').show();
            }
        });
        $('#spouse-details-no').click(function() {
            if ($('#spouse-details-no').is(':checked')) {
                $('#spouse-tab').hide();
                $('#first-tab-next-spouse').hide();
                $('#first-tab-next').show();
            }
        });
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#bsb");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $('#first-tab-next-spouse').hide();
        $('#step-1-checked').hide();
        //$('#step-spouse-checked').hide();
        $('#step-2-checked').hide();
        $('#step-3-checked').hide();
        $('#step-4-checked').hide();
        $('#step-5-checked').hide();


        $('input[name="changeAddress"]').click(function() {
            if ($('#changeAddress-yes').is(':checked')) {
                $('.address-user').show();
                $("#address").attr("required", "required");
                $("#city").attr("required", "required");
                $("#post-code").attr("required", "required");
            } else if ($('#changeAddress-no').is(':checked')) {
                $('.address-user').hide();
                $("#address").removeAttr("required");
                $("#city").removeAttr("required");
                $("#post-code").removeAttr("required");
            }
        });

        $('#changed-details-yes').click(function() {
            if ($('#changed-details-yes').is(':checked')) {
                $('#appointment-amend').modal().show();
            }
        });

        $('input[name="bsb-bankaccountchanged"]').click(function() {
            if ($('#bsb-bankaccountchanged-yes').is(':checked')) {
                $('.bank-details-tab').show();
            } else if ($('#bsb-bankaccountchanged-no').is(':checked')) {
                $('.bank-details-tab').hide();
            }
        });

        $(document).on("click", "#new-yes", function(){
            $(".beenwithusYes").hide();
            $('#bank-details-tab').hide();
            $('.address-user').hide();
            $(".beenwithusYes").show();
            $('.bank-details-tab').hide();
            $('#select-exist-client-detail').show();
            $(".beenwithusNo").hide();
            //$('#manage-appointment').modal().show();
        });

        $(document).on("click", "#new-no", function(){
            $(".beenwithusYes").hide();
            $('#bank-details-tab').show();
            $('.address-user').show();
            $("input[id='changeAddress-yes']"). prop("checked", false);
            $("input[id='changeAddress-no']"). prop("checked", false);
            $("input[id='bsb-bankaccountchanged-yes']").prop("checked", false);
            $("input[id='bsb-bankaccountchanged-no']").prop("checked", false);
            $('#select-exist-client-detail').show();
            $(".beenwithusNo").show();

            //$('#manage-appointment').modal().show();
        });
        $(':input').keyup(function() {
            fnValidate();

        });
        
        $('input').on("click", function() {
            fnValidate();

        });
        
        $('select').on("change", function() {
            fnValidate();

        });
        
        function fnValidate(){
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if ($('#first-name').val() != '' && $('#last-name').val() != '' && $('#email').val() != '' && $('#phone-number').val() != '' 
                    && $('#address').val() != '') {
                        if($("input[name='changeAddress']:checked").attr("id") == "changeAddress-yes"  && $('#city').val() != '' && $('#post-code').val() != ''){
                            
                            $('#step-1-checked').show();
                            $('#step-1-warning').hide();
                        }else if($("input[name='changeAddress']:checked").attr("id") == "changeAddress-no"){
                            
                            $('#step-1-checked').show();
                            $('#step-1-warning').hide();
                        } else{
                            $('#step-1-checked').hide();
                            $('#step-1-warning').show();
                        }
            } else {
                $('#step-1-checked').hide();
                $('#step-1-warning').show();

            }

            if ($('#spouse-firstname').val() != '' && $('#spouse-lastname').val() != '' && $('#spouse-tfn').val() != '' && $('#spouse-dob').val() != '' && $('#spouse-occ').val() != '') {
                //$('#step-spouse-checked').show();
                $('#step-spouse-warning').hide();
            } else {
                //$('#step-spouse-checked').hide();
                $('#step-spouse-warning').show();
            }

            if (($("#OccupationRole").val() != '' && $("#Rank").val() != '' && $("#station").val() != '')) {
                
                $('#step-3-checked').show();
                $('#step-3-warning').hide();

            } else {
                $('#step-3-checked').hide();
                $('#step-3-warning').show();
            }

            if ($("input[name='rental-property']:checked").val()  == "" && $("input[name='captial-gains']:checked").val() == "") {
                $('#step-4-checked').show();
                $('#step-4-warning').hide();
            } else {
                $('#step-4-checked').hide();
                $('#step-4-warning').show();
            }

            if ($('#staffMembers').val() != '' && $('#tax-year').val() != '') {
                
                $('#step-5-checked').show();
                $('#step-5-warning').hide();

            } else {
                $('#step-5-checked').hide();
                $('#step-5-warning').show();
            }
        }

        $('select').change(function () {
            if ($('#select-provider').val()!="" && $('#start-datetime').val()!="" && $('#end-datetime').val()!="") {
                $('#step-2-checked').show();
                $('#step-2-warning').hide();
            } else {
                $('#step-2-checked').hide();
                $('#step-2-warning').show();
            }
        });

        $('#new-yes').click(function() {
            $('#new-yes').removeClass("btn-default");
            $('#new-yes').addClass("btn-success");
            $('#new-no').removeClass("btn-success");
            $('#new-no').addClass("btn-default");
            $('#new-customer').hide();
            $('#select-customer').show();
        });
        $('#new-no').click(function() {
            $('#new-no').removeClass("btn-default");
            $('#new-no').addClass("btn-success");
            $('#new-yes').removeClass("btn-success");
            $('#new-yes').addClass("btn-default");
            $('#select-customer').hide();
            $('#new-customer').show();
        });
        $(".toggle-tfn").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#tfn");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        var currentTime = new Date();
        var inityear = currentTime.getFullYear();
        for (var i = 0; i < 5; i++) {
            $("#tax-year").append($('<option>', {
                value: inityear,
                text: inityear
            }));
            inityear -= 1;
        }
    });
</script>