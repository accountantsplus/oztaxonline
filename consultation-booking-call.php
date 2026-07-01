<?php
// consultation-booking-call.php (Oz Tax Online)
// Stage 2 — pre-filled appointment-request form. Leads arrive here from
// checklists-download-free-copy-now.php (lead saved in $_SESSION['ptx_lead']).
// On submit we email the team so they can call the client and book them via apponew.
// No appointment is created here. Cloned from PoliceTax/AmbosTax, rebranded for Oz Tax.

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/db_connect.php';
ptx_session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function ls2_h($v): string { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function ls2_sel($actual, $expected): string { return (string)$actual === (string)$expected ? ' selected' : ''; }
function ls2_clean($key): string { return htmlspecialchars(trim($_POST[$key] ?? ''), ENT_QUOTES, 'UTF-8'); }
function ls2_slot_value($dateKey, $timeKey): string {
    $date = ls2_clean($dateKey);
    $time = ls2_clean($timeKey);
    return trim($date . ($date !== '' && $time !== '' ? ' - ' : '') . $time);
}

$lead = $_SESSION['ptx_lead'] ?? [];

// Free checklist download. Relative (same-origin) path so the browser's
// download attribute works whether the site is served from www or non-www.
$ls2_download_link = '/downloads/oz-tax-refund-checklist.pdf';

// Where the team books the confirmed appointment.
$ls2_apponew_link = 'https://www.policetax.com.au/apponew/index.php?industry=OTH';

// One-time auto-download flag set by the checklist page. Read it, then clear
// it so a page refresh does not re-trigger the download.
$autoDownloadChecklist = !empty($_SESSION['ptx_download_checklist']);
unset($_SESSION['ptx_download_checklist']);

$pf = [
    'firstName'          => $lead['first_name'] ?? '',
    'appointment_method' => 'Video - Zoom / Skype',
    'preferred_date_1'   => '',
    'preferred_time_1'   => '',
    'preferred_date_2'   => '',
    'preferred_time_2'   => '',
];

// Let any posted-back value win so the form survives a validation bounce.
foreach ($pf as $key => $value) {
    if (isset($_POST[$key]) && $_POST[$key] !== '') {
        $pf[$key] = $_POST[$key];
    }
}

$booked = false;
$bookError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form'] ?? '') === 'stage2_booking') {

    $honeypot  = trim($_POST['website'] ?? '');
    $csrf      = $_POST['csrf_token'] ?? '';

    $firstName = ls2_clean('firstName');
    $surName   = ls2_clean('surName');
    $fullName  = trim($firstName . ' ' . $surName);
    $email     = ls2_clean('email');
    $mobile    = ls2_clean('mobile');
    $preferredDate1 = trim($_POST['preferred_date_1'] ?? '');
    $preferredTime1 = trim($_POST['preferred_time_1'] ?? '');
    $preferredDate2 = trim($_POST['preferred_date_2'] ?? '');
    $preferredTime2 = trim($_POST['preferred_time_2'] ?? '');
    $hasPreferredSlot1 = $preferredDate1 !== '' && $preferredTime1 !== '';
    $hasPreferredSlot2 = $preferredDate2 !== '' && $preferredTime2 !== '';
    $hasPartialPreferredSlot = ($preferredDate1 !== '' xor $preferredTime1 !== '')
        || ($preferredDate2 !== '' xor $preferredTime2 !== '');

    if ($honeypot !== '') {
        $bookError = 'Spam detected.';
    } elseif (!hash_equals($_SESSION['csrf_token'] ?? '', $csrf)) {
        $bookError = 'Security token expired. Please refresh and try again.';
    } elseif ($firstName === '') {
        $bookError = 'Please enter your first name.';
    } elseif ($email === '' || $mobile === '') {
        // email/mobile arrive as hidden fields from the checklist step.
        $bookError = "We could not find your contact details. Please call us on 1800 819 692 and we'll book you in.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $bookError = "We could not read your email. Please call us on 1800 819 692 and we'll book you in.";
    } elseif ($hasPartialPreferredSlot) {
        $bookError = 'Please choose both a preferred date and time for any appointment slot you fill in.';
    } elseif (!$hasPreferredSlot1 && !$hasPreferredSlot2) {
        $bookError = 'Please choose at least one preferred appointment date and time.';
    } else {

        $fields = [
            'First Name'            => $firstName,
            'Email'                 => $email,
            'Mobile'                => $mobile,
            'State / Territory'     => ls2_clean('state'),
            'Describes Them'        => ls2_clean('rank'),
            'Needs Help With'       => ls2_clean('tax_help'),
            'Preferred Appointment' => ls2_clean('appointment_method'),
            'Preferred Slot 1'      => ls2_slot_value('preferred_date_1', 'preferred_time_1'),
            'Preferred Slot 2'      => ls2_slot_value('preferred_date_2', 'preferred_time_2'),
        ];

        $subject = "LANDING PAGE Booking Request (FREE 30-min upgrade) — {$fullName}";

        $body  = "<html><body style='font-family:Arial,Helvetica,sans-serif;color:#222;'>";
        $body .= "<h2 style='color:#003366;'>New Booking Request &mdash; Oz Tax Landing Page Offer</h2>";

        $body .= "<p style='background:#fff3cd;border-left:6px solid #e0a800;padding:12px;border-radius:6px;'>";
        $body .= "<strong>Where this came from:</strong> the Oz Tax Stage 2 Landing Page "
               . "(consultation-booking-call.php) &mdash; <u>not</u> the standard appointment form.<br><br>";
        $body .= "<strong>Special offer for this client:</strong> a <strong>FREE extra 30-minute "
               . "consultation</strong>. Standard appointments are 15 minutes for \$230. "
               . "Please book this client a 45-minute appointment: \$230 + \$75, with the "
               . "<strong>\$75 upgrade FREE</strong> (total payable \$230 incl GST).";
        $body .= "</p>";

        $body .= "<p>This client came through the Oz Tax Checklist funnel and has requested an appointment.<br>";
        $body .= "<strong>Please call them to confirm and book the appointment via:</strong><br>";
        $body .= "<a href='{$ls2_apponew_link}'>{$ls2_apponew_link}</a></p>";
        $body .= "<table border='1' cellpadding='8' cellspacing='0' style='border-collapse:collapse;width:100%;max-width:640px;font-size:14px;'>";
        foreach ($fields as $label => $value) {
            $shown = $value !== '' ? $value : '&mdash;';
            $body .= "<tr><td style='width:40%;background:#f4f7fb;'><strong>{$label}</strong></td><td>{$shown}</td></tr>";
        }
        $body .= "</table>";
        $body .= "<p style='font-size:12px;color:#888;'>Sent automatically from consultation-booking-call.php — " . date('d/m/Y H:i') . "</p>";
        $body .= "</body></html>";

        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";
        $headers .= "From: Oz Tax Online <customerservice@accountantsplus.com.au>\r\n";
        $headers .= "Reply-To: {$email}\r\n";
        // TODO(TEST): remove smanvendra733@gmail.com once email delivery is confirmed.
        $headers .= "Bcc: smanvendra733@gmail.com\r\n";

        $sent = mail('crm@policetax.com.au', $subject, $body, $headers);

        // Best-effort: flag the originating checklist lead as converted.
        if (!empty($lead['lead_id'])) {
            try {
                $upd = ptx_db()->prepare('UPDATE ea_checklist_leads SET converted = 1 WHERE id = ?');
                $upd->execute([(int)$lead['lead_id']]);
            } catch (Throwable $e) {
                error_log('Oz Tax Stage2 converted-flag update failed: ' . $e->getMessage());
            }
        }

        if ($sent) {
            unset($_SESSION['ptx_lead']);
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            // Send the client to the confirmation page (POST -> redirect -> GET).
            header('Location: thank-you-booking.php');
            exit;
        } else {
            $bookError = 'Sorry, we could not submit your request. Please call us on 1800 819 692.';
        }
    }
}

