<link rel="stylesheet" type="text/css" href="<?= asset_url('/assets/ext/jquery-fullcalendar/fullcalendar.css') ?>">
<style>
    .radio{
        padding: 0;
  margin: 5px 0;
  border: 1px solid #a0a0a0;
  box-sizing: border-box;
  border-radius: 2px;
  width: 38%;
    }
    
     .ato-wizard.nav-tabs>li.active>a {
  border:1px transparent;
  box-shadow: inset 0 -2px 0 #fff;
}
.ato-wizard.nav-tabs>li>a {
  box-shadow: inset 0 -2px 0 #fff;
}
ul.ato-wizard {
  border:0 none;
  margin:20px 0;
}
.ato-wizard li .wizard-tab-title {
  display:none
}
.ato-wizard li a .wizard-tabs-number {
  width:50px;
  height:50px;
  line-height:48px;
  line-height:4.8rem;
  font-size:17px;
  font-size:1.7rem
}
.ato-wizard .panel.panel-default {
  border-color:#767676
}
.ato-wizard .panel-success .panel-title.collapsed:before,
.ato-wizard .panel-success .panel-title:before {
  content:"\E0AC";
  color:#0e8387
}
.ato-wizard li:after,
.ato-wizard li:before {
  content:"";
  width:8px;
  height:8px;
  background-color:#ccc;
  display:inline-block;
  border-radius:50%;
  position:absolute;
  bottom:41px;
  z-index:1
}
.ato-wizard li:before {
  left:4px
}
.ato-wizard li:after {
  right:4px
}
.ato-wizard li:first-child:before,
.ato-wizard li:last-child:after {
  display:none
}
.ato-wizard li .wizard-tab-title {
  padding:5px 0;
  margin:0 5px;
  text-align:center;
  font-weight:400;
  position:relative;
  width:140px;
  display:block;
  line-height:1.2
}
.ato-wizard li .wizard-tab-title .triangle {
  width:0;
  height:0;
  border-left:12px solid transparent;
  border-right:12px solid transparent;
  border-top:12px solid transparent;
  margin-left:-12px;
  margin-right:auto;
  position:absolute;
  bottom:-12px;
  left:50%;
  z-index:1
}
.ato-wizard li a {
  border:none;
  background:0 0;
  padding:0 12px
}.alert-block[data-icon], [class*="icon-"].alert-block {
  padding-left: 45px;
}
.alert-block {
  padding: 19px 15px 10px 15px;
    padding-left: 15px;
  margin: 0;
  position: relative;
}
.alert-info {
  color: #000;
  font-weight: 400;
}
.alert-attention, .alert-info {
  border-left: 4px solid #0e8387;
}
ul.ato-wizard li>a {
  margin-right:0
}
.ato-wizard li a:hover {
  border:none;
  background-color:transparent;
  cursor:default
}
.ato-wizard li a:focus {
  outline:0;
  border:none;
  -moz-box-shadow:none;
  -webkit-box-shadow:none;
  box-shadow:none
}
.ato-wizard .wizard-tabs-number {
  border:solid 2px #ccc;
  padding:0;
  margin:15px auto 0 auto;
  height:90px;
  width:90px;
  display:block;
  line-height:88px;
  text-align:center;
  font-weight:400;
  font-size:2.8rem;
  background:#ccc;
  border-radius:50%;
  color:#666
}
.ato-wizard .completed .wizard-tabs-number {
  border:solid 2px #0e8387;
  background-color:#e4f3f4;
  color:#0e8387
}
.ato-wizard .active .wizard-tabs-number {
  border:solid 2px #0e8387;
  background-color:#0e8387;
  color:#fff;
}
.ato-wizard li.valid a .wizard-tabs-number {
  border:solid 2px #0e8387;
  background-color:#fff;
  color:#0e8387
}
.ato-wizard {
  max-width:800px;
  display:table
}
.ato-wizard li:first-child::before,
.ato-wizard li:last-child::after {
  display:none
}
.ato-wizard li {
  margin:25px 5px 0 0;
  display:table-cell;
  /*! vertical-align:bottom; *//*! float:none */
}
.ato-wizard li a {
  border:none;
  background:0 0;
  color:#333;
  text-decoration:none
}
.ato-wizard li a:focus {
  border-color:#0e8387;
  background-color:#fff;
  outline:0 #0e8387;
  border-collapse:separate;
  -webkit-box-shadow:0 0 0 1px #0e8387;
  -moz-box-shadow:0 0 0 1px #0e8387;
  box-shadow:0 0 0 1px #0e8387
}
.ato-wizard .active .wizard-tab-title {
  color:#fff;
  background-color:#fff;
}
.ato-wizard li .wizard-tab-title {
  padding:5px 15px;
  margin:15px 5px;
  /*! text-align:center; */position:relative;
  display:block;
  /*! line-height:1.2; *//*! font-size:15px; *//*! font-size:1.5rem; *//*! font-weight:700 */
}
.ato-wizard li .wizard-tab-title .triangle {
  width:0;
  height:0;
  border-left:12px solid transparent;
  border-right:12px solid transparent;
  border-top:12px solid transparent;
  margin-left:-12px;
  margin-right:auto;
  position:absolute;
  bottom:-12px;
  left:50%;
  z-index:1
}
.ato-wizard li.completed:hover a {
  cursor:pointer
}
.ato-wizard li.valid>a .wizard-tabs-number {
  border:2px solid #0e8387;
  background-color:#fff;
  color:#0e8387
}
.ato-wizard li .active .wizard-tabs-number {
  border:2px solid #0e8387;
  background-color:#0e8387;
  color:#fff
}
.ato-wizard li a .wizard-tabs-number {
  border:2px solid #ccc;
  padding:0;
  margin:15px auto 0;
  height:90px;
  width:90px;
  display:block;
  line-height:88px;
  text-align:center;
  font-weight:400;
  font-size:2.8rem;
  background:#ccc;
  border-radius:50%;
  color:#666
}
.ato-wizard li>a.active>.wizard-tabs-number {
  background-color:#0e8387;
  border:2px solid #0e8387;
  color:#fff
}
.ato-wizard .active .wizard-tab-title {
  background:#254351;
  color:#fff;
  padding:5px 5px;
}
.ato-wizard .active .wizard-tab-title .triangle {
  /*! border-top:10px solid #254351; *//*! border-left:10px solid transparent; *//*! border-right:10px solid transparent; *//*! bottom:-20px; *//*! height:20px; *//*! width:20px */
}
.ato-wizard .panel.panel-success {
  border-color:#0e8387
}
.ato-wizard>.panel-success>.panel-heading>.panel-title.collapsed {
  background:#fff;
  color:#333;
  border-radius:0
}
.ato-wizard>.panel-success>.panel-heading>.panel-title {
  background:#0e8387;
  color:#fff
}
.ato-wizard>.panel-success>.panel-heading>.panel-title.collapsed:before,
.ato-wizard>.panel-success>.panel-heading>.panel-title:before {
  font-size:33px;
  font-size:3.3rem;
  padding-right:10px;
  line-height:1;
  position:absolute;
  top:17px;
  right:0
}
.ato-wizard>.panel-success>.panel-heading>.panel-title:before {
  content:"\E0AC";
  color:#0e8387
}
.ato-wizard>.panel-success>.panel-heading>.panel-title.collapsed:before {
  content:"\E0AC";
  color:#0e8387
}
.ato-wizard li a {
  padding:0
}
.ato-wizard li a .wizard-tabs-number,
.ato-wizard li a .wizard-tabs-number-no-hover {
  width:70px;
  height:70px;
  font-size:2rem;
  line-height:68px
}
.ato-wizard li .wizard-tab-title,
.ato-wizard li .wizard-tab-title-no-hover {
  font-size:14px;
  font-size:1.4rem;
  width:140px
}
.ato-home-page-container {
  margin-top:20px
}
.additional-pills {
  padding-left:40px;
  padding-top:10px
}
ato-table ato-table-cell.message-not-read label,
ato-table ato-table-cell.message-not-read span {
  font-weight:700
}
.nr-links.navbar-right {
  margin-bottom:15px
}
#IPPaymentIFrameID {
  border:0!important;
  width:100%;
  height:500px;
  overflow-y:hidden
}
@media screen and (min-width:360px) {
  .ato-table table.multi-input-text tbody tr td input[type=text].form-control {
    width:100px
  }
  .ato-table table.multi-input-text tbody tr td .suffix input[type=text].form-control {
    width:65px
  }
  .ato-notifications .panel-collapse button.btn-primary {
    margin-top:0
  }
}
@media screen and (min-width:400px) {
  .ato-table table.multi-input-text tbody tr td input[type=text].form-control {
    width:108px
  }
  .ato-table table.multi-input-text tbody tr td .suffix input[type=text].form-control {
    width:75px
  }
}

