<link rel="stylesheet" type="text/css" href="<?= asset_url('/assets/css/backend.css') ?>">
<script src="<?= asset_url('assets/js/dashboard.js') ?>"></script>

<script>
    var GlobalVariables = {
        csrfToken: <?= json_encode($this->security->get_csrf_hash()) ?>,
        baseUrl: <?= json_encode($base_url) ?>,
        dateFormat: <?= json_encode($date_format) ?>,
        timeFormat: <?= json_encode($time_format) ?>,
        services: <?= json_encode($services) ?>,
        categories: <?= json_encode($categories) ?>,
        user: {
            id: <?= $user_id ?>,
            email: <?= json_encode($user_email) ?>,
            role_slug: <?= json_encode($role_slug) ?>,
            privileges: <?= json_encode($privileges) ?>
        }
    };

    $(document).ready(function() {
        BackendServices.initialize(true);
    });
</script>

<div class="container">
    <div class="row">
        <div class="col-md-3 card-style">
            <div class="row">
                <div class="col-md-4">
                    <img src="" alt="">
                </div>
                <div class="col-md-8">
                    <p><?= lang('overall') ?></p>
                    <h5 id="till_date"></h5>
                </div>

            </div>
        </div>
        <div class="col-md-3 card-style">
            <div class="row">
                <div class="col-md-4">
                    <img src="" alt="">
                </div>
                <div class="col-md-8">
                    <p><?= lang('month_count') ?></p>
                    <h5 id="this_month"></h5>
                </div>

            </div>
        </div>
        <div class="col-md-3 card-style">
            <div class="row">
                <div class="col-md-4">
                    <img src="" alt="">
                </div>
                <div class="col-md-8">
                    <p><?= lang('fortnight_count') ?></p>
                    <h5 id="this_fortnight"></h5>
                </div>

            </div>
        </div>
        <div class="col-md-3 card-style">
            <div class="row">
                <div class="col-md-4">
                    <img src="" alt="">
                </div>
                <div class="col-md-8">
                    <p><?= lang('week_count') ?></p>
                    <h5 id="this_week"></h5>
                </div>

            </div>
        </div>
        <div class="col-md-3 card-style">
            <div class="row">
                <div class="col-md-4">
                    <img src="" alt="">
                </div>
                <div class="col-md-8">
                    <p><?= lang('day_count') ?></p>
                    <h5 id="today"></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 card-style">
            <div id="appointments_under">

            </div>
        </div>
    </div>

</div>