$showPrefillNote = !$booked && !empty($lead);
$showChecklistBanner = !$booked && !empty($lead);
?>
<!DOCTYPE html>
<html lang="en-AU">
<head>
<meta charset="UTF-8">

<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '2200735990663030');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=2200735990663030&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

<title>Book Your Oz Tax Appointment | Oz Tax Online</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
*{box-sizing:border-box}

body{
    margin:0;
    font-family:Arial,Helvetica,sans-serif;
    background:#ffffff;
    color:#003366;
}

.container{
    max-width:1120px;
    margin:0 auto;
    padding:0 22px;
}

.hero{
    padding:22px 0 14px;
    text-align:center;
}

.hero-badge{
    display:inline-block;
    background:#fff3cd;
    color:#8a6100;
    border:1px solid #f0d076;
    font-size:15px;
    font-weight:800;
    padding:8px 16px;
    border-radius:999px;
    margin-bottom:15px;
}

.hero h1{
    font-size:39px;
    line-height:1.05;
    margin:0 auto 12px;
    max-width:980px;
    font-weight:900;
    letter-spacing:-1.8px;
}

.hero h1 span{
    color:#f37021;
}

.hero p{
    max-width:760px;
    margin:0 auto;
    font-size:16px;
    line-height:1.45;
    color:#34465c;
}

