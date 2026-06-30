<link rel="stylesheet" type="text/css" href="<?= asset_url('/assets/ext/jquery-fullcalendar/fullcalendar.css') ?>">
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
            <p style="color:white;">Total appointments this week: <span class="currentWeek"><?= $appointment_Total_ThisWeek_count ?></span></p>
            
 
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
                            Tax Questions</a>
                        </li>
                        <li id="tab-three-appointment" role="presentation"><a href="#proTab" aria-controls="proTab" role="tab" data-toggle="tab"><i id="step-3-checked" class="fa fa-check custom-color-done" aria-hidden="true"></i><i id="step-3-warning" class="fa fa-times custom-color-warning" aria-hidden="true"></i>
                            Job Details</a>
                        </li>
                        <li id="tab-two-appointment" role="presentation"><a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab"><i id="step-2-checked" class="fa fa-check custom-color-done" aria-hidden="true"></i><i id="step-2-warning" class="fa fa-times custom-color-warning" aria-hidden="true"></i> Service Request</a>

                        </li>
                        <li id="spouse-tab" role="presentation" style="display:none;"><a href="#spouseTab" aria-controls="spouseTab" role="tab" data-toggle="tab"><i id="step-spouse-warning" class="fa fa-times custom-color-warning" aria-hidden="true"></i> <?= lang('spouse-details') ?></a>

                        </li>
                        <li id="tab-five-appointment" role="presentation"><a href="#finaliseTab" aria-controls="finaliseTab" role="tab" data-toggle="tab"><i id="step-5-checked" class="fa fa-check custom-color-done" aria-hidden="true"></i><i id="step-5-warning" class="fa fa-times custom-color-warning" aria-hidden="true"></i> <?= lang('finalise_details_title') ?></a>

                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <form id="appointment-form">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="uploadTab">
                                <fieldset>
                                    <legend>
                                        
                                        <span id="pre-question">Existing Client?</span>
                                        <button id="new-yes" class="btn btn-default btn-xs" type="button"><?= lang('spouse_yes') ?>
                                        </button>
                                        <button id="new-no" class="btn btn-default btn-xs" type="button"><?= lang('spouse_no') ?>
                                        </button>
                                        
                                        
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

                                        <div id="info-one" class="alert alert-info">
                                            <p id="info-one-p">Please make sure to collect below details from client</p>
                                        </div>

                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="first-name" class="control-label"><?= lang('first_name') ?> <span class="font-required">*</span></label>
                                                <input id="first-name" class="required form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="last-name" class="control-label"><?= lang('last_name') ?> <span class="font-required">*</span></label>
                                                <input id="last-name" class="required form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="email" class="control-label"><?= lang('email') ?> <span class="font-required">*</span></label>
                                                <input id="email" class="required form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="phone-number" class="control-label"><?= lang('phone_number') ?> <span class="font-required">*</span></label>
                                                <input id="phone-number" class="required form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="dob" class="control-label"><?= lang('DOB') ?><span class="font-required">*</span></label>
                                                <input id="dob" type="date" name="dob" class="required form-control">
                                            </div>
                                            

                                            <div class="form-group">
                                                <label for="spouse-details" class="control-label"><?= lang('tax_for_spouse') ?></label><br>
                                                <label for="spouse-details-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="spouse-details" class="radio-button" id="spouse-details-yes" value="Yes" />
                                                <label for="spouse-details-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="spouse-details" id="spouse-details-no" value="No" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="tfn" class="control-label"><?= lang('tfn') ?><span class="font-required">*</span></label>
                                                <input id="tfn" type="password" class="form-control" placeholder="*** *** ***">
                                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-tfn"></span>
                                            </div>
                                            <div class="form-group beenwithusYes" style="display:none;">
                                                <label for="changeAddress" class="control-label">Have you change address?<span class="font-required">*</span></label><br>
                                                <label for="changeAddress-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="changeAddress" class="radio-button" id="changeAddress-yes" value="Yes" />
                                                <label for="changeAddress-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="changeAddress" id="changeAddress-no" value="No" />
                                            </div>

                                            <div class="form-group address-user">
                                                <label for="address" class="control-label"><?= lang('address') ?><span class="font-required">*</span></label>
                                                <input id="address" class="form-control">
                                            </div>

                                            <div class="form-group address-user">
                                                <label for="city" class="control-label"><?= lang('city') ?><span class="font-required">*</span></label>
                                                <input id="city" class="form-control">
                                            </div>

                                            <div class="form-group address-user">
                                                <label for="zip-code" class="control-label"><?= lang('post_code') ?><span class="font-required">*</span></label>
                                                <input id="zip-code" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="customer-notes" class="control-label"><?= lang('notes') ?></label>
                                                <textarea id="customer-notes" rows="2" class="form-control"></textarea>
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
                                        <div id="info-three" class="alert alert-info">
                                            <p id="info-three-p">Below fields are not mandatory. But, Please ask them if they have these info handy.</p>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">

                                            <div class="form-group bank-details-tab">
                                                <label for="bsb" class="control-label"><?= lang('bsb') ?></label>
                                                <input id="bsb" type="password" class=" form-control" placeholder="*** ***">
                                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="rental-property" class="control-label"><?= lang('rental_property') ?></label><br>
                                                <label for="rental-property-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="rental-property" class="radio-button" id="rental-property-yes" value="Yes" />
                                                <label for="rental-property-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="rental-property" id="rental-property-no" value="No" checked />
                                            </div>
                                            <div class="form-group">
                                                <label for="captial-gains" class="control-label"><?= lang('capital_gains') ?></label><br>
                                                <label for="captial-gains-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="captial-gains" class="radio-button" id="captial-gains-yes" value="Yes" />
                                                <label for="captial-gains-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="captial-gains" id="captial-gains-no" value="No" checked />
                                            </div>
                                            <div class="form-group">
                                                <label for="overdue-Tax" class="control-label">Do you have any overdue tax return?*</label><br>
                                                <label for="overdue-Tax-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="overdue-Tax" class="radio-button" id="overdue-Tax-yes" value="Yes" />
                                                <label for="overdue-Tax-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="overdue-Tax" id="overdue-Tax-no" value="No" checked />
                                            </div>
                                            <div class="form-group beenwithusNo" style="display:none;">
                                                <label for="healthInsurance" class="control-label">Do you have Private Health Insurance?<span class="font-required">*</span></label><br>
                                                <label for="healthInsurance-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="healthInsurance" class="radio-button" id="healthInsurance-yes" value="Yes" />
                                                <label for="healthInsurance-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="healthInsurance" id="healthInsurance-no" value="No" />
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group bank-details-tab">
                                                <label for="bankaccount" class="control-label"><?= lang('bank-account') ?></label>
                                                <input id="bankaccount" type=" password" class="form-control" placeholder="*** ***" />
                                            </div>
                                            <div class="form-group beenwithusYes" style="display:none;">
                                                <label for="bsb-bankaccountchanged" class="control-label">Have you changed BSB and Bank account for your refund?<span class="font-required">*</span></label><br>
                                                <label for="bsb-bankaccountchanged-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="bsb-bankaccountchanged" class="radio-button" id="bsb-bankaccountchanged-yes" value="Yes" />
                                                <label for="bsb-bankaccountchanged-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="bsb-bankaccountchanged" id="bsb-bankaccountchanged-no" value="No" />
                                            </div>
                                            <div class="form-group beenwithusNo" style="display:none;">
                                                <label for="hecsDebt" class="control-label">Do you have Hecs Debt?<span class="font-required">*</span></label><br>
                                                <label for="hecsDebt-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="hecsDebt" class="radio-button" id="hecsDebt-yes" value="Yes" />
                                                <label for="hecsDebt-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="hecsDebt" id="hecsDebt-no" value="No" />
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="proTab">
                                <fieldset>

                                    <div class="row">
                                        <div id="info-four" class="alert alert-info">
                                            <p id="info-four-p">Please make sure to collect below details from the client</p>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="occupation-role" class="control-label"><?= lang('occupation-role') ?><span class="font-required">*</span></label>
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
                                            <div class="form-group hidden">
                                                <label for="years-in-job" class="control-label"><?= lang('years-in-job') ?></label>
                                                <input id="years-in-job" class="form-control">
                                            </div>
                                        </div>
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
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="select-service" class="control-label"><?= lang('service') ?> *</label>
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
                                                                    echo '<option value="' . $service['id'] . '">'
                                                                        . $service['name'] . '</option>';
                                                                }
                                                                echo '</optgroup>';
                                                            }
                                                        }
                                                    } else {
                                                        foreach ($available_services as $service) {
                                                            echo '<option value="' . $service['id'] . '">'
                                                                . $service['name'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="select-provider" class="control-label"><?= lang('provider') ?> *</label>
                                                <select id="select-provider" class="required form-control"></select>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="start-datetime" class="control-label"><?= lang('start_date_time') ?></label>
                                                <input id="start-datetime" class="required form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="end-datetime" class="control-label"><?= lang('end_date_time') ?></label>
                                                <input id="end-datetime" class="required form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
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
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="appointment-notes" class="control-label"><?= lang('notes') ?></label>
                                                <textarea id="appointment-notes" class="form-control" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!-- <div class="modal-footer">
                                    <button id="third-tab-back" class="btn btn-default"><?= lang('back') ?></button>
                                    <button id="third-tab-next" class="btn btn-primary"><?= lang('next') ?></button>
                                </div> -->
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
                                </fieldset>
                                <!-- <div class="modal-footer">
                                    <button id="second-tab-back" class="btn btn-default"><?= lang('back') ?></button>
                                    <button id="second-tab-next" class="btn btn-primary"><?= lang('next') ?></button>
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
                                                <label for="tax-year" class="control-label"><?= lang('tax-year') ?></label>
                                                <select id="tax-year" class="form-control"></select>
                                            </div>

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
                                            <div class="form-group">
                                                <label for="staffMembers" class="control-label">Video conference method</label>
                                                <select name="staffMembers" id="staffMembers" required="" class="form-control" aria-invalid="true">
                                                    <option value="">Select</option>
                                                    <option value="Anne" selected>Skype</option>
                                                    <option value="Soniya">Zoom</option>
                                                    <option value="Garry">Facetimex</option>
                                                    <option value="Reception 1">webex</option>
                                                    <option value="Reception 2">Not Applicable</option>
                                                </select>
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

                                            <div class="form-group">
                                                <label for=""></label>
                                                <a href="" id="paymentURL" target="_blank"><img src="/img/logos/credit-cards.png" style="width: 50%;margin-left: -2%;">Pay Here</a><br/>
                                                
                                                <span id="clip-copy"></span>
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