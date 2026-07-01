<?php
// checklists-download-free-copy-now.php
// Stage 1 Landing Page (Oz Tax Online) — Checklist Download + Autoresponder Email.
// Cloned from PoliceTax/AmbosTax, rebranded for general Australian taxpayers. brand = 'oztax'.
// Uses the shared PDO connection and PHP mail().

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/db_connect.php';
ptx_session_start();

$success = '';
$error = '';

$occupation = 'Individual';

$downloadLink = 'https://www.oztaxonline.com.au/downloads/oz-tax-refund-checklist.pdf';
$bookingLink  = 'https://www.oztaxonline.com.au/consultation-booking-call.php#download-free-copy-now';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function clean_input($value) {
    return htmlspecialchars(trim($value ?? ''), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first_name = clean_input($_POST['first_name'] ?? '');
    $email      = clean_input($_POST['email'] ?? '');
    $phone      = clean_input($_POST['phone'] ?? '');
    $state      = clean_input($_POST['state'] ?? '');
    $rank       = clean_input($_POST['rank'] ?? '');
    $tax_help   = clean_input($_POST['tax_help'] ?? '');
    $honeypot   = trim($_POST['website'] ?? '');
    $csrf_token = $_POST['csrf_token'] ?? '';

    $valid_states = ['ACT', 'NSW', 'NT', 'QLD', 'SA', 'TAS', 'VIC', 'WA'];

    if ($honeypot !== '') {
        $error = 'Spam detected.';
    } elseif (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        $error = 'Security token expired. Please refresh and try again.';
    } elseif ($first_name === '' || $email === '' || $phone === '' || $state === '' || $rank === '' || $tax_help === '') {
        $error = 'Please complete all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (!in_array($state, $valid_states, true)) {
        $error = 'Please select a valid Australian state or territory.';
    } else {

        $ip_address = substr((string)($_SERVER['REMOTE_ADDR'] ?? ''), 0, 45);
        $user_agent = substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 512);
        $lead_id = null;

        try {
            $pdo = ptx_db();
            $insert = $pdo->prepare(
                'INSERT INTO ea_checklist_leads
                    (first_name, email, phone, state, occupation, brand, role, tax_help, ip_address, user_agent)
                 VALUES
                    (:first_name, :email, :phone, :state, :occupation, :brand, :role, :tax_help, :ip_address, :user_agent)'
            );
            $insert->execute([
                ':first_name'  => $first_name,
                ':email'       => $email,
                ':phone'       => $phone,
                ':state'       => $state,
                ':occupation'  => $occupation,
                ':brand'       => 'oztax',
                ':role'        => $rank,
                ':tax_help'    => $tax_help,
                ':ip_address'  => $ip_address !== '' ? $ip_address : null,
                ':user_agent'  => $user_agent !== '' ? $user_agent : null,
            ]);
            $lead_id = (int)$pdo->lastInsertId();
        } catch (Throwable $db_error) {
            error_log('Oz Tax checklist lead database error: ' . $db_error->getMessage());

            $db_message = $db_error->getMessage();
            if (stripos($db_message, 'Base table or view not found') !== false) {
                $error = 'The checklist leads database table has not been installed.';
            } elseif (stripos($db_message, 'Access denied') !== false) {
                $error = 'The website database account does not have permission to save checklist leads.';
            } elseif (stripos($db_message, 'could not find driver') !== false) {
                $error = 'The server PHP PDO MySQL driver is not enabled.';
            } else {
                $error = 'We could not save your details. Please try again shortly.';
            }
        }

        if ($error === '') {

        /*
        |--------------------------------------------------------------------------
        | ADMIN EMAIL (internal notification)
        |--------------------------------------------------------------------------
        */

        $admin_to = 'crm@policetax.com.au';
        $admin_subject = "NEW Oz Tax Checklist Download - {$first_name}";

        $admin_message = "
New Oz Tax Checklist Lead

Name: {$first_name}
Email: {$email}
Phone: {$phone}
State/Territory: {$state}
Occupation: {$occupation}
Describes Them: {$rank}
Needs Help With: {$tax_help}

Checklist Download Link:
{$downloadLink}

Booking Link:
{$bookingLink}

IP Address: " . ($_SERVER['REMOTE_ADDR'] ?? '') . "
Date: " . date('d/m/Y H:i') . "
";

        $admin_headers  = "From: Oz Tax Online <customerservice@accountantsplus.com.au>\r\n";
        $admin_headers .= "Reply-To: {$email}\r\n";
        // TODO(TEST): remove smanvendra733@gmail.com once email delivery is confirmed.
        $admin_headers .= "Bcc: smanvendra733@gmail.com\r\n";
        $admin_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        $admin_sent = mail($admin_to, $admin_subject, $admin_message, $admin_headers);


        /*
        |--------------------------------------------------------------------------
        | CLIENT AUTORESPONDER EMAIL
        |--------------------------------------------------------------------------
        */

        $client_subject = 'Your FREE Oz Tax Refund Checklist';

        $client_message = "
Hi {$first_name},

Thank you for requesting your FREE Oz Tax Refund Checklist.

You can download your copy by clicking the link below:

{$downloadLink}

This checklist has been designed to help everyday Australian taxpayers to:

- Identify the key work-related and personal deductions commonly available.
- Avoid some of the most common tax mistakes we see every tax season.
- Understand the records you'll need to support your claims.
- Prepare your tax return with greater confidence.

Whether you prepare your own return or work with us, we hope this guide helps you maximise your refund and minimise the stress at tax time.

If your tax affairs are more complex — such as investment properties, shares, cryptocurrency, capital gains tax, superannuation strategies or an ATO review — you can also book a personalised appointment with Garry Angus, a specialist in Australian tax returns.

Book your appointment here:
{$bookingLink}

If you have any questions, simply reply to this email and we'll be happy to help.

Kind regards,

The Oz Tax Online Team
Specialists in Australian Tax Returns

https://www.oztaxonline.com.au

P.S. Every year we see Australians miss legitimate deductions simply because they didn't know they could claim them. Before lodging your return, take five minutes to work through the checklist — you may be surprised by what you discover.
";

        $client_headers  = "From: Oz Tax Online <customerservice@accountantsplus.com.au>\r\n";
        $client_headers .= "Reply-To: customerservice@accountantsplus.com.au\r\n";
        $client_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        $client_sent = mail($email, $client_subject, $client_message, $client_headers);

        try {
            $update = $pdo->prepare(
                'UPDATE ea_checklist_leads
                    SET admin_email_sent = :admin_email_sent,
                        client_email_sent = :client_email_sent
                  WHERE id = :id'
            );
            $update->execute([
                ':admin_email_sent'  => $admin_sent ? 1 : 0,
                ':client_email_sent' => $client_sent ? 1 : 0,
                ':id'                => $lead_id,
            ]);
        } catch (Throwable $db_error) {
            error_log('Oz Tax checklist email-status update error: ' . $db_error->getMessage());
        }


        /*
        |--------------------------------------------------------------------------
        | RESULT
        |--------------------------------------------------------------------------
        */

        // Carry the captured lead into Stage 2 (consultation-booking-call.php)
        // so the appointment-request form arrives pre-filled, then send them
        // there. ptx_download_checklist makes Stage 2 auto-start the PDF download.
        $_SESSION['ptx_lead'] = [
            'lead_id'    => $lead_id,
            'first_name' => $first_name,
            'email'      => $email,
            'phone'      => $phone,
            'state'      => $state,
            'rank'       => $rank,
            'tax_help'   => $tax_help,
        ];
        $_SESSION['ptx_download_checklist'] = true;
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        header('Location: consultation-booking-call.php#download-free-copy-now');
        exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en-AU">
<head>
<meta charset="UTF-8">

<title>Oz Tax Refund Checklist | Download Free Copy</title>
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
    max-width:1180px;
    margin:0 auto;
    padding:0 22px;
}

.hero{
    background:#ffffff;
    padding:45px 0 20px;
    text-align:center;
}

.pre-headline{
    font-size:18px;
    font-weight:800;
    color:#003366;
    margin-bottom:18px;
    text-align:center;
}

.hero h1{
    margin:0 auto;
    max-width:980px;
    text-align:center;
    font-size:56px;
    line-height:1.04;
    letter-spacing:-2px;
    font-weight:900;
    color:#003366;
}

.hero h1 span{
    color:#f37021;
}

.hero p{
    max-width:900px;
    margin:22px auto 0;
    text-align:center;
    font-size:23px;
    line-height:1.45;
    color:#36475d;
}

.main-section{
    background:#ffffff;
    padding:28px 0 48px;
}

.main-grid{
    display:grid;
    grid-template-columns:1fr 430px;
    gap:48px;
    align-items:center;
}

.checklist-image{
    display:block;
    width:100%;
    max-width:650px;
    height:auto;
    margin:0 auto;
    background:transparent!important;
    border:none!important;
    box-shadow:none!important;
    padding:0!important;
    filter:drop-shadow(0 18px 30px rgba(0,0,0,.25));
}

.form-card{
    background:#ffffff;
    border:1px solid #e2e7ee;
    border-radius:12px;
    padding:30px;
    box-shadow:0 12px 35px rgba(0,0,0,.10);
    text-align:left;
}

.form-card h2{
    margin:0 0 8px;
    font-size:28px;
    line-height:1.15;
    color:#003366;
    text-align:center;
}

.form-card p{
    margin:0 0 22px;
    font-size:16px;
    line-height:1.45;
    color:#405064;
    text-align:center;
}

label{
    display:block;
    font-weight:800;
    margin:13px 0 5px;
    font-size:14px;
    color:#003366;
}

input,select{
    width:100%;
    height:46px;
    padding:10px 13px;
    font-size:15px;
    border:1px solid #cbd5df;
    border-radius:5px;
    background:#ffffff;
}

button{
    width:100%;
    margin-top:22px;
    background:#f37021;
    color:#ffffff;
    border:none;
    padding:17px 18px;
    font-size:18px;
    font-weight:900;
    border-radius:6px;
    cursor:pointer;
}

button:hover{
    background:#d65f15;
}

.hidden-field{
    display:none;
}

.success{
    background:#e7f8ec;
    color:#186a32;
    padding:12px;
    border-radius:5px;
    margin-bottom:15px;
    font-weight:700;
}

.error{
    background:#fdeaea;
    color:#9b1c1c;
    padding:12px;
    border-radius:5px;
    margin-bottom:15px;
    font-weight:700;
}

.reviews-section{
    background:#ffffff;
    padding:35px 0 70px;
    text-align:center;
}

.reviews-section h2{
    max-width:960px;
    margin:0 auto 34px;
    font-size:34px;
    line-height:1.2;
    font-weight:900;
    color:#003366;
}

.image-reviews{
    max-width:1180px;
    margin:0 auto;
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:24px;
}

.image-reviews img{
    width:100%;
    height:auto;
    display:block;
    background:transparent!important;
    border:none!important;
    box-shadow:none!important;
    padding:0!important;
    margin:0!important;
}

.final-cta{
    background:#003366;
    color:#ffffff;
    padding:45px 20px;
    text-align:center;
}

.final-cta h2{
    margin:0 0 18px;
    font-size:34px;
    line-height:1.15;
}

.cta-button{
    display:inline-block;
    background:#f37021;
    color:#ffffff;
    text-decoration:none;
    padding:17px 28px;
    border-radius:6px;
    font-size:19px;
    font-weight:900;
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
    .container{
        max-width:94%;
        padding:0 20px;
    }

    .hero h1{
        font-size:42px;
        line-height:1.08;
        letter-spacing:-1.2px;
    }

    .hero p{
        font-size:20px;
    }

    .main-grid{
        grid-template-columns:1fr;
        gap:24px;
    }

    .checklist-image{
        max-width:620px;
    }

    .form-card{
        max-width:560px;
        margin:0 auto;
    }

    .image-reviews{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:640px){
    .container{
        max-width:100%;
        padding:0 18px;
    }

    .hero{
        padding:28px 0 12px;
    }

    .pre-headline{
        font-size:16px;
    }

    .hero h1{
        font-size:30px;
        line-height:1.12;
        letter-spacing:-.8px;
    }

    .hero h1 br{
        display:none;
    }

    .hero p{
        font-size:17px;
        line-height:1.45;
        margin-top:16px;
    }

    .main-section{
        padding:18px 0 38px;
    }

    .checklist-image{
        max-width:100%;
        margin-bottom:12px;
    }

    .form-card{
        padding:22px;
        border-radius:10px;
    }

    .form-card h2{
        font-size:25px;
    }

    input,select{
        height:48px;
        font-size:16px;
    }

    button{
        font-size:17px;
        padding:16px;
    }

    .reviews-section h2{
        font-size:28px;
    }

    .image-reviews{
        grid-template-columns:1fr;
        gap:18px;
    }

    .final-cta h2{
        font-size:28px;
    }

    .cta-button{
        width:100%;
        max-width:360px;
    }
}
</style>
</head>

<body>

<section class="hero">
    <div class="container">
        <div class="pre-headline">Calling all Australian taxpayers...</div>

        <h1>
            Don't Leave Your Refund To Guesswork.<br>
            Join Thousands Of Australians Who Have<br>
            Taken The Stress Out Of <span>Tax Returns</span>.
        </h1>

        <p>
            Get the FREE Oz Tax Refund Checklist and see the KEY claim areas and common MISTAKES to be aware of before you lodge.
        </p>
    </div>
</section>

<section class="main-section" id="download-free-copy-now">
    <div class="container main-grid">

        <img src="images/OztaxonlineChecklistDownload.png" alt="Oz Tax Refund Checklist" class="checklist-image">

        <div class="form-card">
            <h2>Download Your Free Copy Now</h2>
            <p>Enter your details below and we&rsquo;ll send you the checklist guide.</p>

            <?php if ($success): ?>
                <div class="success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="post" action="#download-free-copy-now">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                <input type="hidden" name="occupation" value="Individual">

                <div class="hidden-field">
                    <label>Website</label>
                    <input type="text" name="website">
                </div>

                <label>First name:</label>
                <input type="text" name="first_name" required>

                <label>Email Address:</label>
                <input type="email" name="email" required>

                <label>Phone Number:</label>
                <input type="tel" name="phone" required>

                <label>Which state or territory are you from?</label>
                <select name="state" required>
                    <option value="">Please select&hellip;</option>
                    <option value="ACT">Australian Capital Territory (ACT)</option>
                    <option value="NSW">New South Wales (NSW)</option>
                    <option value="NT">Northern Territory (NT)</option>
                    <option value="QLD">Queensland (QLD)</option>
                    <option value="SA">South Australia (SA)</option>
                    <option value="TAS">Tasmania (TAS)</option>
                    <option value="VIC">Victoria (VIC)</option>
                    <option value="WA">Western Australia (WA)</option>
                </select>

                <label>What best describes you?</label>
                <select name="rank" required>
                    <option value="">Please select&hellip;</option>
                    <option>Employee (PAYG / Salary &amp; Wages)</option>
                    <option>Sole Trader / Contractor</option>
                    <option>Small Business Owner</option>
                    <option>Investor (Property / Shares)</option>
                    <option>Retiree</option>
                    <option>Student</option>
                    <option>Other</option>
                </select>

                <label>What would you like help with in your tax return?</label>
                <select name="tax_help" required>
                    <option value="">Please select&hellip;</option>
                    <option>Salary and Wages</option>
                    <option>Overtime, Allowances or Shift Work</option>
                    <option>Work-Related Expenses</option>
                    <option>Investment Property</option>
                    <option>Land or Property Sale</option>
                    <option>Cryptocurrency</option>
                    <option>Shares, ETFs or Managed Funds</option>
                    <option>Rental Income</option>
                    <option>Capital Gains Tax (CGT)</option>
                    <option>Sole Trader / Side Income</option>
                    <option>Other&hellip;</option>
                </select>

                <button type="submit">Download Your Free Copy Now</button>
            </form>
        </div>

    </div>
</section>

<section class="reviews-section">
    <div class="container">
        <h2>What Our Clients Are Saying</h2>

        <!-- ponytail: placeholder review images (PoliceTax-hosted), swap for Oz Tax reviews when ready -->
        <div class="image-reviews">
            <img src="https://www.policetax.com.au/images/Google1.png" alt="Google review">
            <img src="https://www.policetax.com.au/images/Google2.png" alt="Google review">
            <img src="https://www.policetax.com.au/images/Google3.png" alt="Google review">
            <img src="https://www.policetax.com.au/images/Google4.png" alt="Google review">
            <img src="https://www.policetax.com.au/images/Google5.png" alt="Google review">
            <img src="https://www.policetax.com.au/images/ScreenHunter%201981.png" alt="Google review">
        </div>
    </div>
</section>

<section class="final-cta">
    <h2>Download Your FREE Oz Tax Refund Checklist</h2>
    <a class="cta-button" href="#download-free-copy-now">Download Your Free Copy Now</a>
</section>

<footer class="footer">
    <p>&copy; Oz Tax Online 2026. All Rights Reserved.</p>
    <p>Email: customerservice@oztaxonline.com.au | Phone: 1800 819 692</p>
    <p>OzTaxOnline.com.au</p>
</footer>

</body>
</html>