.main-section{
    padding:16px 0 44px;
}

.main-grid{
    display:grid;
    grid-template-columns:minmax(450px, 540px) minmax(360px, 1fr);
    gap:34px;
    align-items:start;
}

.main-image{
    width:100%;
    max-width:520px;
    display:block;
    margin:0 auto;
    border-radius:12px;
    box-shadow:0 18px 38px rgba(0,0,0,.18);
}

.offer-box{
    background:#ffffff;
    border:1px solid #e1e8f0;
    border-radius:12px;
    padding:24px;
    box-shadow:0 14px 38px rgba(0,0,0,.10);
}

.offer-box h2{
    font-size:25px;
    line-height:1.15;
    margin:0 0 8px;
}

.offer-box p{
    font-size:14px;
    line-height:1.5;
    color:#34465c;
}

.price{
    background:#003366;
    color:#ffffff;
    padding:16px 18px;
    border-radius:9px;
    text-align:center;
    margin:0 0 18px;
}

.price strong{
    display:block;
    font-size:34px;
    color:#ffffff;
}

.price span{
    font-size:14px;
}

.price-bonus{
    display:block;
    margin:0 0 12px;
    padding:0 0 12px;
    border-bottom:1px solid rgba(255,255,255,.25);
    font-size:15px;
    font-weight:800;
    color:#ffd76a;
}

.top-request-copy{
    margin:0 0 14px;
}

.appointment-side{
    padding-top:4px;
}

.side-panel{
    max-width:520px;
    margin:18px auto 0;
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px;
}

.side-pill{
    background:#f5f8fb;
    border:1px solid #e1e8f0;
    border-radius:10px;
    padding:13px 14px;
    font-size:14px;
    line-height:1.35;
    color:#34465c;
}

.side-pill strong{
    display:block;
    color:#003366;
    font-size:15px;
    margin-bottom:3px;
}

.cta-button{
    display:block;
    width:100%;
    background:#f37021;
    color:#ffffff;
    text-align:center;
    text-decoration:none;
    padding:18px 24px;
    border-radius:7px;
    font-size:20px;
    font-weight:900;
}

.cta-button:hover{
    background:#d65f15;
}

.help-section{
    background:#f5f8fb;
    padding:65px 0;
}

.help-section h2{
    text-align:center;
    font-size:40px;
    margin:0 0 35px;
}

.help-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:22px;
}

.help-card{
    background:#ffffff;
    border:1px solid #e1e8f0;
    border-radius:12px;
    padding:24px;
    box-shadow:0 8px 22px rgba(0,0,0,.06);
}

.help-card h3{
    margin:0 0 10px;
    font-size:20px;
    color:#003366;
}