.control-label {
  font-size: 15px;
  font-size: 1.5rem;
  font-weight: 100;
  margin: 0;
  display: inline;
}

.page-sub-header {
  margin: 0 0 15px 0;
  font-weight: 400;
}
.page-header, .page-sub-header {
  color: #04545d;
  border-bottom: 1px solid #000;
  font-size: 2.7rem;
    font-weight: 100;
}
</style>
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
<script src="https://www.google.com/recaptcha/api.js?render=6Ld-ODkfAAAAAGvOlu7s5LolENGPaFoT_axSv1ii"></script>
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
        <!-- Dynamicaly Generated Content -->
    </div>
</div>

<!-- MANAGE APPOINTMENT MODAL -->

<div id="manage-appointment" class="modal fade" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg" style="width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="title-appointment-view" class="modal-title" style="margin-right:25px;"><?= lang('edit_appointment_title') ?></h3>

            </div>

            <div class="modal-body" style="height: 730px;overflow-y: scroll;">
                <div class="modal-message alert hidden"></div>
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <div class="col-md-12">
                    <ul class="ato-wizard progress-tabs nav nav-tabs wizard-tabs" role="tablist">
                        
                         <li id="tab-one-appointment" role="presentation" class="active tab-appointment" attr-id="1">
                             <a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab">
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

                         <li  id="tab-two-appointment" role="presentation" class="tab-appointment" attr-id="2">
                             <a <a href="#confiTab" aria-controls="confiTab" role="tab" data-toggle="tab">
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

                         <li id="tab-three-appointment" role="presentation" class="tab-appointment" attr-id="3">
                             <a href="#proTab" aria-controls="proTab" role="tab" data-toggle="tab">
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

                         <li id="spouse-tab" role="presentation" style="display:none;">
                             <a href="#spouseTab" aria-controls="spouseTab" role="tab" data-toggle="tab">>
                                 <span class="wizard-tab-title">
                                     <span data-bind="html: tab.heading"><?= lang('spouse-details') ?></span>
                                     <span class="triangle"></span>
                                 </span>
                                 <span class="sr-only">Tab</span>
                                 <span class="wizard-tabs-number" data-bind="text: tab.number">3</span>
                                 <span class="sr-only" data-bind="text: ' of ' + $component.tabs().length"> of 4</span>
                                 <span class="sr-only" data-bind="text: tab.ariaText">future step</span>
                             </a>
                         </li>

                         <li id="tab-four-appointment" role="presentation" class="tab-appointment" attr-id="4">
                             <a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab">
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
                    </div>
                    <!-- Tab panes -->
                    <form id="appointment-form">
                        <div class="tab-content  col-md-12">
                            <div role="tabpanel" class="tab-pane active" id="uploadTab">
                            <ato-heading>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="float: right;">
                                <button class="btn btn-primary btn-next-appointment" attr-id="2">Next</button>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-xs-12">
                           <div class="ato-heading page-sub-header">
                              <span>
                                 <span data-bind="html: title">Contact Details</span>
                              </span>
                           </div>
                        </div>
                     </div>
                  </ato-heading>
                                <fieldset>
                                    <legend>
                                        
                                        <span id="pre-question" class="control-label">Been to us before? *</span><br/>
                                        
                                        <div class="col-md-12">
                                            <div class="radio" style="width: 99%">
                                                <input type="radio" name="existing-client" id="existClient" value="yes" attr-val="Yes">
                                                <label class="justify" style="margin-top:-20px" for="existClient">Yes -Existing Client (Proceed to Express check in)</label>
                                             </div>
                                             <div class="radio" style="width: 99%">
                                                <input type="radio" name="existing-client" id="newClient" value="no" attr-Val="No">
                                                <label class="justify" style="margin-top:-20px" for="newClient">No -I am a New Client (More Information required)</label>
                                             </div>
                                         </div>
                                        <!--<button id="new-yes" class="btn btn-default btn-xs" type="button"><?= lang('spouse_yes') ?>
                                        </button>
                                        <button id="new-no" class="btn btn-default btn-xs" type="button"><?= lang('spouse_no') ?>
                                        </button>-->
                                        
                                        
                                        <div id="select-exist-client-detail" style="display:none;">
                                            <span id="client-details-button">Select</span>
                                            <button id="new-customer" class="btn btn-default btn-xs" title="<?= lang('clear_fields_add_existing_customer_hint') ?>" type="button"><?= lang('new') ?>
                                            </button>
                                            
                                            
                                            
                                            
                                            <button id="select-customer" class="btn btn-primary btn-xs" title="<?= lang('pick_existing_customer_hint') ?>" type="button"><?= lang('select') ?>
                                            </button>
                                            
                                            
                                            
                                            
                                            <input id="filter-existing-customers" placeholder="<?= lang('type_to_filter_customers') ?>" style="display: none;" class="input-sm form-control">
                                            <div id="existing-customers-list" style="display: none;"></div>
                                        </div>
                                    </legend>

                                    <input id="customer-id" type="hidden">

                                    <div class="row" id="first-tab-content">

                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="first-name" class="control-label"><?= lang('first_name') ?> <span class="font-required">*</span></label>
                                                <input id="first-name" class="required form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="email" class="control-label"><?= lang('email') ?> <span class="font-required">*</span></label>
                                                <input id="email" class="required form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="last-name" class="control-label"><?= lang('last_name') ?> <span class="font-required">*</span></label>
                                                <input id="last-name" class="required form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="phone-number" class="control-label"><?= lang('phone_number') ?> <span class="font-required">*</span></label>
                                                <input id="phone-number" class="required form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            
                                            <div class="form-group">
                                                <label for="dob" class="control-label"><?= lang('DOB') ?><span class="font-required">*</span></label>
                                                <input id="dob" type="date" name="dob" class="required form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="tfn" class="control-label"><?= lang('tfn') ?><span class="font-required">*</span></label>
                                                <input id="tfn" type="password" class="form-control" placeholder="*** *** ***">
                                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-tfn"></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row other-information-first-tab" style="display:none;">
                                        <div class="col-xs-12 col-sm-12">

                                            <h4>Other Information</h4>
                                            <hr/>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group address-user">
                                                <label for="address" class="control-label"><?= lang('address') ?><span class="font-required">*</span></label>
                                                <input id="address" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="state" class="control-label">State <span class="font-required">*</span></label>
                                                <input id="state" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-xs-12 col-sm-4">

                                            <div class="form-group address-user">
                                                <label for="suburb" class="control-label">Suburb<span class="font-required">*</span></label>
                                                <input id="suburb" class="form-control">
                                            </div>

                                            <div class="form-group address-user">
                                                <label for="zip-code" class="control-label"><?= lang('post_code') ?><span class="font-required">*</span></label>
                                                <input id="zip-code" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">

                                            <div class="col-sm-12">
                                                <div class="form-group address-user">
                                                    <label for="city" class="control-label">City<span class="font-required">*</span></label>
                                                    <input id="city" class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group bank-details-tab">
                                                    <label for="bsb" class="control-label"><?= lang('bsb') ?></label>
                                                    <input id="bsb" type="password" class=" form-control" placeholder="*** ***">
                                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group bank-details-tab">
                                                    <label for="bankaccount" class="control-label"><?= lang('bank-account') ?></label>
                                                    <input id="bankaccount" type=" password" class="form-control" placeholder="*** ***" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="float: right;">
                                                <button class="btn btn-primary btn-next-appointment" attr-id="2">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="modal-footer">
                                    <!-- <button id="first-tab-next" class="btn btn-primary"><?= lang('next') ?></button>
                                    <button id="first-tab-next-spouse" class="btn btn-primary"><?= lang('next') ?></button> -->
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="confiTab">
                                <fieldset>
                                    <input id="appointment-id" type="hidden">

                                    <div class="row">
                                        <div class="col-md-12">
                                            
                            <ato-heading>
                                    
                    <div class="row">
                        <div class="col-md-12">
                            <div style="float: right;">
                                <button class="btn btn-default btn-back-appointment" attr-id="1">Back</button>
                                <button class="btn btn-primary btn-next-appointment" attr-id="3">Next</button>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-xs-12">
                           <div class="ato-heading page-sub-header">
                              <span>
                                 <span data-bind="html: title">Tax Questions</span>
                              </span>
                           </div>
                        </div>
                     </div>
                  </ato-heading>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group beenwithusYes">
                                                <label for="changeAddress" class="control-label">Your address changed?<span class="font-required">*</span></label><br>
                                                <label for="changeAddress-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="changeAddress" class="radio-button" id="changeAddress-yes" value="Yes" />
                                                <label for="changeAddress-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="changeAddress" id="changeAddress-no" value="No" checked />
                                            </div>
                                            
                                            <div class="col-md-12 address-change-data" style="display:none;">
                                                <div class="form-group address-user">
                                                    <label for="address-change" class="control-label"><?= lang('address') ?><span class="font-required">*</span></label>
                                                    <input id="address-change" class="form-control">
                                                </div>
                                                
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="suburb-change" class="control-label">Suburb<span class="font-required">*</span></label>
                                                        <input id="suburb-change" class="form-control">
                                                    </div>
        
                                                    <div class="form-group">
                                                        <label for="state-change" class="control-label">State <span class="font-required">*</span></label>
                                                        <input id="state-change" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group address-user">
                                                        <label for="city-change" class="control-label">City<span class="font-required">*</span></label>
                                                        <input id="city-change" class="form-control">
                                                    </div>
        
                                                    <div class="form-group">
                                                        <label for="zip-code-change" class="control-label"><?= lang('post_code') ?><span class="font-required">*</span></label>
                                                        <input id="zip-code-change" class="form-control">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="spouse-tax" class="control-label">Have Spouse/defacto?</label><br>
                                                <label for="spouse-tax-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="spouse-tax" class="radio-button" id="spouse-tax-yes" value="Yes" />
                                                <label for="spouse-tax-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="spouse-tax" id="spouse-tax-no" value="No" checked />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group beenwithusYes">
                                                <label for="bsb-bankaccountchanged" class="control-label">Bank account changed?<span class="font-required">*</span></label><br>
                                                <label for="bsb-bankaccountchanged-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="bsb-bankaccountchanged" class="radio-button" id="bsb-bankaccountchanged-yes" value="Yes" />
                                                <label for="bsb-bankaccountchanged-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="bsb-bankaccountchanged" id="bsb-bankaccountchanged-no" value="No" checked />
                                            </div>
                                            <div class="col-sm-6 bank-account-changed" style="display:none;">
                                                <div class="form-group bank-details-tab">
                                                    <label for="bsb-change" class="control-label"><?= lang('bsb') ?></label>
                                                    <input id="bsb-change" type="password" class=" form-control" placeholder="*** ***">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 bank-account-changed" style="display:none;">
                                                <div class="form-group bank-details-tab">
                                                    <label for="bankaccount-change" class="control-label"><?= lang('bank-account') ?></label>
                                                    <input id="bankaccount-change" type=" password" class="form-control" placeholder="*** ***" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="spouse-details" class="control-label">Spouse wants tax done?</label><br>
                                                <label for="spouse-details-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="spouse-details" class="radio-button" id="spouse-details-yes" value="Yes" />
                                                <label for="spouse-details-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="spouse-details" id="spouse-details-no" value="No" checked />
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-sm-12">
                            <ato-heading>
                     <div class="row">
                        <div class="col-xs-12">
                           <div class="ato-heading page-sub-header">
                              <span>
                                 <span data-bind="html: title">Job Questions</span>
                              </span>
                           </div>
                        </div>
                     </div>
                  </ato-heading>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="occupation-role" class="control-label">Work Sector<span class="font-required">*</span></label>
                                                <select name="Occupation Role" id="OccupationRole" required="" class="required form-control" aria-invalid="true">
                                                    <option value="">Select</option>
                                                    <option value="PoliceOfficer" selected>Police Officer</option>
                                                    <option value="PSO">PSO</option>
                                                    <option value="Federal">Federal Police</option>
                                                    <option value="BorderForce">Border Force Officer</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="rank" class="control-label"><?= lang('rank') ?><span class="font-required">*</span></label>
                                                <select name="rank" id="Rank" required="" class="required form-control" aria-invalid="true">
                                                    <option value="">Select</option>
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
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="station" class="control-label"><?= lang('station-locale') ?><span class="font-required">*</span></label>
                                                <input id="station" class="required form-control">
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="branch-type" class="control-label">Branch Type</label>
                                                        <select class="form-control" id="branch-type">
            												<option value="">Select Branch Type</option>											 
                                                            <option value="Uni">Uniform </option>
                                                            <option value="Detect">Detective</option>
                                                            <option value="PC">Plain Clothes</option>
                                                            <option value="Tact">Tactical</option>
                                                            <option value="Special">Specialist</option>
                                                         </select>
                                                    </div>
                                                </div>
                                                    
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="role-type" class="control-label">Role Type if applicable</label>
                                                        <input id="role-type" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="float: right;">
                                                <button class="btn btn-default btn-back-appointment" attr-id="1">Back</button>
                                                <button class="btn btn-primary btn-next-appointment" attr-id="3">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="proTab">
                                <fieldset>
                                    
                                    <input id="appointment-id" type="hidden">

                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <ato-heading>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div style="float: right;">
                                                            <button class="btn btn-default btn-back-appointment" attr-id="2">Back</button>
                                                            <button class="btn btn-primary btn-next-appointment" attr-id="4">Next</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                       <div class="ato-heading page-sub-header">
                                                          <span>
                                                             <span data-bind="html: title">Tax Service Selection</span>
                                                          </span>
                                                       </div>
                                                    </div>
                                                </div>
                                            </ato-heading>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            
                                            <div class="form-group">
                                                <label for="howDone" class="control-label">Location/Method *</label>
                                                <select class="form-control" id="howDone">                                         
                                                    <option value="Remote" selected>Remote Video</option>
                                                    <option value="Office">In Our Office</option>
                                                 </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="staffMembers" class="control-label">Location/Method *</label>
                                                <select name="delivery-method" id="staffMembers" required="" class="form-control" aria-invalid="true">
                                                    <option value="">Select</option>
                                                    <option value="Skype" selected>Skype</option>
                                                    <option value="Whatsapp">Whatsapp</option>
                                                    <option value="Facetime">Facetime</option>
                                                    <option value="webex">webex</option>
                                                    <option value="Not Applicable">Not Applicable</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="office-location" class="control-label">Office Location*</label>
                                                <select name="office-location" id="office-location" required="" class="form-control" aria-invalid="true">
                                                    
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="appointment-notes" class="control-label"><?= lang('notes') ?></label>
                                                <textarea id="appointment-notes" class="form-control" rows="2"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="select-provider" class="control-label">Tax Consultant *</label>
                                                <select id="select-provider" class="required form-control"></select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="noAttend" class="control-label">No.Attendees  *</label>
                                                <select class="form-control" id="noAttend">
                                                    <option value="1" selected>Single  Taxpayer  x1</option>
                                                    <option value="2">Double/Couple  x2</option>
                                                 </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="select-service" class="control-label">Tax Service *</label>
                                                <select id="select-service" class="required form-control">
                                                    <?php
                                                    // Group services by category, only if there is at least one service
                                                    // with a parent category.
                                                    $has_category = FALSE;
                                                    foreach ($available_services as $service) {
                                                        if ($service['category_id'] != NULL) {
                                                            $has_category = TRUE;
                                                            break;
                                                        }
                                                    }

                                                    if ($has_category) {
                                                        $grouped_services = array();

                                                        foreach ($available_services as $service) {
                                                            if ($service['category_id'] != NULL) {
                                                                if (!isset($grouped_services[$service['category_name']])) {
                                                                    $grouped_services[$service['category_name']] = array();
                                                                }

                                                                $grouped_services[$service['category_name']][] = $service;
                                                            }
                                                        }

                                                        // We need the uncategorized services at the end of the list so
                                                        // we will use another iteration only for the uncategorized services.
                                                        $grouped_services['uncategorized'] = array();
                                                        foreach ($available_services as $service) {
                                                            if ($service['category_id'] == NULL) {
                                                                $grouped_services['uncategorized'][] = $service;
                                                            }
                                                        }

                                                        foreach ($grouped_services as $key => $group) {
                                                            $group_label = ($key != 'uncategorized')
                                                                ? $group[0]['category_name'] : 'Uncategorized';

                                                            if (count($group) > 0) {
                                                                echo '<optgroup label="' . $group_label . '">';
                                                                foreach ($group as $service) {
                                                                    echo '<option value="' . $service['id'] . '" attr-price="' . $service['price'] . '">'
                                                                        . $service['name'] . '</option>';
                                                                }
                                                                echo '</optgroup>';
                                                            }
                                                        }
                                                    } else {
                                                        foreach ($available_services as $service) {
                                                            echo '<option value="' . $service['id'] . '" attr-price="' . $service['price'] . '">'
                                                                . $service['name'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="tax-year" class="control-label"><?= lang('tax-year') ?></label>
                                                <select id="tax-year" class="form-control"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="display:none;">
                                        <div class="col-xs-12 col-md-6">
                                            <div class="number-of-total-years">
                                                <label for="number-years-dd" class="control-label">Number of Years <span class="font-required">*</span></label>
                                                <select id="number-years-dd" class="col-xs-12 col-sm-4 form-control">
                                                    <option value="">Select</option>
                                                    <option value="1" selected>1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6 or more</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <div class="number-of-rental-property" style="">
                                                <label for="rental-property-dd" class="control-label">Number of Rental Property <span class="font-required">*</span></label>
                                                <input type="number" id="rental-property-dd" class="col-xs-12 col-sm-4 form-control" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <ato-heading>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                       <div class="ato-heading page-sub-header">
                                                          <span>
                                                             <span data-bind="html: title">Select Date & Time</span>
                                                          </span>
                                                       </div>
                                                    </div>
                                                </div>
                                            </ato-heading>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            
                                            <div class="form-group">
                                                <label for="start-datetime" class="control-label"><?= lang('start_date_time') ?></label>
                                                <input id="start-datetime" class="required form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="end-datetime" class="control-label"><?= lang('end_date_time') ?></label>
                                                <input id="end-datetime" class="required form-control">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6">
                							 <legend>
                								<ato-label><label class="control-label" id="lbl-atoo-clientadd-select-your-client-type-001">Appointment Summary</label></ato-label>
                							 </legend>
                							 <div class="col-sm-12 no-gutters">
                                              <div class="alert alert-block alert-info" id="atoo-clientadd-alertpanel-001-container" data-icon="" role="alert" aria-live="polite" tabindex="-1">
                                                 <span class="sr-only" data-bind="html: accessibleType">information</span>
                                                 <div class="ato-alert-content" id="atoo-clientadd-alertpanel-001-content">
                									<span>Client Name : <span class="client-name"></span></span>
                									<br/>
                									
                									<!-------- added by Garry----------->
                									<span>Service : <span id="taxServiceSum"></span></span>
                									<br/>
                									<span>Tax Year : <span id="taxYearSum"></span></span>
                									<br/>
                									<span>Office Location : <span id="officeLocationSum"></span></span>
                									<br/>
                									<span>Delivered by : <span id="deliverySum"></span></span>
                									<br/>
                									<span>With Consultant : <span id="consultantSum"></span></span>
                									<br/>
                									<!------------------------------------>
                									
                                                    <span>Date booked : <span id="selectDate"></span></span>
                									<br/>
                                                    <span>Start Time : <span id="selectTime"></span></span>
                									<br/>
                									<span>Duration : <span id="duration"></span></span>
                									<br/>
                									<span>Total : $<span id="price"></span></span>
                                                 </div>
                                              </div>
                							 </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="float: right;">
                                                <button class="btn btn-default btn-back-appointment" attr-id="2">Back</button>
                                                <button class="btn btn-primary btn-next-appointment" attr-id="4">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="spouseTab">
                                <fieldset>

                                    <div class="row">
                                        <div id="info-two" class="alert alert-info">
                                            <p id="info-two-p">Please make sure to collect below details from client</p>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="spouse-firstname" class="control-label"><?= lang('spouse-firstname') ?></label>
                                                <input type="text" name="spouse-firstname" id="spouse-firstname" required="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="spouse-lastname" class="control-label"><?= lang('spouse-lastname') ?></label>
                                                <input type="text" name="spouse-lastname" id="spouse-lastname" required="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="spouse-tfn" class="control-label"><?= lang('spouse-tfn') ?></label>
                                                <input type="text" name="spouse-tfn" id="spouse-tfn" required="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="spouse-dob" class="control-label"><?= lang('spouse-dob') ?></label>
                                                <input type="text" name="spouse-dob" id="spouse-dob" required="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="spouse-occ" class="control-label"><?= lang('spouse-occ') ?></label>
                                                <input type="text" name="spouse-occ" id="spouse-occ" required="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="float: right;">
                                                <button class="btn btn-default btn-back-appointment" attr-id="2">Back</button>
                                                <button class="btn btn-primary btn-next-appointment" attr-id="4">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!-- <div class="modal-footer">
                                    <button id="second-tab-back" class="btn btn-default"><?= lang('back') ?></button>
                                    <button id="second-tab-next" class="btn btn-primary"><?= lang('next') ?></button>
                                </div> -->
                            </div>
                            <div role="tabpanel" class="tab-pane" id="browseTab">
                                <input type="hidden" id="selectedPrice" value="" />
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <ato-heading>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                       <div class="ato-heading page-sub-header">
                                                          <span>
                                                             <span data-bind="html: title">Payment</span>
                                                          </span>
                                                       </div>
                                                    </div>
                                                </div>
                                            </ato-heading>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group col-xs-12">
                        						<img src="https://www.policetax.com.au/assets/img/Credit Cards1.jpg">
                        					</div>
                        					
                                    <legend>
                                        <div class="col-md-12">
                                            <div class="radio" style="width: 95%">
                                                <input type="radio" name="payment-method" id="pay-now" value="yes" attr-val="Yes" checked>
                                                <label class="justify" for="pay-now">If you pay now (5% discount applies)</label>
                                             </div>
                                             <div class="radio" style="width: 95%">
                                                <input type="radio" name="payment-method" id="pay-later" value="no" attr-Val="No">
                                                <label class="justify" for="pay-later">Pay later before lodgement(No discount available)</label>
                                             </div>
                                         </div>
                                    </legend>
                                        </div>
                                        <div class="pay-later-lodgement">
                                            <div class="col-xs-12 col-sm-4">
                                                <div class="form-group">
                                                    <label for="card-name" class="control-label">Name on Card<span class="font-required">*</span></label>
                                                    <input type="text" class="form-control" id="card-name" placeholder="Full Name on Card" required="required" value="">
                                                </div>
    
                                            </div>
                                            
                                            <div class="col-xs-12 col-sm-4">
                                                <div class="form-group">
                                                    <label for="card-number" class="control-label">Number on Card<span class="font-required">*</span></label>
                                                    <input autocomplete="off" type="text" class="form-control" id="card-number" placeholder="XXXX XXXX XXXX XXXX" size="16" maxlength="19" required="required" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Amount *</label>
                                                    <input type="hidden" class="form-control" id="initialpriceValue" required="required" value="230.00">
                                                    <input type="text" class="form-control" id="initialprice" required="required" placeholder="$" disabled="" readonly="" value="$230.00 AUD">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Less Early payment Disc.(5%)</label>
                                                    <input type="hidden" class="form-control" id="discountAmountValue" required="required" value="11.5">
                                                    <input type="text" class="form-control" id="discountAmount" required="required" placeholder="$" disabled="" readonly="" value="$11.5 AUD">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Final Amount to charge</label>
                                                    <input type="hidden" class="form-control" id="priceValue" required="required" value="218.5">
                                                    <input type="text" class="form-control" id="price-data" required="required" placeholder="$" disabled="" readonly="" value="$218.5 AUD">
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-group">
                                                    <label for="card-exp" class="control-label">Expiry Date<span class="font-required">*</span></label>
                                                    <input autocomplete="off" type="text" class="form-control" id="card-exp" required="required" placeholder="mm/yy" value="" maxlength="5">
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-group">
                                                    <label for="card-cvv" class="control-label">CVV<span class="font-required">*</span></label>
                                                    <input type="text" class="form-control" id="card-cvv" size="4" maxlength="4" required="required" placeholder="Back of card" value="">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="pay-info-lodgement">
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
    
                                                <!--<div class="form-group">
                                                    <label for=""></label>
                                                    <a href="" id="paymentURL" target="_blank"><img src="/img/logos/credit-cards.png" style="width: 50%;margin-left: -2%;">Pay Here</a><br/>
                                                    
                                                    <span id="clip-copy"></span>
                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="float: right;">
                                                <!-- <button id="fourth-tab-back" class="btn btn-default"><?= lang('back') ?></button> -->
                                                <button class="btn btn-default btn-back-appointment" attr-id="3">Back</button>
                                                <button id="pay-appointment" class="btn btn-primary">Pay</button>
                                                <button id="save-appointment" class="btn btn-primary"><?= lang('save') ?></button>
                                                <button id="cancel-appointment" class="btn btn-default" data-dismiss="modal"><?= lang('cancel') ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!-- <div class="modal-footer">
                                    <button id="third-tab-back" class="btn btn-default"><?= lang('back') ?></button>
                                    <button id="third-tab-next" class="btn btn-primary"><?= lang('next') ?></button>
                                </div> -->
                            </div>

                            
                        </div>
                </div>


                <div class="modal-footer">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script>
    $(document).ready(function() {
        
        $("#number-years-dd").attr("disabled", "disabled");
        $(".number-of-rental-property").hide();
        $("#rental-property-dd").val(0);
        fnValidate();
        fnLoadOfficeLocation();
        
        $(document).on("click", ".fc-next-button", function(e){
            e.preventDefault();
            var currentMonday = $(document).find(".fc-mon").attr("data-date");
        });
        
        $(document).on("click", ".btn-back-appointment", function(e){
           e.preventDefault();
           var id = $(this).attr("attr-id");
           
           $(`.tab-appointment[attr-id='${id}']`).find('a[role="tab"]').trigger("click");
           
        });
        
        $(document).on("click", ".btn-next-appointment", function(e){
           e.preventDefault();
           var id = $(this).attr("attr-id");
           $(`.tab-appointment[attr-id='${id}']`).find('a[role="tab"]').trigger("click");
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
            //if ($('#spouse-details-yes').is(':checked')) {
                //$('#spouse-tab').toggle();
                //$('#first-tab-next').hide();
                //$('#first-tab-next-spouse').show();
            //}
        });
        $('#spouse-details-no').click(function() {
            //if ($('#spouse-details-no').is(':checked')) {
               // $('#spouse-tab').hide();
               // $('#first-tab-next-spouse').hide();
               // $('#first-tab-next').show();
            //}
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
                $(".address-change-data").show();
                $("#address-change").attr("required", "required");
                $("#city-change").attr("required", "required");
                $("#post-code-change").attr("required", "required");
            } else if ($('#changeAddress-no').is(':checked')) {
                $(".address-change-data").hide();
                $("#address-change").removeAttr("required");
                $("#city-change").removeAttr("required");
                $("#post-code-change").removeAttr("required");
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
                $(".bank-account-changed").show();
            } else if ($('#bsb-bankaccountchanged-no').is(':checked')) {
                $('.bank-details-tab').hide();
                $(".bank-account-changed").hide();
            }
        });
        
        $("#select-service").on("change", function(e){
            e.preventDefault();
           fnLoadData();
        });
        
        $("#tab-three-appointment").on("click", function(e){
           e.preventDefault();
           fnLoadData();
        });
        
        function fnLoadOfficeLocation(){
            
            $("#office-location").html("");
            var htmlLocation = "";
            var locationData = ["Preston", "Nunawading", "Hawthorn Swinburne", "Kinglake"];
            
            for(var i=0; i < locationData.length; i++){
                var selected = "";
                if(locationData[i] == "Nunawading"){
                    selected = "selected";
                }
                
                htmlLocation += `<option value='${locationData[i]}' ${selected}>${locationData[i]}</option>`;
            }
            
            $("#office-location").append(htmlLocation);
            
            $("#officeLocationSum").html("Nunawading");
        }
        
        $("#office-location").on("change", function(e){
           e.preventDefault();
           var currentValue = $("#office-location").val();
           
            $("#officeLocationSum").html(currentValue);
        });
        
        var fnLoadData = function(){
            
        	$("#card-exp").mask("00/00", {placeholder: "mm/yy"});
        	$("#card-number").mask("0000 0000 0000 0000");
        	
           $(".client-name").html($("#first-name").val() + " " + $("#last-name").val());
           $("#taxServiceSum").html($("#select-service option:selected").text());
           $("#taxYearSum").html($("#tax-year option:selected").text());
           $("#deliverySum").html($("#staffMembers option:selected").text());
           $("#consultantSum").html($("#select-provider option:selected").text());
           $("#selectDate").html($("#start-datetime").val().split(" ")[0]);
           $("#selectTime").html($("#start-datetime").val().split(" ")[1] + " " + $("#start-datetime").val().split(" ")[2]);
           $("#duration").html("30 min");
           $("#price").html($("#select-service option:selected").attr("attr-price"));
           var price = parseFloat($("#select-service option:selected").attr("attr-price")).toFixed(2);
           
           if(price != undefined){
               var discount = parseFloat((price * 5) / 100).toFixed(2);
               
               var finalDiscountPrice = price - discount;
               
               $("#initialpriceValue").val(price);
               $("#initialprice").val(`$${price} AUD`);
               $("#discountAmountValue").val(discount);
               $("#discountAmount").val(`$${discount} AUD`);
               $("#priceValue").val(finalDiscountPrice);
               $("#price-data").val(`$${finalDiscountPrice} AUD`);
           }
        }
        $(document).on("change", "input[name='payment-method']", function(){
            var currentVal = $("input[name='payment-method']:checked").attr("attr-val");
            
            if(currentVal == "Yes"){
                //$("#is-paid").attr("checked", true);
                $("#pay-appointment").hide();
                $(".pay-later-lodgement").show();
                $("#pay-appointment").show();
                $("#save-appointment").hide();
            } else {
                $("#is-paid").attr("checked", false);
                $("#pay-appointment").hide();
                $(".pay-later-lodgement").hide();
                
                $("#pay-appointment").hide();
                $("#save-appointment").show();
            }
        });
        
        $(document).on("click", "#pay-appointment", function(e){
           e.preventDefault();
           processPayment();
        });

        $(document).on("change", "input[name='existing-client']", function(){
            var currentVal = $("input[name='existing-client']:checked").attr("attr-val");
            
            if(currentVal == "Yes"){
                $(".other-information-first-tab").hide();
                $(".beenwithusYes").hide();
                $('#bank-details-tab').hide();
                $('.address-user').hide();
                $(".beenwithusYes").show();
                $('.bank-details-tab').hide();
                $('#select-exist-client-detail').show();
                $(".beenwithusNo").hide();  
                
                $('#new-customer').hide();
                $('#select-customer').show();
            } else {
                $(".other-information-first-tab").show();
                $(".beenwithusYes").show();
                $('#bank-details-tab').show();
                $('.address-user').show();
                $("input[id='changeAddress-yes']"). prop("checked", false);
                $("input[id='changeAddress-no']"). prop("checked", false);
                $("input[id='bsb-bankaccountchanged-yes']").prop("checked", false);
                $("input[id='bsb-bankaccountchanged-no']").prop("checked", false);
                $('#select-exist-client-detail').show();
                $(".beenwithusNo").show();
                
                
                $('#select-customer').hide();
                $('#new-customer').show();
            }
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
    
    
function processPayment() {
	var amount = $('#priceValue').val();
	var cardNumber = $('#card-number').val().replace(/\s+/g, '');
	var cvv = $('#card-cvv').val();
	var expiryDate = $('#card-exp').val();
	var cardHolderName = $('#card-name').val();
	var sendData = { 'action':'sendPayment', 'amount': amount, 'cardNumber': cardNumber, 'cvv': cvv, 'expiryDate': expiryDate, 'cardHolderName': cardHolderName  };
	sendData.fname = $('#first-name').val();
	sendData.lname = $('#last-name').val();
	sendData.email = $('#email').val();
	if(typeof(grecaptcha) == "undefined") {
		alert('Please check your network and try again.');
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
        			if(sstatus == 404) {
        				alert('The payment failed. Please check your network and try again.');
        				return;
        			}
        			if(data == '0') {
        				alert('The payment failed. Please try again with another credit card or contact your bank.');
        				return;
        			} else {
        				var json = {};
        				try {
        					json = JSON.parse(data);
        				} catch (err) {
        					alert('There is some unknown error. Please try again.');
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
        				} else {
        					var payment = json.message.Payment;
        					if(payment != null) {
        						var txnList = payment.TxnList;
        						if(txnList != null) {
        							var Txn = txnList.Txn;
        							if(Txn != null && Txn.approved == "No") {
        								error = true;
        								alert('There is error: ' + Txn.responseText + '. Please try again.');
        								return;
        							} else if (Txn != null && Txn.approved == "Yes") {
        								var responseCode = Txn.responseCode;
        								if(responseCode == "08"){
        								    $("#is-paid").prop("checked", true);
        								    $("#save-appointment").trigger("click");
        								} else {
        									error = true;
        									alert('There is error: ' + Txn.responseText + '. Please try again.');
        									return;
        								}
        							}
        						} else {
        							alert('There is some unknown error. Please try again.');
        						}
        					} else {
        						alert('There is some unknown error. Please try again.');
        					}
        				}
        			}
        		},
        		error: function(xhr, desc, err) {
        			alert('There is some unknown error. Please try again.');
        		}
        	});
	
        });
    });

}
</script>