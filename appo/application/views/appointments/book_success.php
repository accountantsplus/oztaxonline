<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#35A768">
    <title><?= lang('appointment_registered') . ' - ' . $company_name ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/ext/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset_url('assets/css/frontend.css') ?>">

    <link rel="icon" type="image/x-icon" href="<?= asset_url('assets/img/favicon.ico') ?>">
    <link rel="icon" sizes="192x192" href="<?= asset_url('assets/img/logo.png') ?>">
</head>

<body>
    <div id="main" class="container">
        <div class="wrapper row">
            <div id="success-frame" class="frame-container
                    col-xs-12
                    col-sm-offset-1 col-sm-10
                    col-md-offset-2 col-md-8
                    col-lg-offset-2 col-lg-8">

                <div class="col-xs-12 col-sm-2">
                    <img id="success-icon" class="pull-right" src="<?= base_url('assets/img/success.png') ?>" />
                    <img id="fail-icon" width="64" class="pull-right" src="<?= base_url('assets/img/fail.png') ?>" />
                </div>
                <div class="col-xs-12 col-sm-10">
                    <h3 id='messageToClient-fail'><?= lang('appointment_registered_but_payment_failed') ?></h3>
                    <h3 id='messageToClient' ><?= lang('appointment_registered') ?></h3>
                    <?php
                    echo '
                            <p>' . lang('appointment_details_was_sent_to_you') . '</p>
                            
                        ';

                    if ($this->config->item('google_sync_feature')) {
                        echo '
                                <button id="add-to-google-calendar" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    ' . lang('add_to_google_calendar') . '
                                </button>';
                    }

                    // Display exceptions (if any).
                    if (isset($exceptions)) {
                        echo '<div class="col-xs-12" style="margin:10px">';
                        echo '<h4>Unexpected Errors</h4>';
                        foreach ($exceptions as $exc) {
                            echo exceptionToHtml($exc);
                        }
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container" style="margin-top:15px;">
            <h3 class="text-center"> Did you know?</h3>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div class="text-center"><img src="<?= asset_url('assets/img/happy.png') ?>" alt="" width="98"></div>
                <p>We have served &amp; educated more than 3500 and counting happy Police officers.</p>
            </div>
            <div class="col-md-2">
                <div class="text-center"><img src="<?= asset_url('assets/img/blog.png') ?> alt="" width=" 98"></div>
                <p>We are always more than just a tax agent. Check out our blog and embrace your tax refund.</p>
            </div>
            <div class="col-md-2">
                <div class="text-center"><img src="<?= asset_url('assets/img/car.png') ?> alt="" width=" 98"></div>
                <p>Traveling between stations or courts? Record your car kms with our mobile app. The best part is we don't track you.</p>
            </div>
            <div class="col-md-2">
                <div class="text-center"><img src="<?= asset_url('assets/img/previous.png') ?> alt="" width=" 98"></div>
                <p>Are you unhappy with your previous year tax refund? PoliceTax to the rescue. Check this out</p>
            </div>
            <div class="col-md-2">
                <div class="text-center"><img src="<?= asset_url('assets/img/buddy.png') ?> alt="" width=" 98"></div>
                <p>Want to get reward? Refer a friend and grab an exciting offer.</p>
            </div>

        </div>

    </div>

    <div class="container-fluid" style="background: #e8e8e8; padding: 15px 15px;">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <h4>
                        We are here to answer all your tax questions. Why not just say a Hi!
                    </h4>
                </div>
                <div class="col-md-4">
                    <a href="<?= site_url() ?>"> <button style="margin-top:5px;" id="login" class="btn btn-success">
                            <?= lang('call_us_now') ?> </button></a>

                </div>
            </div>
        </div>

        <script src="<?= base_url('assets/ext/jquery/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/ext/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/ext/datejs/date.js') ?>"></script>
        <script src="https://apis.google.com/js/client.js"></script>

        <script>
            var GlobalVariables = {
                'csrfToken': <?= json_encode($this->security->get_csrf_hash()) ?>,
                'appointmentData': <?= json_encode($appointment_data) ?>,
                'providerData': <?= json_encode($provider_data) ?>,
                'serviceData': <?= json_encode($service_data) ?>,
                'companyName': <?= json_encode($company_name) ?>,
                'googleApiKey': <?= json_encode(Config::GOOGLE_API_KEY) ?>,
                'googleClientId': <?= json_encode(Config::GOOGLE_CLIENT_ID) ?>,
                'googleApiScope': 'https://www.googleapis.com/auth/calendar'
            };

            var EALang = <?= json_encode($this->lang->language) ?>;
        </script>

        <script src="<?= asset_url('assets/js/frontend_book_success.js') ?>"></script>
        <script src="<?= asset_url('assets/js/general_functions.js') ?>"></script>

        <script>
            $(document).ready(function() {

                $('#fail-icon').hide();
                $('#messageToClient-fail').hide();
                $('#success-icon').hide();
                $('#messageToClient').hide();

                var appointmentid;

                function getUrlParameter(sParam) {
                    var sPageURL = window.location.search.substring(5),
                        appointments_id = window.location.pathname.split('/'),
                        length_url = window.location.pathname.split('/').length,
                        sURLVariables = sPageURL.split('&'),
                        sParameterName,
                        i;

                        appointmentid = appointments_id[length_url-1];

                    for (i = 0; i < sURLVariables.length; i++) {
                        sParameterName = sURLVariables[i].split('=');

                        if (sParameterName[0] === sParam) {
                            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                        }
                    }
                };
                
                var paymentSuccess = 0;
                    $('#success-icon').show();
                    $('#messageToClient').show();
                    paymentSuccess = 1;

                
                var payment_status_var = getUrlParameter('summarycode');
                var payment_ack_number_var = getUrlParameter('txnid');
                var payment_account_info_var = getUrlParameter('pan');

                var postUrl = window.location.origin + '/appo/index.php/appointments/book_success_update';
                var postData = {
                        csrfToken: GlobalVariables.csrfToken,
                        id: appointmentid,
                        payment_status: payment_status_var,
                        IsPaid: paymentSuccess,
                        payment_ack_number: payment_ack_number_var,
                        payment_account_info: payment_account_info_var,
                    };

                    
                $.post(postUrl, postData, function (response) {
                    console.log(response);
                });

            });
        </script>

        <?php google_analytics_script() ?>
</body>

</html>