.help-card p{
    margin:0;
    font-size:15px;
    line-height:1.45;
    color:#405064;
}

.why-section{
    padding:65px 0;
}

.why-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:45px;
    align-items:center;
}

.why-section h2{
    font-size:40px;
    line-height:1.15;
    margin:0 0 22px;
}

.why-list{
    list-style:none;
    padding:0;
    margin:0;
}

.why-list li{
    font-size:19px;
    margin:13px 0;
    font-weight:700;
}

.why-list li::before{
    content:"\2713";
    color:#f37021;
    font-weight:900;
    margin-right:10px;
}

.secondary-image{
    width:100%;
    max-width:520px;
    display:block;
    margin:0 auto;
    border-radius:14px;
    box-shadow:0 18px 38px rgba(0,0,0,.18);
}

.final-cta{
    background:#003366;
    color:#ffffff;
    text-align:center;
    padding:60px 20px;
}

.final-cta h2{
    font-size:40px;
    margin:0 0 16px;
}

.final-cta p{
    font-size:20px;
    color:#e8eef6;
    margin:0 auto 28px;
    max-width:760px;
}

.final-cta .cta-button{
    max-width:360px;
    margin:0 auto;
}

.ls2-cta-btn{
    display:inline-block;
    background:#f37021;
    color:#fff;
    text-decoration:none;
    font-size:18px;
    font-weight:800;
    padding:16px 40px;
    border-radius:50px;
    box-shadow:0 6px 22px rgba(243,112,33,.45);
    transition:background .15s, transform .15s, box-shadow .15s;
    margin-top:8px;
}
.ls2-cta-btn:hover{
    background:#d65f15;
    color:#fff;
    transform:translateY(-2px);
    box-shadow:0 10px 28px rgba(243,112,33,.55);
}

.footer{
    background:#00264d;
    color:#ffffff;
    text-align:center;
    padding:28px 20px;
    font-size:14px;
}

.footer p{
    margin:6px 0;
}

@media(max-width:1024px){
    .hero h1{
        font-size:42px;
    }

    .hero p{
        font-size:20px;
    }

    .main-grid,
    .why-grid{
        grid-template-columns:1fr;
    }

    .help-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .offer-box{
        max-width:620px;
        margin:0 auto;
    }
}

@media(max-width:640px){
    .container{
        padding:0 18px;
    }

    .hero{
        padding:34px 0 20px;
    }

    .hero-badge{
        font-size:13px;
        padding:8px 14px;
        border-radius:14px;
    }

    .hero h1{
        font-size:31px;
        letter-spacing:-.8px;
    }

    .hero p{
        font-size:17px;
    }

    .offer-box{
        padding:24px;
    }

    .offer-box h2,
    .help-section h2,
    .why-section h2,
    .final-cta h2{
        font-size:29px;
    }

    .help-grid{
        grid-template-columns:1fr;
    }

    .price strong{
        font-size:34px;
    }

    .cta-button{
        font-size:18px;
    }
}

/* Stage 2 appointment request form */
.download-banner{
    background:#eafaf0;
    border:1px solid #b7e3c6;
    border-left:6px solid #16803c;
    color:#15672f;
    max-width:780px;
    margin:0 auto 26px;
    padding:16px 18px;
    border-radius:12px;
    font-size:16px;
    line-height:1.5;
    text-align:center;
}

.download-banner a{
    color:#0f5c2b;
    font-weight:800;
}

.rq-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px 14px;
}

.rq-grid .full{
    grid-column:1/-1;
}

.slot-strip{
    grid-column:1/-1;
    display:grid;
    grid-template-columns:repeat(2, minmax(0, 1fr));
    gap:12px;
}

.slot-card{
    background:#f7fbff;
    border:1px solid #d9e3ef;
    border-radius:8px;
    padding:10px;
}

.slot-card label{
    font-size:11px;
    margin-bottom:4px;
}

.slot-card input{
    margin-bottom:7px;
}

.slot-card input,
.slot-card select{
    padding:10px 11px;
    font-size:14px;
}

