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

    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/ext/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/ext/jquery-ui/jquery-ui.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/ext/jquery-qtip/jquery.qtip.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/ext/cookieconsent/cookieconsent.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/css/frontend.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/css/general.css') ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="icon" type="image/x-icon" href="<?= asset_url('assets/img/favicon.ico') ?>">
    <link rel="icon" sizes="192x192" href="<?= asset_url('assets/img/logo.png') ?>">
    <style>
        .ad-image{
            margin-left:-100px;
        }
        @media only screen and (max-width: 1024px) and (min-width: 767px) {
            .ad-image{
                width: 249px;
                margin-left: -46px;
                margin-top: 103px;
            }
        }
        @media only screen and (max-width: 768px) {
            .ad-image{
                display: none;
            }
        }
        
        .tawkchat-minified-box {
            margin-top: -42px;
        }
        
        .text-input{
            margin-left: -62px;
            margin-top: 26px;
            position: absolute;
            font-size: 10px;
        }
        #loading {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: fixed;
            display: block;
            opacity: 0.8;
            background-color: #fff;
            z-index: 99;
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="loading" style="display:none;">
     <img id="loader-img" src="https://static.wixstatic.com/media/d27180_8ba5d7d0d8ce459aa955f57c6ff5782b~mv2.gif" style="margin-top: 13%;">
    </div>
    <nav class="navbar navbar-default nav-height">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <img alt="Brand" src="assets/img/logo.png" class="custom-img">
                </a>
            </div>
            <!-- <center>
                <h4 style="color: #002080">Welcome To Our Friendly Appointment Scheduling System</h4>
            </center>
            <center>
                <h6 style="color: #002080">Australias' No. 1 &amp; Most Desired Police Tax Services.</h6>
            </center> -->
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="https://policetax.com.au"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-play-circle"></span> Services</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-star-empty"></span> Testimonials</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-list"></span> FAQs</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-phone-alt"></span> Contact Us</a></li>
                    <?php if ($email) { ?><li><a id="logout" href="<?= site_url('user/logout') ?>"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li> <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar nav-custom sticky-top">
        <div class="container-fluid">
            <div class="navbar-header" style=" margin-top: 5px !important;">
                <a class="nav-link" href="tel:1800 819 692" style="color: white !important; font-size: 1.5rem;"><i class="fa fa-phone fa-rotate-90"></i> Call us now :1800 819 692</a>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="">
                <ul class="navbar-nav custom-nav navbar-right" style="list-style-type: none !important; margin-right:30px; margin-top: 5px; ">
                    <?php if ($email) { ?><li style="margin-right: 15px;"><?php echo "Welcome back " . $firstname; ?></li><?php } ?>
                    <li><span> <?php echo date('D d M Y'); ?></span></li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="main" class="container">
        <div class="wrapper row">
            <!----------------banner image ----------------------->
            <div class="col-md-3 col-lg-3">
                <div style="margin-top: 75px !important;">
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <script>
function preLoad() {
  a1 = new Image; a1.src = 'assets/img/Office Mitcham.jpg';  
  a2 = new Image; a2.src = 'assets/img/Receptionist22.jpg                          ';

}
function im(image) {
  document.getElementById(image[0]).src = eval(image + ".src")
}



</script>
   

<body onLoad="preLoad()">
    <input type="hidden" id="selectedTime" value="" />
<form autocomplete="off"><h3>Appointment type required:</h3><br><br>
 <input type="radio" name="1"  onClick="im('a1');" checked > In Office
<input type="radio" name="1"  onClick="im('a2');">   Skype/Zoom

</form>
<img id="a" src="assets/img/Office Mitcham.jpg" width="300" height="300" alt="">


                    
          <!------------          <img src="assets/img/skypey1.jpg" class="ad-image" alt="" style="width: 131px;margin-top: 107px;z-index: 0;">    --->
                
                
                
                
                
                
                
                
                
                </div>
                <div class="suspendedCovid" style="display:none;position: absolute;top: 190px;margin-left: 210px;">
                    <img src="assets/img/OurOffice.jpg" class="ad-image" alt="" style="width: 200px;margin-top: 107px;z-index: 0;">
                </div>
                
            </div>
            <div class="col-md-1 col-lg-1" style=""></div>
            <div id="book-appointment-wizard" class="col-xs-12 col-md-8 col-lg-8">

                <!-- FRAME TOP BAR -->

                <div id="header">
                    <center>
                        <div id="steps">
                            <div id="step-1" class="book-step active-step" title="<?= lang('step_three_title') ?>">
                                <strong>1</strong>
                            </div>
                            <div id="step-2" class="book-step" title="<?= lang('step_one_title') ?>">
                                <strong>2</strong>
                            </div>

                            <div id="step-3" class="book-step" title="<?= lang('step_two_title') ?>">
                                <strong>3</strong>
                            </div>
                            <div id="step-4" class="book-step" title="<?= lang('step_four_title') ?>">
                                <strong>4</strong>
                            </div>
                        </div>
                    </center>
                </div>

                <?php if ($manage_mode) : ?>
                    <div id="cancel-appointment-frame" class="booking-header-bar row">
                        <div class="col-xs-12 col-sm-10">
                            <p><?= lang('cancel_appointment_hint') ?></p>
                        </div>
                        <div class="col-xs-12 col-sm-2">
                            <form id="cancel-appointment-form" method="post" action="<?= site_url('appointments/cancel/' . $appointment_data['hash']) ?>">
                                <input type="hidden" name="csrfToken" value="<?= $this->security->get_csrf_hash() ?>" />
                                <textarea name="cancel_reason" style="display:none"></textarea>
                                <button id="cancel-appointment" class="btn btn-default btn-sm"><?= lang('cancel') ?></button>
                            </form>
                        </div>
                    </div>
                    <div class="booking-header-bar row">
                        <div class="col-xs-12 col-sm-10">
                            <p><?= lang('delete_personal_information_hint') ?></p>
                        </div>
                        <div class="col-xs-12 col-sm-2">
                            <button id="delete-personal-information" class="btn btn-danger btn-sm"><?= lang('delete') ?></button>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                if (isset($exceptions)) {
                    echo '<div style="margin: 10px">';
                    echo '<h4>' . lang('unexpected_issues') . '</h4>';
                    foreach ($exceptions as $exception) {
                        echo exceptionToHtml($exception);
                    }
                    echo '</div>';
                }
                ?>

                <!-- SELECT SERVICE AND PROVIDER -->

                <div id="wizard-frame-2" class="wizard-frame" style="display:none;">
                    <div class="frame-container">
                        <h3 class="frame-title"><?= lang('step_one_title') ?> <span data-toggle="tooltip" data-placement="bottom" title="Please select appropriate service &amp; accountant">
                                <i class="fa fa-info-circle" style="color: orange; font-size: 3rem; margin-top:10px;"></i>
                            </span></h3>

                        <div class="frame-content">
                            <div class="form-group" style="height: 80px;">
                                <label for="select-service">
                                    <strong>Select A Specialist</strong>
                                </label>

                                <select id="select-service" class="col-xs-12 col-sm-4 form-control">
                                    <option value="" selected>Please choose a service</option>
                                    <?php
                                    // Group services by category, only if there is at least one service with a parent category.
                                    $has_category = false;
                                    foreach ($available_services as $service) {
                                        if ($service['category_id'] != null) {
                                            $has_category = true;
                                            break;
                                        }
                                    }

                                    if ($has_category) {
                                        $grouped_services = array();

                                        foreach ($available_services as $service) {
                                            if ($service['category_id'] != null) {
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
                                            if ($service['category_id'] == null) {
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
                                            echo '<option value="' . $service['id'] . '">' . $service['name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="select-provider">
                                    <strong>Select Accountant <span class="font-required">*</span></strong>
                                </label>

                                <select id="select-provider" class="col-xs-12 col-sm-4 form-control" data-show-icon="true" required></select>
                            </div>
                            <br/>
                            <br/>
                            <div class="form-group">
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <div class="number-of-rental-property" style="display:none;">
                                        <label for="rental-property-dd" class="control-label">Number of Rental Property <span class="font-required">*</span></label>
                                        <input type="number" id="rental-property-dd" class="col-xs-12 col-sm-4 form-control" value="1">
                                    </div>
                                </div>
                            </div>

                            <br/>
                            <br/>
                            <div id="service-description" style="display:none;"></div>
                        </div>
                    </div>

                    <div class="command-buttons">
                        <button type="button" id="button-back-2" class="btn button-back btn-default" data-step_index="2">
                            <span class="glyphicon glyphicon-backward"></span>
                            <?= lang('back') ?>
                        </button>
                        <button type="button" id="button-next-2" class="btn button-next btn-primary" data-step_index="2">
                            <?= lang('next') ?>
                            <span class="glyphicon glyphicon-forward"></span>
                        </button>
                    </div>
                </div>

                <!-- SELECT APPOINTMENT DATE -->

                <div id="wizard-frame-3" class="wizard-frame" style="display:none;">
                    <div class="frame-container">

                        <h3 class="frame-title"><?= lang('step_two_title') ?><span data-toggle="tooltip" data-placement="bottom" title="If a time slot's missing. Then it's already booked by someone else.">
                                <i class="fa fa-info-circle" style="color: orange; font-size: 3rem; margin-top:10px;"></i>
                            </span></h3>
                        <div class="frame-content row">
                            <div class="col-xs-12 col-sm-6">
                                <div id="select-date"></div>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <div id="available-hours"></div>
                            </div>
                        </div>
                    </div>

                    <div class="command-buttons">
                        <button type="button" id="button-back-3" class="btn button-back btn-default" data-step_index="3">
                            <span class="glyphicon glyphicon-backward"></span>
                            <?= lang('back') ?>
                        </button>
                        <button type="button" id="button-next-3" class="btn button-next btn-primary" data-step_index="3">
                            <?= lang('next') ?>
                            <span class="glyphicon glyphicon-forward"></span>
                        </button>
                    </div>
                </div>

                <!-- ENTER CUSTOMER DATA -->

                <div id="wizard-frame-1" class="wizard-frame">
                    <div class="frame-container">

                        <h3 class="frame-title"> <?php if (!$email) {
                                                        echo lang('step_three_title');
                                                    } else {
                                                        echo lang('step_three_title_modified');
                                                    } ?>
                            <span class="" data-toggle="tooltip" data-placement="bottom" title="Please this form carefully.">
                                <i class="fa fa-info-circle" style="color: orange; font-size: 3rem;"></i>
                            </span>
                        </h3>

                        <div id="alert-user-1" class="alert alert-danger">
                            <strong>Attention!</strong> Please fill required fields.
                        </div>

                        <div class="frame-content row">
                            <input type="hidden" id="refid" value="" />
                            <div class="col-xs-12 col-sm-6">
                         
                                    
                                    
                                    
                                    
                                    
                                <?php if (!$email) { ?> <div class="form-group">
                                        <label for="beentous-details" class="control-label"><?= lang('been_to_us') ?> <span class="font-required">*</span></label><br>
                                        <label id="yes-label" for="beentous-details-yes" class="control-label-radio"><?= lang('spouse_yes')  ?></label>
                                        <input type="radio" name="beentous-details" class="radio-button" id="beentous-details-yes" value="Yes" data-toggle="modal" data-target="#appointment-login" />
                                        <label for="beentous-details-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                        <input type="radio" name="beentous-details" id="beentous-details-no" value="No" data-toggle="modal" />
                                    </div> <?php } ?>
                                <div class="form-group">
                                    <span class="fas fa-user-edit custom-icon"></span><label for="first-name" class="control-label"><?= lang('first_name') ?> <span class="font-required">*</span></label>
                                    <input type="text" id="first-name" class="required form-control" maxlength="100" value="<?php echo $firstname; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="last-name" class="control-label"><?= lang('last_name') ?> <span class="font-required">*</span></label>
                                    <input type="text" id="last-name" class="required form-control" maxlength="120" value="<?php echo $lastname; ?>" />
                                </div>
                                <div class="form-group">
                                    <span class="fas fa-at custom-icon"></span><label for="email" class="control-label"><?= lang('email') ?> <span class="font-required">*</span></label>
                                    <input type="text" id="email" class="required form-control" maxlength="120" value="<?php echo $email; ?>" />
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <!-- <div class="form-group">
                                    <span class="fas fa-street-view custom-icon"></span><label for="address" class="control-label"><?= lang('address') ?></label>
                                    <input type="text" id="address" class="form-control" maxlength="120" />
                                </div>
                                <div class="form-group">
                                    <span class="fas fa-city custom-icon"></span><label for="city" class="control-label"><?= lang('city') ?></label>
                                    <input type="text" id="city" class="form-control" maxlength="120" />
                                </div>
                                <div class="form-group">
                                    <span class="fas fa-map-marked-alt  custom-icon"></span><label for="zip-code" class="control-label"><?= lang('post_code') ?></label>
                                    <input type="text" id="zip-code" class="form-control" maxlength="120" />
                                </div> -->
                                
                                
                                
                                <!------------------------  DOB starts   ------------------------------>
                                
                                <div class="form-group">
                                    <label for="dob" class="control-label"><?= lang('DOB') ?><span class="font-required">*</span></label><br/>
                                    <div class="col-md-12">
                                        <div class="col-sm-4 user-birthdate">
                                            <select id="birth_date" style="width:95%;" name="birth_date" required></select>
                                            <span class="text-input">DD</span>
                                        </div>
                                        <div class="col-sm-4 user-birthdate">
                                            <select id="birth_month" style="width:95%;" name="birth_month" required></select>
                                            <span class="text-input">MM</span>
                                        </div>
                                        <div class="col-sm-4 user-birthdate">
                                            <select id="birth_year" style="width:95%;" name="birth_year" required></select>
                                            <span class="text-input">YYYY</span>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <!-----------------------   DOB ends  ------------------------->
                
                                <div class="form-group tfn-details" style="display:none;">
                                    <label for="tfn" class="control-label"><?= lang('tfn') ?></label>
                                    <input id="tfn" type="password" class="form-control" placeholder="Tax File Number">
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-tfn"></span>
                                </div>
                                <div class="form-group">
                                    <label for="tax-year" class="control-label"><?= lang('tax-year') ?><span class="font-required">*</span></label>
                                    <select id="tax-year" class="form-control"> </select>
                                </div>
                                <div class="form-group">
                                    <span class="fas fa-mobile-alt custom-icon"></span><label for="phone-number" class="control-label"><?= lang('phone_number') ?> <span class="font-required">*</span></label>
                                    <input type="number" id="phone-number" class="required form-control" maxlength="10" value="<?php echo $mobile; ?>" />
                                </div>

                                <!-- <div class="form-group">
                                    <span class="fas fa-clipboard custom-icon"></span><label for="notes" class="control-label"><?= lang('notes') ?></label>
                                    <textarea id="notes" maxlength="500" class="form-control" rows="1"></textarea>
                                </div> -->
                            </div>

                            <?php if ($display_terms_and_conditions) : ?>
                                <label>
                                    <input type="checkbox" class="required" id="accept-to-terms-and-conditions">
                                    <?= strtr(
                                        lang('read_and_agree_to_terms_and_conditions'),
                                        [
                                            '{$link}' => '<a href="#" data-toggle="modal" data-target="#terms-and-conditions-modal">',
                                            '{/$link}' => '</a>'
                                        ]
                                    )
                                    ?>
                                </label>
                                <br>
                            <?php endif ?>

                            <?php if ($display_privacy_policy) : ?>
                                <label>
                                    <input type="checkbox" class="required" id="accept-to-privacy-policy">
                                    <?= strtr(
                                        lang('read_and_agree_to_privacy_policy'),
                                        [
                                            '{$link}' => '<a href="#" data-toggle="modal" data-target="#privacy-policy-modal">',
                                            '{/$link}' => '</a>'
                                        ]
                                    )
                                    ?>
                                </label>
                                <br>
                            <?php endif ?>
                        </div>
                        <span id="form-message" class="text-danger"><?= lang('fields_are_required') ?></span>
                    </div>

                    <div class="command-buttons">
                        <button type="button" id="fake-button-here" class="btn btn-primary"><?= lang('next') ?>
                            <span class="glyphicon glyphicon-forward"></span></button>
                        <button type="button" id="button-next-1" class="btn button-next btn-primary" data-step_index="1">
                            <?= lang('next') ?>
                            <span class="glyphicon glyphicon-forward"></span>
                        </button>
                    </div>
                </div>

                <!-- APPOINTMENT DATA CONFIRMATION -->
                <div id="no-show" class="modal fade" data-keyboard="true" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h3 class="modal-title text-center"><?= lang('missing_in_action') ?></h3>
                            </div>

                            <div class="modal-body" style="background: #28c177; color: white !important; font-size: 1.5rem !important;">
                                <div class="modal-message alert hidden"></div>
                                <center><img src="assets/img/noshow.jpg" alt="no show">
                                    <b><u>
                                            <p> Our No-Show Policy & Engagement of our services</p>
                                        </u></b>
                                </center>
                                <p><span style="color:#164eb7; font-weight:bold;">Let us know.</span> If you're gonna miss the appointment at least 24 hours before by calling <b>1800 819 692</b> or email us on <b>cpa@policetax.com.au</b>
                                so that we can give your appointment to another Police Officer who needs it.</p>
                                <p style="color: #164eb7;">If you missed it! We can email you a nearly completed "draft" tax return( Prepared from your portal information ,which you will need to amend and discuss with our staff before we can finalise<br>
                                and lodge on your behalf.If you do nothing and go elswhere or proceed to do MyGov Tax you may be charged 50% of our standard fee.You call us on 03 9008 5617 or SMS your name and cancellation request within the 24 Hour notice Period then no charges will apply
                                </p>
                                <u>
                                    <p>By clicking the agree button. you are agreeing the that Accountants Plus Pty Ltd Tax Agent 5596 1005 to do the following:</p>
                                </u>
                                <ul>
                                    <li>You are allowing us to share your confidential information with ATO.You Also Agree that this is a signed electronic authority to be added as a new client<br>
                                    and to Accountants Plus Pty Ltd Tax Agent 5596 1005 or as an existing returning client to access my ATO Portal Records for the purposes of Completing the 2019 tax return or any earlier years. <br>
                                    I agree to engage Accountants Plus to complete my tax and lodge my tax to the ATO </li><br> DO NOT PROCEED UNLESS YOU ARE ABSOLUTELY SURE THIS IS WHAT YOU WANT-IF NOT SURE PLEASE RING OUR OFFICE ON 03 9008 5617 FOR CLARIFICATION.
                                    <li>You are agreeing to our no-show policy. </li>

                                </ul>
                                <form id="redirectForm" method="POST" action="/appo/index.php/appointments/payment">
                                    <input type="hidden" name="url" value="https://policetax.com.au/appo/index.php" />
                                    <input type="hidden" name="csrfToken" value="<?= $this->security->get_csrf_hash() ?>" />
                                </form>
                                <form id="book-appointment-form" style="display:inline-block" method="post">
                                    <button id="book-appointment-submit" type="button" class="btn btn-warning">
                                        <span class="glyphicon glyphicon-ok"></span>
                                        <?= lang('accept') ?>
                                    </button>
                                    <input type="hidden" name="csrfToken" />
                                    <input type="hidden" name="post_data" />
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div id="wizard-frame-4" class="wizard-frame" style="display:none;">
                    <div class="frame-container">
                        <h3 class="frame-title">Confirm Appointment <span data-toggle="tooltip" data-placement="bottom" title="Please this form carefully.">
                                <i class="fa fa-info-circle" style="color: orange; font-size: 3rem; margin-top:10px;"></i>
                            </span>
                        </h3>

                        <div class="frame-content row">
                            <div id="appointment-details" class="col-xs-12 col-sm-6"></div>
                            <div id="customer-details" class="col-xs-12 col-sm-6"></div>
                        </div>
                        <?php if ($this->settings_model->get_setting('require_captcha') === '1') : ?>
                            <div class="frame-content row">
                                <div class="col-xs-12 col-sm-6">
                                    <h4 class="captcha-title">
                                        CAPTCHA
                                        <small class="glyphicon glyphicon-refresh"></small>
                                    </h4>
                                    <img class="captcha-image" src="<?= site_url('captcha') ?>">
                                    <input class="captcha-text" type="text" value="" />
                                    <span id="captcha-hint" class="help-block" style="opacity:0">&nbsp;</span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="command-buttons">
                        <button type="button" id="button-back-4" class="btn button-back btn-default" data-step_index="4">
                            <span class="glyphicon glyphicon-backward"></span>
                            <?= lang('back') ?>
                        </button>
                        <button type="button" id="button-back-5" class="btn btn-success" data-step_index="4">
                            <span class="fa fa-check"></span>
                            Confirm
                        </button>
                        <?php if ($manage_mode) { ?><form id="book-appointment-form" style="display:inline-block" method="post">
                                <button id="book-appointment-submit" type="button" class="btn btn-success">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    <?= !$manage_mode ? lang('confirm') : lang('update') ?>
                                </button>
                                <input type="hidden" name="csrfToken" />
                                <input type="hidden" name="post_data" />
                            </form><?php } ?>
                    </div>
                </div>

                <!-- FRAME FOOTER -->
            </div>
        </div>
    </div>

    <!-- <a href="#" class="float">
        <i class="fa fa-phone fa-rotate-90 my-float"></i>
    </a> -->

    <!-- Footer -->
    <footer class="page-footer footer pt-4" style="margin-top: 50px;">

        <!-- Footer Links -->
        <div class="container">

            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-3 mt-md-0 mt-3">

                    <!-- Content -->
                    <h5 class="text-uppercase">PoliceTax</h5>
                    <p>Want the best possible tax refund you have ever had? Consider using our Police tax specialised service. Over 3,500 other Police officers can't be wrong.</p>

                </div>
                <!-- Grid column -->


                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">Yes, We have Apps</h5>
                    <h6 class="text-uppercase">Get it now!</h6>
                    <img src="assets/img/googleplay.png" alt="Google Play Store" width="170" />
                    <img src="assets/img/applestore.png" alt="Apple App Store" width="150" style="margin-left:10px;" />
                    </ul>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">
                    <h5 class="text-uppercase"> Payment Options</h5>

                    <ul class="list-unstyled">

                        <span class="fab fa-cc-mastercard custom-icon-colored"></span>
                        <span class="fab fa-cc-visa custom-icon-colored"></span>
                        <span class="fab fa-paypal custom-icon-colored"></span>
                        <span class="far fa-credit-card custom-icon-colored"></span>
                        <!-- <strong><em>Step 4</em></strong> Requires your payment info. -->
                    </ul>

                    <!-- Links -->
                    <h5 class="text-uppercase">You are in safe hands</h5>
                    <img src="assets/img/comodo_logo.png" alt="Comodo Secured" width="100" />

                </div>
                <!-- Grid column -->

                <div class="col-md-3 mb-md-0 mb-3">
                    <h5 class="text-uppercase">Refer a friend</h5>
                    <button class="btn btn-lg btn-info">Let's Share</button>

                </div>

            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->

        <hr style="border-color: #fffff;" width="60%">

        <section class="footer-areaMain" id="assistance" style="text-align: center; padding-bottom: 10px;">
            <div class="container" style="padding-top: 5px;">
                <div class="row">
                    <div class="col-md-12"><span class="footer-note"><a href="https://www.policetax.com.au/appo/">Book Appointments</a></span> <span class="footer-note">
                            <a href="#">Online Tax</a></span> <span class="footer-note">
                            <a href="#">Send to a friend</a></span> <span class="footer-note"><a href="#">Skype Appointments</a></span>
                        <span class="footer-note"><a href="https://www.policetax.com.au/sports/">Our TaxBlog</a></span>
                        <span class="footer-note"><a href="https://www.policetax.com.au/Prod/contact.php">Contact Us</a></span></div>
                </div>
            </div>

            <div class="container" style="padding-top: 11px;font-size:12px;color:white;"><span class="footer-note">Copyright © <script>
                        document.write(new Date().getFullYear());
                    </script></span> <span class="footer-note"><a href="#">Members Login</a></span> <span class="footer-note">
                    <span class="footer-note"><a href="#">Sitemap</a></span> <span class="footer-note">
                        <a href="https://www.policetax.com.au/Prod/PrivacyPolicy.php">Privacy Policy</a></span> <span class="footer-note">

                        <a href="https://www.policetax.com.au/Prod/TermsConditions.php">Terms and Conditions</a></span></span></div>

        </section>

    </footer>
    <!-- Footer -->
    <!---------- Client Details -------------->

    <div id="manage-appointment" class="modal fade" data-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Extra Information</h3>
                </div>

                <div class="modal-body">
                    <div class="modal-message alert hidden"></div>
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li id="upload-tab" role="presentation" class="active" isactive="1" currtab='1'><a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab">Tax Questions
                                    <span data-toggle="tooltip" data-placement="bottom" title="We require this info. To further process your tax return.">
                                        <i class="fa fa-info-circle" style="color: orange; font-size: 3rem; margin-top:10px;"></i>
                                    </span></a>

                            </li>
                            <li id="spouse-tab" role="presentation" style="display:none;" isactive="0" currtab='2'><a href="#spouseTab" aria-controls="spouseTab" role="tab" data-toggle="tab"><?= lang('spouse-details') ?>
                                    <span data-toggle="tooltip" data-placement="bottom" title="We require this info. To process spouse your tax return.">
                                        <i class="fa fa-info-circle" style="color: orange; font-size: 3rem; margin-top:10px;"></i>
                                    </span>
                                </a>

                            </li>
                            <li role="presentation" isactive="1" currtab='3'><a href="#proTab" aria-controls="proTab" role="tab"  data-toggle="tab">Job Details
                                    <span data-toggle="tooltip" data-placement="bottom" title="We require this info. To enhance your tax return result.">
                                        <i class="fa fa-info-circle" style="color: orange; font-size: 3rem; margin-top:10px;"></i>
                                    </span>
                                </a>

                            </li>
                            <li id="bank-details-tab" currtab='4' role="presentation" isactive="1"><a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab"><?= lang('bank-details') ?>
                                    <span data-toggle="tooltip" data-placement="bottom" title="We require this info. To direct tax return funds to your account">
                                        <i class="fa fa-info-circle" style="color: orange; font-size: 3rem; margin-top:10px;"></i>
                                    </span>
                                </a>

                            </li>
                            <!-- <li role="presentation"><a href="#credTab" aria-controls="credTab" role="tab" data-toggle="tab"><?= lang('Credentials') ?>
                                    <span data-toggle="tooltip" data-placement="bottom" title="Creates an account with us.">
                                        <i class="fa fa-info-circle" style="color: orange; font-size: 3rem; margin-top:10px;"></i>
                                    </span>
                                </a>

                            </li> -->
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="uploadTab">
                                <fieldset>

                                    <div class="row">
                                        <div id="alert-user-2" class="alert alert-danger">
                                            <strong>Attention!</strong> Please fill required fields.
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            
                                            <?php if ($email) { ?> <div class="form-group">
                                                    <label for="changed-details" class="control-label"><?= lang('changed_bank') ?></label><br>
                                                    <label id="yes-label" for="changed-details-yes" class="control-label-radio"><?= lang('spouse_yes')  ?></label>
                                                    <input type="radio" name="changed-details" class="radio-button" id="changed-details-yes" value="Yes" data-toggle="modal" data-target="#appointment-login" />
                                                    <label for="changed-details-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                    <input type="radio" name="changed-details" id="changed-details-no" value="No" data-toggle="modal" data-target="#manage-appointment" checked="true" />
                                                </div> <?php } ?>
                                                
                                                <h3>Optional Questions</h3>
                                            <div class="form-group">
                                                
                                                
                                                <label for="rental-property" class="control-label"><?= lang('rental_property') ?><span class="font-required">*</span></label>
                                                
                                                
                                                
                                                <br>
                                                <label for="rental-property-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="rental-property" class="radio-button" id="rental-property-yes" value="Yes" />
                                                <label for="rental-property-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                <input type="radio" name="rental-property" id="rental-property-no" value="No"  checked="checked" />
                                                
                                            </div>
                                            
                                        
                                        
                                        
                                        
                                        
                                        
                                            
                                            
                                            <div class="form-group">
                                                <label for="captial-gains" class="control-label">Do you have a capital gains tax event?<span class="font-required">*</span></label><br>
                                                <label for="captial-gains-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                
                                                
                                                
                                                <input type="radio" name="captial-gains" class="radio-button" id="captial-gains-yes" value="Yes" />
                                               
                                                <label for="captial-gains-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                
                                                <input type="radio" name="captial-gains" id="captial-gains-no" value="No" checked="checked" />
                                            </div>
                                            <div class="form-group">
                                                <label for="tax-overdue" class="control-label">Do you have any overdue tax return?<span class="font-required">*</span></label><br>
                                                
                                             
                                                
                                                <label for="tax-overdue-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="tax-overdue" class="radio-button" id="tax-overdue-yes" value="Yes" />
                                                <label for="tax-overdue-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="tax-overdue" id="tax-overdue-no" value="No" checked="checked"/>
                                            </div>
                                            
                                                           <h3>Complusory Questions</h3>
                                             
                                            <div class="form-group beenwithusYes" style="display:none;">
                                                <label for="changeAddress" class="control-label">Have you change address?<span class="font-required">*</span></label><br>
                                                <label for="changeAddress-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="changeAddress" class="radio-button" id="changeAddress-yes" value="Yes" />
                                                <label for="changeAddress-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="changeAddress" id="changeAddress-no" value="No" />
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
                                            <div class="form-group beenwithusNo" style="display:none;">
                                                <label for="healthInsurance" class="control-label">Do you have Private Health Insurance?<span class="font-required">*</span></label><br>
                                                <label for="healthInsurance-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="healthInsurance" class="radio-button" id="healthInsurance-yes" value="Yes" />
                                                <label for="healthInsurance-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="healthInsurance" id="healthInsurance-no" value="No" />
                                            </div>

                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group address-user">
                                                <label for="address" class="control-label"><?= lang('address') ?><span class="font-required">*</span></label>
                                                <input id="address" class="form-control" required>
                                            </div>
                                            <div class="form-group address-user">
                                                <label for="city" class="control-label"><?= lang('city') ?><span class="font-required">*</span></label>
                                                <input id="city" class="form-control" required>
                                            </div>
                                            <div class="form-group address-user">
                                                <label for="post-code" class="control-label"><?= lang('post_code') ?><span class="font-required">*</span></label>
                                                <input id="post-code" class="form-control" type="number" required>
                                            </div>
                                            <div class="form-group address-user">
                                                <label for="state" class="control-label">State <span class="font-required">*</span></label>
                                                <input id="state" class="form-control" type="text" required>
                                            </div>
                                            <div id="spouse-question" class="form-group">
                                                <label for="spouse-question" class="control-label"><?= lang('have_spouse') ?> <span class="font-required">*</span></label><br>
                                                <label for="spouse-details-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="spouse-question" class="radio-button" id="spouse-question-yes" value="Yes" />
                                                <label for="spouse-details-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="spouse-question" id="spouse-question-no" value="No" checked/>
                                            </div>
                                            <div id="spouse-question-action" class="form-group" style="display:none;">
                                                <label for="spouse-details" class="control-label"><?= lang('tax_for_spouse') ?> <span class="font-required">*</span></label><br>
                                                <label for="spouse-details-yes" class="control-label-radio"><?= lang('spouse_yes') ?></label>
                                                <input type="radio" name="spouse-details" class="radio-button" id="spouse-details-yes" value="Yes" />
                                                <label for="spouse-details-no" class="control-label-radio"><?= lang('spouse_no') ?></label>
                                                <input type="radio" name="spouse-details" id="spouse-details-no" value="No" />
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="proTab">
                                <fieldset>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="occupation-role" class="control-label"><?= lang('occupation-role') ?><span class="font-required">*</span></label>
                                                <select name="Occupation Role" id="OccupationRole" required="" class="form-control" aria-invalid="true" >
                                                    <option value="">Select</option>
                                                    <option value="PoliceOfficer">Police Officer</option>
                                                    <option value="PSO">PSO</option>
                                                    <option value="Federal">Federal Police</option>
                                                    <option value="BorderForce">Border Force Officer</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="rank" class="control-label"><?= lang('rank') ?><span class="font-required">*</span></label>
                                                <select name="rank" id="Rank" required="" class="form-control" aria-invalid="true">
                                                    <option value="">Select</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group station-data">
                                                <label for="station" class="control-label"><?= lang('station-locale') ?><span class="font-required">*</span></label>
                                                <input id="station" class="form-control" type="text" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="years-in-job" class="control-label"><?= lang('years-in-job') ?><span class="font-required">*</span></label>
                                                <input id="years-in-job" class="form-control" type="number" required>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="spouseTab">
                                <fieldset>
<input type="hidden" id="currentTotalPrice" value="" />
<input type="hidden" id="receiptNumber" value="" />
<input type="hidden" id="ccNumber" value="" />
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="spouse-firstname" class="control-label"><?= lang('spouse-firstname') ?><span class="font-required">*</span></label>
                                                <input type="text" name="spouse-firstname" id="spouse-firstname" required="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="spouse-lastname" class="control-label"><?= lang('spouse-lastname') ?><span class="font-required">*</span></label>
                                                <input type="text" name="spouse-lastname" id="spouse-lastname" required="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="spouse-tfn" class="control-label"><?= lang('spouse-tfn') ?><span class="font-required">*</span></label>
                                                <input type="text" name="spouse-tfn" id="spouse-tfn" required="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="spouse-dob" class="control-label"><?= lang('spouse-dob') ?><span class="font-required">*</span></label>
                                                <input type="date" name="spouse-dob" id="spouse-dob" required="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="spouse-occ" class="control-label"><?= lang('spouse-occ') ?><span class="font-required">*</span></label>
                                                <input type="text" name="spouse-occ" id="spouse-occ" required="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="spouse-bsb" class="control-label"><?= lang('spouse-bsb') ?></label>
                                                <input type="text" name="spouse-bsb" id="spouse-bsb" required="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="spouse-bank" class="control-label"><?= lang('spouse-bank') ?></label>
                                                <input type="text" name="spouse-bank" id="spouse-bank" required="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="browseTab">
                                <fieldset>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="bsb" class="control-label"><?= lang('bsb') ?></label>
                                                <input id="bsb" type="password" class="form-control" placeholder="*** ***">
                                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>

                                        </div>

                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="bankaccount" class="control-label"><?= lang('bank-account') ?></label>
                                                <input id="bankaccount" type="password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <!-- <div role="tabpanel" class="tab-pane" id="credTab">
                                <fieldset>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="usrname" class="control-label"><?= lang('username') ?></label>
                                                <input id="usrname" type="text" class="form-control" placeholder="Let this be unique">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="passwd" class="control-label"><?= lang('password') ?></label>
                                                <input id="passwd" type="password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background: white !important;">
                    <button id="cancel-appointment" class="btn btn-default pull-left" style="margin-right:10px;" data-dismiss="modal">Back</button>
                    <button id="save-appointment" class="btn btn-primary pull-left" style="margin-right:10px;">Next</button>
                </div>
            </div>
        </div>
    </div>

    <div id="appointment-amend" class="modal fade" data-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Please Update Your Details</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="address" class="control-label"><?= lang('address') ?></label>
                                <input id="address" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="bsb" class="control-label"><?= lang('bsb') ?></label>
                                <input id="bsb" type="password" class="form-control" placeholder="*** ***">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="bankaccount" class="control-label"><?= lang('bank-account') ?></label>
                                <input id="bankaccount" type="password" class="form-control">
                            </div>
                            <button id="save-amend-appointment" class="btn btn-primary pull-right" style="margin-right:10px;" data-dismiss="modal"><?= lang('save') ?></button>
                            <button id="cancel-appointment" class="btn btn-default pull-right" style="margin-right:10px;" data-dismiss="modal"><?= lang('cancel') ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php if ($display_cookie_notice === '1') : ?>
        <?php require 'cookie_notice_modal.php' ?>
    <?php endif ?>

    <?php if ($display_spouse_details == '1') : ?>
        <?php require 'spouse_details_modal.php' ?>
    <?php endif ?>

    <?php if ($display_terms_and_conditions === '1') : ?>
        <?php require 'terms_and_conditions_modal.php' ?>
    <?php endif ?>

    <?php if ($display_privacy_policy === '1') : ?>
        <?php require 'privacy_policy_modal.php' ?>
    <?php endif ?>

    
    <script>
        var currentURL = window.location.href;
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
            AJAX_SUCCESS: 'SUCCESS',
        };
        
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

        var EALang = <?= json_encode($this->lang->language) ?>;
        var availableLanguages = <?= json_encode($this->config->item('available_languages')) ?>;
        
    </script>

    <script src="<?= asset_url('assets/js/general_functions.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/jquery/jquery.min.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/jquery-ui/jquery-ui.min.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="<?= asset_url('assets/ext/jquery-qtip/jquery.qtip.min.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/cookieconsent/cookieconsent.min.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/datejs/date.js') ?>"></script>
    <script src="<?= asset_url('assets/js/frontend_book_api.js') ?>"></script>
    <script src="<?= asset_url('assets/js/frontend_book.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    
    <script src="/vendor/minimalist-picker/dobpicker.js"></script>

    <script>
        $(document).ready(function() {
            $("#loading").show();
            FrontendBook.initialize(true, GlobalVariables.manageMode);
            GeneralFunctions.enableLanguageSelection($('#select-language'));
            
            $.dobPicker({
                daySelector: '#birth_date',
                monthSelector: '#birth_month',
                yearSelector: '#birth_year',
                dayDefault: '',
                monthDefault: '',
                yearDefault: '',
                minimumAge: 0,
                maximumAge: 95
            });
            
            
        if(currentURL.indexOf("summarycode") != -1){
            var data = getUrlVars();
            $("#refid").val(data.txnid);
            if(data.summarycode != undefined){
                //console.log(customer.email);
                if(data.summarycode == 1 || (data.summarycode == 2 && data.email == "it@policetax.com.au")){
                    
                    FrontendBookApi.getTempData(parseInt(data.book));
                    $("#loading").hide();
                    
                    
                }else{
                    $("#loading").hide();
                    alert('Your payment was not successful. Please try again later.');
                    window.location.href = "https://policetax.com.au/appo/index.php";
                }
            }else{
                $("#loading").hide();
                alert('Your payment was not successful. Please try again later.');
                window.location.href = "https://policetax.com.au/appo/index.php";
            }

        
        }else{
            $.removeCookie("ea_booking");
            $("#loading").hide();
            
            if($.cookie("ea_back") != undefined && $.cookie("ea_back") != "" && $.cookie("ea_back") == "1"){
                
                if($.cookie("ea_booking") != undefined && $.cookie("ea_booking") != ""){
                    var customer = JSON.parse($.cookie("ea_booking"));
                        
                    if (customer.spouse_yes_no == "Yes") {
                        $('#spouse-details-yes').prop("checked", "checked");
                    }else{
                        $('#spouse-details-no').prop("checked", "checked");
                    }
                    
                    if (customer.married == "Yes") {
                        $('#spouse-question-yes').prop("checked", "checked");
                    }else{
                        $('#spouse-question-no').prop("checked", "checked");
                    }
                    
                    if (customer.rental_property == "Yes") {
                        $('#rental-property-yes').prop("checked", "checked");
                    }else{
                        $('#rental-property-no').prop("checked", "checked");
                    }
                        
                    $('#beentous-details-no').prop("checked", "checked");
                    $(".tfn-details").show();
                    
                    if (customer.capital_gains == "Yes") {
                        $('#captial-gains-yes').prop("checked", "checked");
                    }else{
                        $('#captial-gains-no').prop("checked", "checked");
                    }
                    
                    if (customer.tax_overdue == "Yes") {
                        $('#tax-overdue-yes').prop("checked", "checked");
                    }else{
                        $('#tax-overdue-no').prop("checked", "checked");
                    }
                    
                    var dobData = customer.dob.split("/");
                    $("#birth_date").val(dobData[0]);
                    $("#birth_month").val(dobData[1]);
                    $("#birth_year").val(dobData[2]);
                    $("#select-service").val(customer.id_services);
                    //$("#select-service").attr("disabled", "disabled");
                    $("#select-provider").val(customer.id_users_provider);
                    //$("#select-provider").attr("disabled", "disabled");
                    
                    $("#select-provider").trigger("change");
                    
                    $("#number-years-dd").val(customer.number_years_dd);
                    //$("#number-years-dd").attr("disabled", "disabled");
                    $("#rental-property-dd").val(customer.rental_property_dd);
                    //$("#rental-property-dd").attr("disabled", "disabled");
                    $('#last-name').val(customer.last_name);
                    $('#first-name').val(customer.first_name);
                    $('#email').val(customer.email);
                    $('#phone-number').val(customer.phone_number);
                    $('#address').val(customer.address);
                    $('#city').val(customer.city);
                    $('#post-code').val(customer.zip_code);
                    $('#state').val(customer.state);
                    $('#city').val(customer.city);
                    $('#bsb').val(customer.bsb);
                    $('#bankaccount').val(customer.bank_account);
                    $('#tfn').val(customer.tfn);
                    $('#OccupationRole').val(customer.occupation_role);
                    $('#station').val(customer.station_locale);
                    $('#Rank').val(customer.rank);
                    $('#years-in-job').val(customer.years_in_job);
                    $('#spouse-firstname').val(customer.spouse_firstname);
                    $('#spouse-lastname').val(customer.spouse_lastname);
                    $('#spouse-bsb').val(customer.spouse_bsb);
                    $('#spouse-bank').val(customer.spouse_acc);
                    $('#spouse-tfn').val(customer.spouse_tfn);
                    $('#spouse-dob').val(customer.spouse_dob);
                    $('#spouse-occ').val(customer.spouse_occ);
                    $('#tax-year').val(customer.tax_year);
                    
                    $("#wizard-frame-3").hide();
                    $("#wizard-frame-2").hide();
                    
                    
                    //$.removeCookie("ea_booking");
                }
                
                $.removeCookie("ea_back");
            $("#loading").hide();
            }else{
                $.removeCookie("ea_back");
            $("#loading").hide();
            }
        }
        
        $(document).on("change", 'input[type=radio][name=AppointmentType]', function() {
            if ($(this).val() == 'Video') {
                $(".suspendedCovid").hide();
            } else {
                $(".suspendedCovid").show();
            }
        });
            
        $(document).on("change", "#number-years-dd", function(e){
            e.preventDefault();
            
            if($(this).val() == "6"){
                alert("Please contact office to book appointment at 0418 327 096.");
                return false;
            }
            $("#select-service").trigger("change");
        });
            
        $("#rental-property-dd").keypress(function() {
            var currentValue = parseInt($(this).val());
            //console.log(currentValue);
            setTimeout(function() {
                $("#select-service").trigger("change");
            }, 600);
        });
        
            $(document).on("change", "#OccupationRole", function(e){
                e.preventDefault();
                $("#station").val("");
                $(".station-data").show();
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
                    $("#station").val("Other");
                    $(".station-data").hide();
                    $("#Rank").html("");
                    $("#Rank").html(`<option value="Select">Select</option>
                                                <option value="Other">Other</option>`);
                } else {
                    $("#Rank").html("");
                    $("#Rank").html(`<option value="Select">Select</option>`);
                }
                
            });
            
            $("#save-appointment").on('click', function(e){
               e.preventDefault();
               
               var changeTab = 0;
               var countTab = 1;
               var currentTab = $(".nav-tabs").find("li.active").attr("currtab");
               
            
               $("#wizard-frame-4").hide();
               $.each($(".tab-content").find(".tab-pane"), function(i, v){
                  $(this).removeClass("active"); 
               });
               
               $.each($(".nav-tabs").find("li"), function(i, v){
                  if($(this).attr("isactive") == "1" && parseInt(currentTab) < parseInt($(this).attr("currtab"))){
                    $(this).toggleClass('active');
                    
                    var content = "#" + $(this).find("a").attr("aria-controls");
                    $(".tab-content").find(content).addClass("active");
                    changeTab += 1;
                    
                    return true;
                  } else if (parseInt(currentTab) == parseInt($(this).attr("currtab"))){
                    $(this).toggleClass('active');
                  }
                  countTab += 1;
               });
               
               if(changeTab == 0){
                   if($("#OccupationRole option:selected").val() != "" && $("#Rank option:selected").val() != ""
                   && $("#station").val() != "" && $("#years-in-job").val() != ""){
                    $("#manage-appointment").modal('hide');
                    $('#button-next-1').trigger("click");
                    $("#wizard-frame-4").hide();
                   } else {
                        $.each($(".nav-tabs").find("li"), function(i, v){
                            if($(this).attr("isactive") == "1" && parseInt(currentTab) < parseInt($(this).attr("currtab"))){
                                $(this).toggleClass('active');
                                
                                var content = "#" + $(this).find("a").attr("aria-controls");
                                $(".tab-content").find(content).addClass("active");
                                changeTab += 1;
                                
                                return true;
                            } else if (parseInt(currentTab) == parseInt($(this).attr("currtab"))){
                                $(this).toggleClass('active');
                                var content = "#" + $(this).find("a").attr("aria-controls");
                                $(".tab-content").find(content).addClass("active");
                            }
                        });
                       alert("Please enter all the required fields.");
                   }
               }
               
               return;
               
            });

            $('[data-toggle="tooltip"]').tooltip();

            $(".toggle-password").click(function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $("#bsb");
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
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



            if (($("input[name='beentous-details']:checked").val() == "Yes") 
                || $('#email').val() == '' || $('#phone-number').val() == '' || $('#first-name').val() == '' || $('#last-name').val() == '') {
                $('#button-next-1').hide();
                $('#alert-user-1').show();
                $('#fake-button-here').show();
                $('#fake-button-here').css('opacity', .2);
            } else {
                $('#alert-user-1').hide();
                $('#form-message').hide();
                $('#button-next-1').hide();
                $('#button-next-1').show();
                $('#fake-button-here').hide();
            }
            
            $('input').click(function() {
                var myDob_date = $("#birth_date option:selected").val();
                var myDob_month = $("#birth_month option:selected").val();
                var myDob_year = $("#birth_year option:selected").val();
                var myDob = myDob_date + "/" + myDob_month + "/" + myDob_year;
                $('input').on('keydown', function() {
                    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    if ($('#changeAddress-yes').is(':checked')) {
                        if ($('#address').val() != '' && $('#city').val() != '' && $('#post-code').val() != '' && $('#state').val() != '' && $('#tax-year').val() != ''
                            && $("#OccupationRole").val() != '' && $("#Rank").val() != '' && $("#station").val() != '' && $("#years-in-job").val() != '') {
                            $('#button-next-1').show();
                            $('#save-appointment').show();
                            $('#alert-user-2').hide();
                            $('#fake-button-here').hide();
                            $('#alert-user-1').hide();
                $('#form-message').hide();

                        }
                    } else if ($('#changeAddress-no').is(':checked')) {
                        if ($('#tax-year').val() != '' 
                            && $("#OccupationRole").val() != '' && $("#Rank").val() != '' && $("#station").val() != '' && $("#years-in-job").val() != '') {
                            $('#button-next-1').show();
                            $('#save-appointment').show();
                            $('#alert-user-2').hide();
                            $('#fake-button-here').hide();
                            $('#alert-user-1').hide();
                $('#form-message').hide();

                        }
                    }
                    
                    if (regex.test($('#email').val()) && $('#phone-number').val() != '' && ($("input[name='beentous-details']:checked").val() != undefined) ) {
                        $('#fake-button-here').css('opacity', 1);
                        $('#fake-button-here').on('click', function() {
                            $('#manage-appointment').modal().show();
                            // $('#save-appointment').on('click', function() {
                            //     $('#button-next-1').show();
                            //     $('#fake-button-here').hide();
                            //     $('#alert-user-1').hide();
                            // });
                        });
                    } else {
                        $('#button-next-1').hide();
                        $('#alert-user-1').show();
                        $('#form-message').show();
                        $('#fake-button-here').show();
                    }
                });

            });

            $("#button-back-5").click(function(event) {
                event.preventDefault();
                //$('#no-show').modal().show();
                $.removeCookie("ea_booking");
                $('#book-appointment-submit').click();
            });

            $('#spouse-details-yes').click(function() {
                if ($('#spouse-details-yes').is(':checked')) {
                    $('#spouse-tab').show();
                    $('#spouse-tab').attr("isactive", "1");
                    $('#spouseTab').toggleClass('active');
                    $('#uploadTab').toggleClass('active');
                    $('#spouse-tab').toggleClass('active');
                    $('#upload-tab').toggleClass('active');

                }
            });
            $('#spouse-details-no').click(function() {
                if ($('#spouse-details-no').is(':checked')) {
                    $('#spouse-tab').hide();
                    $('#spouse-tab').attr("isactive", "0");
                }
            });
            $('#spouse-question-yes').click(function() {
                if ($('#spouse-question-yes').is(':checked')) {
                    $('#spouse-question-action').show();
                    $('#spouse-question').hide();
                }
            });

            $('input[name="changeAddress"]').click(function() {
                if ($('#changeAddress-yes').is(':checked')) {
                    $('.address-user').show();
                    $("#address").attr("required", "required");
                    $("#city").attr("required", "required");
                    $("#post-code").attr("required", "required");
                    $("#state").attr("required", "required");
                } else if ($('#changeAddress-no').is(':checked')) {
                    $('.address-user').hide();
                    $("#address").removeAttr("required");
                    $("#city").removeAttr("required");
                    $("#post-code").removeAttr("required");
                    $("#state").removeAttr("required");
                }
            });

            $('input[name="bsb-bankaccountchanged"]').click(function() {
                if ($('#bsb-bankaccountchanged-yes').is(':checked')) {
                    $('#bank-details-tab').show();
                    $('#bank-details-tab').attr("isactive", "1");
                } else if ($('#bsb-bankaccountchanged-no').is(':checked')) {
                    $('#bank-details-tab').hide();
                    $('#bank-details-tab').attr("isactive", "0");
                }
            });

            $('#changed-details-yes').click(function() {
                if ($('#changed-details-yes').is(':checked')) {
                    $('#appointment-amend').modal().show();
                }
            });

            $(document).on("click", "input[name='beentous-details']", function(){
                $(".beenwithusYes").hide();
                $('#bank-details-tab').hide();
                $('#bank-details-tab').attr("isactive", "0");
                $(".tfn-details").hide();
                $('.address-user').hide();
                if($(this).val() == "Yes"){
                    $(".beenwithusYes").show();
                    $(".tfn-details").hide();
                    $(".beenwithusNo").hide();
                }else{
                    $('#bank-details-tab').show();
                    $('#bank-details-tab').attr("isactive", "1");
                    $('.address-user').show();
                    $(".tfn-details").show();
                    $("input[id='changeAddress-yes']"). prop("checked", false);
                    $("input[id='changeAddress-no']"). prop("checked", false);
                    $("input[id='bsb-bankaccountchanged-yes']"). prop("checked", false);
                    $("input[id='bsb-bankaccountchanged-no']"). prop("checked", false);
                    $(".beenwithusNo").show();
                    //$('#manage-appointment').modal().hide();
                }

                //$('#manage-appointment').modal().show();
            });

            // $('#beentous-details-yes').attr('disabled', true);
            // $('#beentous-details-yes').css('opacity', '.2');
            // ${'#yes-label').css('opacity','.2');

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
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5b30358deba8cd3125e3211a/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();

        $("#tawkchat-chat-bubble-close").hide();
        $(".agentInfoNoImage").find("b").text("Customer Service");
    </script>

    <?php google_analytics_script(); ?>
</body>

</html>