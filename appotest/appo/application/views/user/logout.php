<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#35A768">

    <title><?= lang('log_out') . ' - ' . $company_name ?></title>

    <link rel="icon" type="image/x-icon" href="<?= asset_url('assets/img/favicon.ico') ?>">

    <script src="<?= asset_url('assets/ext/jquery/jquery.min.js') ?>"></script>
    <script src="<?= asset_url('assets/ext/bootstrap/js/bootstrap.min.js') ?>"></script>

    <script>
        var EALang = <?= json_encode($this->lang->language) ?>;
    </script>

    <link
        rel="stylesheet"
        type="text/css"
        href="<?= asset_url('assets/ext/bootstrap/css/bootstrap.min.css') ?>">

    <style>
        body {
            width: 100vw;
            height: 100vh;
            display: table-cell;
            vertical-align: middle;
        }

        #logout-frame {
            width: 630px;
            margin: auto;
            background: #FFF;
            border: 1px solid #DDDADA;
            padding: 70px;
        }

        .btn {
            margin-right: 10px;
        }

        @media(max-width: 640px) {
            #logout-frame {
                width: 100%;
                padding: 20px;
            }

            .btn {
                width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div id="logout-frame" class="frame-container">
        <h3><?= lang('log_out') ?></h3>
        <p>
            <?= lang('logout_success') ?>
        </p>

        <br>

        <a href="<?= site_url() ?>" class="btn btn-success btn-large">
            <span class="glyphicon glyphicon-home"></span>
            <?= lang('go_to_website') ?>
        </a>

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
                <div class="text-center"><img src="<?= asset_url('assets/img/blog.png') ?> alt="" width="98"></div>
                <p>We are always more than just a tax agent. Check out our blog and embrace your tax refund.</p>
            </div>
            <div class="col-md-2">
                <div class="text-center"><img src="<?= asset_url('assets/img/car.png') ?> alt="" width="98"></div>
                <p>Traveling between stations or courts? Record your car kms with our mobile app. The best part is we don't track you.</p>
            </div>
            <div class="col-md-2">
                <div class="text-center"><img src="<?= asset_url('assets/img/previous.png') ?> alt="" width="98"></div>
                <p>Are you unhappy with your previous year tax refund? PoliceTax to the rescue. Check this out</p>
            </div>
            <div class="col-md-2">
                <div class="text-center"><img src="<?= asset_url('assets/img/buddy.png') ?> alt="" width="98"></div>
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
</body>
</html>