.rq-grid label{
    display:block;
    font-weight:800;
    font-size:12px;
    letter-spacing:.4px;
    text-transform:uppercase;
    color:#003366;
    margin:0 0 6px;
}

.rq-grid input,
.rq-grid select,
.rq-grid textarea{
    width:100%;
    padding:11px 12px;
    border:1px solid #cbd5df;
    border-radius:8px;
    font-size:15px;
    font-family:inherit;
    background:#ffffff;
    color:#003366;
}

.rq-grid textarea{
    min-height:90px;
    resize:vertical;
}

.rq-submit{
    display:block;
    width:100%;
    margin-top:16px;
    background:#f37021;
    color:#ffffff;
    border:none;
    padding:15px 18px;
    border-radius:8px;
    font-size:19px;
    font-weight:900;
    cursor:pointer;
}

.rq-submit:hover{
    background:#d65f15;
}

.rq-secondary{
    text-align:center;
    margin:16px 0 0;
    font-size:14px;
    color:#5a6b7e;
}

.rq-secondary a{
    color:#f37021;
    font-weight:700;
    text-decoration:none;
}

.rq-success{
    background:#e7f8ec;
    border-left:6px solid #16803c;
    color:#15672f;
    padding:18px;
    border-radius:10px;
    font-weight:700;
    line-height:1.5;
}

.rq-error{
    background:#fdeaea;
    border-left:6px solid #d71920;
    color:#9b1c1c;
    padding:14px;
    border-radius:10px;
    margin-bottom:16px;
    font-weight:700;
}

.rq-hp{
    position:absolute;
    left:-9999px;
    width:1px;
    height:1px;
    overflow:hidden;
}

@media(max-width:640px){
    .rq-grid{
        grid-template-columns:1fr;
    }

    .slot-strip{
        grid-template-columns:1fr;
    }

    .side-panel{
        grid-template-columns:1fr;
    }
}
</style>
</head>

<body id="page-top">

<section class="hero">
    <div class="container">
        <div class="hero-badge">🎁 LIMITED TIME OFFER — FREE 30-MINUTES CONSULTATION UPGRADE (valued at $75)</div>
        <h2>
            NEXT STEP:
        </h2>
        <h1>
            You've Already Received your Checklist!<br>
            <span>Have property, shares, crypto or other complex claims?</span>
            <span>Book a Free 30-Minutes Oz Tax Clarity Call</span>
        </h1>

        <p>
             If your tax return involves more than basic salary and wages, such as property, shares, crypto, capital gains or complex deductions, you may be one personalised appointment away from more clarity, a stronger refund outcome and less time spent figuring it out yourself.
        </p>

    </div>
</section>

<section class="main-section">
    <div class="container main-grid">

        <div class="offer-box">


            <h2>Request Your Oz Tax Appointment</h2>
            <p class="top-request-copy">
                Confirm your details below and Garry&rsquo;s team will call you to lock in your appointment time,
                including your <strong>FREE 30-minute consultation upgrade</strong> (valued at $75).
            </p>

            <?php if ($booked): ?>

                <div class="rq-success">
                    Thank you<?php echo $pf['firstName'] !== '' ? ', ' . ls2_h($pf['firstName']) : ''; ?>! Your appointment request has been sent to our team.
                    Our team will call you shortly to confirm your time. If it&rsquo;s urgent, call us on 1800 819 692.
                </div>

            <?php else: ?>

                <?php if ($bookError !== ''): ?>
                    <div class="rq-error"><?php echo ls2_h($bookError); ?></div>
                <?php endif; ?>

                <form method="post" action="" id="stage2-booking-form">
                    <input type="hidden" name="form" value="stage2_booking">
                    <input type="hidden" name="csrf_token" value="<?php echo ls2_h($_SESSION['csrf_token']); ?>">

                    <div class="rq-hp">
                        <label>Website</label>
                        <input type="text" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <?php // Contact details captured on the checklist page travel with the request as hidden fields (sourced from the session lead). ?>
                    <input type="hidden" name="email" value="<?php echo ls2_h($lead['email'] ?? ''); ?>">
                    <input type="hidden" name="mobile" value="<?php echo ls2_h($lead['phone'] ?? ''); ?>">
                    <input type="hidden" name="state" value="<?php echo ls2_h($lead['state'] ?? ''); ?>">
                    <input type="hidden" name="rank" value="<?php echo ls2_h($lead['rank'] ?? ''); ?>">
                    <input type="hidden" name="tax_help" value="<?php echo ls2_h($lead['tax_help'] ?? ''); ?>">

                    <div class="rq-grid">
                        <div class="full">
                            <label>First Name</label>
                            <input type="text" name="firstName" value="<?php echo ls2_h($pf['firstName']); ?>" required>
                        </div>

                        <div class="full">
                            <label>Preferred Appointment</label>
                            <select name="appointment_method">
                                <option value="">Select</option>
                                <option value="In Our Office"<?php echo ls2_sel($pf['appointment_method'], 'In Our Office'); ?>>In Our Office</option>
                                <option value="Video - Zoom / Skype"<?php echo ls2_sel($pf['appointment_method'], 'Video - Zoom / Skype'); ?>>Video - Zoom / Skype</option>
                                <option value="Phone Appointment"<?php echo ls2_sel($pf['appointment_method'], 'Phone Appointment'); ?>>Phone Appointment</option>
                            </select>
                        </div>

                        <div class="slot-strip">
                            <div class="slot-card">
                                <label>Preferred Date 1</label>
                                <input type="date" name="preferred_date_1" value="<?php echo ls2_h($pf['preferred_date_1']); ?>">
                                <label>Preferred Time 1</label>
                                <select name="preferred_time_1">
                                    <option value="">Select</option>
                                    <option value="Morning"<?php echo ls2_sel($pf['preferred_time_1'], 'Morning'); ?>>Morning</option>
                                    <option value="Midday"<?php echo ls2_sel($pf['preferred_time_1'], 'Midday'); ?>>Midday</option>
                                    <option value="Afternoon"<?php echo ls2_sel($pf['preferred_time_1'], 'Afternoon'); ?>>Afternoon</option>
                                    <option value="After 4pm"<?php echo ls2_sel($pf['preferred_time_1'], 'After 4pm'); ?>>After 4pm</option>
                                </select>
                            </div>

                            <div class="slot-card">
                                <label>Preferred Date 2</label>
                                <input type="date" name="preferred_date_2" value="<?php echo ls2_h($pf['preferred_date_2']); ?>">
                                <label>Preferred Time 2</label>
                                <select name="preferred_time_2">
                                    <option value="">Select</option>
                                    <option value="Morning"<?php echo ls2_sel($pf['preferred_time_2'], 'Morning'); ?>>Morning</option>
                                    <option value="Midday"<?php echo ls2_sel($pf['preferred_time_2'], 'Midday'); ?>>Midday</option>
                                    <option value="Afternoon"<?php echo ls2_sel($pf['preferred_time_2'], 'Afternoon'); ?>>Afternoon</option>
                                    <option value="After 4pm"<?php echo ls2_sel($pf['preferred_time_2'], 'After 4pm'); ?>>After 4pm</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="rq-submit">Request My Appointment</button>

                    <p class="rq-secondary">
                        Prefer to book yourself? <a href="<?php echo ls2_h($ls2_apponew_link); ?>">Book online here.</a>
                    </p>
                </form>

            <?php endif; ?>
        </div>

        <div class="appointment-side">
            <img src="images/GarryWithOztax.png" alt="Oz Tax appointment with Garry Angus" class="main-image">

            <div class="side-panel">
                <div class="side-pill">
                    <strong>45-minute value</strong>
                    Pay $230 and receive the extra 30-minute consultation upgrade free.
                </div>
                <div class="side-pill">
                    <strong>Australian tax focus</strong>
                    Rental property, shares, crypto, CGT, deductions and ATO questions.
                </div>
            </div>
        </div>

    </div>
</section>

<section class="help-section">
    <div class="container">
        <h2>During Your Appointment We Can Help With</h2>

        <div class="help-grid">
            <div class="help-card">
                <h3>Maximising Your Refund</h3>
                <p>Review deductions and legitimate claim areas relevant to your work.</p>
            </div>

            <div class="help-card">
                <h3>Investment Property</h3>
                <p>Rental income, interest, repairs, depreciation and property deductions.</p>
            </div>

            <div class="help-card">
                <h3>Capital Gains Tax</h3>
                <p>Property sales, shares, ETFs, managed funds and CGT events.</p>
            </div>

            <div class="help-card">
                <h3>Cryptocurrency</h3>
                <p>Crypto disposals, swaps, staking, exchanges and ATO reporting.</p>
            </div>

            <div class="help-card">
                <h3>Shares & ETFs</h3>
                <p>Dividends, franking credits, annual tax statements and portfolio records.</p>
            </div>

            <div class="help-card">
                <h3>Superannuation</h3>
                <p>Contribution strategies, unused caps, Div 293 and retirement planning.</p>
            </div>

            <div class="help-card">
                <h3>ATO Reviews</h3>
                <p>Assistance with ATO questions, amendments, reviews and objections.</p>
            </div>

            <div class="help-card">
                <h3>Work-Related Deductions</h3>
                <p>Uniforms, laundry, equipment, phone, internet, travel and work expenses.</p>
            </div>
        </div>
    </div>
</section>

<section class="why-section">
    <div class="container why-grid">

        <div>
            <h2>Why Australians Choose Oz Tax Online</h2>

            <ul class="why-list">
                <li>Over 48 years&rsquo; tax experience</li>
                <li>More than 10,000 clients assisted</li>
                <li>Specialist Australian tax knowledge</li>
                <li>Online appointments available Australia-wide</li>
                <li>Secure online document upload</li>
                <li>Electronic signing available</li>
            </ul>
        </div>

        <img src="images/WhyChooseOztaxImage.png" alt="Oz Tax Online specialist appointment" class="secondary-image">

    </div>
</section>

<section class="final-cta">
    <h2>Ready To Get Your Tax Return Sorted?</h2>
    <p>
        Book your personalised appointment with Garry Angus and get clarity before you lodge.
    </p>

    <a href="#page-top" class="ls2-cta-btn" onclick="event.preventDefault();document.getElementById('page-top').scrollIntoView({behavior:'smooth',block:'start'});">
        Request My Appointment Now
    </a>

</section>

<footer class="footer">
    <p>&copy; Oz Tax Online 2026. All Rights Reserved.</p>
    <p>Email: customerservice@oztaxonline.com.au | Phone: 1800 819 692</p>
    <p>OzTaxOnline.com.au</p>
</footer>

<?php if ($autoDownloadChecklist): ?>
<script>
fbq('track', 'Lead');   // fresh arrival from a validated Stage-1 submit, once
// Auto-start the free checklist download once on arrival from the lead page.
(function () {
    var url = <?php echo json_encode($ls2_download_link); ?>;
    var link = document.createElement('a');
    link.href = url;
    link.download = '';        // same-origin -> forces a download, not navigation
    link.rel = 'noopener';
    document.body.appendChild(link);
    link.click();
    setTimeout(function () { link.remove(); }, 1500);
})();
</script>
<?php endif; ?>

<!-- ── Sticky floating UI ── -->
<style>
#ptx-scroll-top {
    position: fixed;
    bottom: 28px;
    right: 24px;
    z-index: 1200;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: #003366;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 16px rgba(0,51,102,.35);
    opacity: 0;
    transform: translateY(12px);
    transition: opacity .25s, transform .25s, background .15s;
    pointer-events: none;
}
#ptx-scroll-top.visible {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}
#ptx-scroll-top:hover { background: #00264d; }
#ptx-scroll-top svg {
    width: 20px;
    height: 20px;
    stroke: #fff;
    stroke-width: 2.5;
    fill: none;
    stroke-linecap: round;
    stroke-linejoin: round;
}
#ptx-appt-bar {
    position: fixed;
    bottom: 28px;
    left: 24px;
    z-index: 1200;
    display: flex;
    align-items: center;
    gap: 10px;
    background: #f37021;
    color: #fff;
    border: none;
    cursor: pointer;
    padding: 13px 22px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 800;
    box-shadow: 0 4px 18px rgba(243,112,33,.40);
    text-decoration: none;
    transition: background .15s, transform .15s, box-shadow .15s;
    white-space: nowrap;
}
#ptx-appt-bar:hover {
    background: #d65f15;
    transform: translateY(-2px);
    box-shadow: 0 6px 22px rgba(243,112,33,.50);
    color: #fff;
}
#ptx-appt-bar svg {
    width: 18px;
    height: 18px;
    stroke: #fff;
    stroke-width: 2.5;
    fill: none;
    stroke-linecap: round;
    stroke-linejoin: round;
    flex-shrink: 0;
}
@media (max-width: 480px) {
    #ptx-appt-bar  { font-size: 13px; padding: 11px 16px; left: 12px; bottom: 20px; }
    #ptx-scroll-top { right: 14px; bottom: 20px; width: 42px; height: 42px; }
}
</style>

<button id="ptx-scroll-top" aria-label="Scroll to top">
    <svg viewBox="0 0 24 24" aria-hidden="true">
        <polyline points="18 15 12 9 6 15"></polyline>
    </svg>
</button>

<a id="ptx-appt-bar" href="#page-top">
    <svg viewBox="0 0 24 24" aria-hidden="true">
        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
        <line x1="16" y1="2" x2="16" y2="6"></line>
        <line x1="8" y1="2" x2="8" y2="6"></line>
        <line x1="3" y1="10" x2="21" y2="10"></line>
    </svg>
    Request an Appointment
</a>

<script>
(function () {
    var btn = document.getElementById('ptx-scroll-top');
    var bookingForm = document.getElementById('stage2-booking-form');

    if (bookingForm) {
        var slotFields = [
            bookingForm.elements.preferred_date_1,
            bookingForm.elements.preferred_time_1,
            bookingForm.elements.preferred_date_2,
            bookingForm.elements.preferred_time_2
        ];

        function clearSlotValidity() {
            slotFields.forEach(function (field) {
                if (field) {
                    field.setCustomValidity('');
                }
            });
        }

        slotFields.forEach(function (field) {
            if (field) {
                field.addEventListener('input', clearSlotValidity);
                field.addEventListener('change', clearSlotValidity);
            }
        });

        bookingForm.addEventListener('submit', function (e) {
            clearSlotValidity();

            var date1 = bookingForm.elements.preferred_date_1;
            var time1 = bookingForm.elements.preferred_time_1;
            var date2 = bookingForm.elements.preferred_date_2;
            var time2 = bookingForm.elements.preferred_time_2;
            var hasSlot1 = date1.value !== '' && time1.value !== '';
            var hasSlot2 = date2.value !== '' && time2.value !== '';
            var partial1 = (date1.value !== '') !== (time1.value !== '');
            var partial2 = (date2.value !== '') !== (time2.value !== '');
            var target = null;
            var message = '';

            if (partial1) {
                target = date1.value === '' ? date1 : time1;
                message = 'Please choose both a date and time for preferred slot 1.';
            } else if (partial2) {
                target = date2.value === '' ? date2 : time2;
                message = 'Please choose both a date and time for preferred slot 2.';
            } else if (!hasSlot1 && !hasSlot2) {
                target = date1;
                message = 'Please choose at least one preferred appointment date and time.';
            }

            if (target) {
                e.preventDefault();
                target.setCustomValidity(message);
                target.reportValidity();
            }
        });
    }

    window.addEventListener('scroll', function () {
        btn.classList.toggle('visible', window.scrollY > 300);
    }, { passive: true });
    btn.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    document.getElementById('ptx-appt-bar').addEventListener('click', function (e) {
        e.preventDefault();
        var target = document.getElementById('page-top');
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } else {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
})();
</script>

</body>
</html>
