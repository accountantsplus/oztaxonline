<?php
/*
 * Modular header — all URLs, branding and contact details come from $site.
 * Falls back to safe defaults if $site is not in scope.
 */

if (!function_exists('ptx_session_start') && file_exists(__DIR__ . '/db_connect.php')) {
    require_once __DIR__ . '/db_connect.php';
}

if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    if (function_exists('ptx_session_start')) {
        ptx_session_start();
    } else {
        session_start();
    }
}

if (!headers_sent()) {
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");
}

/* ── Base URL resolver ────────────────────────────────────────────────────── */
$ptxScriptName = str_replace("\\", "/", $_SERVER["SCRIPT_NAME"] ?? "");
$ptxBaseUrl    = "";

foreach (["services", "firebrig", "landing", "test-landing"] as $ptxSection) {
    $ptxNeedle   = "/" . $ptxSection . "/";
    $ptxPosition = strpos($ptxScriptName, $ptxNeedle);
    if ($ptxPosition !== false) {
        $ptxBaseUrl = substr($ptxScriptName, 0, $ptxPosition);
        break;
    }
}

if ($ptxBaseUrl === "" && $ptxScriptName !== "") {
    $ptxDir     = rtrim(str_replace("\\", "/", dirname($ptxScriptName)), "/");
    $ptxBaseUrl = ($ptxDir === "/" || $ptxDir === ".") ? "" : $ptxDir;
}

$ptxUrl = function ($path) use ($ptxBaseUrl) {
    if (preg_match('#^https?://#i', (string)$path)) {
        return htmlspecialchars($path, ENT_QUOTES, "UTF-8");
    }
    return htmlspecialchars($ptxBaseUrl . "/" . ltrim($path, "/"), ENT_QUOTES, "UTF-8");
};

/* ── Pull values from $site config with fallbacks ────────────────────────── */
$ptxBrand    = $site['brand']  ?? 'TradiesTaxOnline';
$ptxPhone    = $site['phone']  ?? '1800 819 692';
$ptxLogoUrl  = $ptxUrl($site['logo'] ?? 'assets/img/logo.png');

$ptxH = $site['header'] ?? [];
$ptxBookingUrl        = $ptxH['booking_url']         ?? '/booking';
$ptxExpressTaxUrl     = $ptxH['express_tax_url']     ?? '/express_tax.php';
$ptxTaxTestUrl        = $ptxH['tax_test_url']        ?? '/TaxTest.php';
$ptxContactUrl        = $ptxH['contact_url']         ?? '/contact.php';
$ptxLoginUrl          = $ptxH['login_url']           ?? null;
$ptxDashboardUrl      = $ptxH['dashboard_url']       ?? '/dashboard.php';
$ptxDownloadCentreUrl = $ptxH['download_centre_url'] ?? '/download-centre.php';
$ptxLogoutUrl         = $ptxH['logout_url']          ?? '/logout.php';

/* ── Session state ───────────────────────────────────────────────────────── */
$ptxMemberLoggedIn = !empty($_SESSION["member_logged_in"]) && $_SESSION["member_logged_in"] === true;
$ptxMemberName     = trim((string)($_SESSION["member_first_name"] ?? $_SESSION["member_name"] ?? ""));
$ptxMemberLabel    = $ptxMemberName !== "" ? $ptxMemberName : "Member";
$ptxDebugLogin     = isset($_GET["ptx_debug"]) && $_GET["ptx_debug"] === "1";

if ($ptxDebugLogin) {
    error_log("PTX DEBUG - member_logged_in raw value: " . var_export($_SESSION["member_logged_in"] ?? null, true));
    error_log("PTX DEBUG - computed logged in: " . ($ptxMemberLoggedIn ? "YES" : "NO"));
    error_log("PTX DEBUG - session id: " . session_id());
}
?>
<link rel="stylesheet" href="<?php echo $ptxUrl("header_style.css"); ?>?v=<?php echo time(); ?>">

<?php if ($ptxMemberLoggedIn): ?>
<header class="ptx-site-header ptx-member-header" id="ptxHeader">
    <div class="ptx-member-topbar">
        <div class="ptx-member-topbar-inner">
            <a href="<?php echo $ptxUrl("index.php"); ?>" class="ptx-logo ptx-member-logo" aria-label="<?php echo htmlspecialchars($ptxBrand, ENT_QUOTES, 'UTF-8'); ?> home">
                <img src="<?php echo $ptxLogoUrl; ?>" alt="<?php echo htmlspecialchars($ptxBrand, ENT_QUOTES, 'UTF-8'); ?>">
            </a>

            <a class="ptx-member-phone" href="tel:<?php echo preg_replace('/\D/', '', $ptxPhone); ?>"><?php echo htmlspecialchars($ptxPhone, ENT_QUOTES, 'UTF-8'); ?></a>

            <div class="ptx-member-actions">
                <a class="ptx-member-cta ptx-member-book" href="<?php echo $ptxUrl($ptxBookingUrl); ?>" data-ptx-open-booking>
                    <i class="ti ti-calendar-star" aria-hidden="true"></i>
                    Book With Garry
                </a>

                <a class="ptx-member-cta ptx-member-express" href="<?php echo $ptxUrl($ptxExpressTaxUrl); ?>">
                    <i class="ti ti-upload" aria-hidden="true"></i>
                    Express Tax Upload
                </a>

                <a class="ptx-member-account" href="<?php echo $ptxUrl($ptxDashboardUrl); ?>" title="<?php echo htmlspecialchars($ptxBrand, ENT_QUOTES, 'UTF-8'); ?> member dashboard" aria-label="<?php echo htmlspecialchars($ptxBrand, ENT_QUOTES, 'UTF-8'); ?> member dashboard">
                    <span class="ptx-member-account-circle">
                        <i class="ti ti-user-shield" aria-hidden="true"></i>
                    </span>
                    <span class="ptx-member-account-label">
                        <?php echo htmlspecialchars($ptxMemberLabel, ENT_QUOTES, "UTF-8"); ?>
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="ptx-member-navbar">
        <div class="ptx-member-nav-inner">
            <nav class="ptx-nav-main ptx-member-nav-main" aria-label="Member navigation">
                <a class="ptx-nav-link" href="<?php echo $ptxUrl($ptxDashboardUrl); ?>">Online Services</a>
                <a class="ptx-nav-link" href="<?php echo $ptxUrl($ptxDownloadCentreUrl); ?>">Articles</a>
                <a class="ptx-nav-link" href="<?php echo $ptxUrl($ptxBookingUrl); ?>">Appointments</a>
                <a class="ptx-nav-link" href="<?php echo $ptxUrl($ptxExpressTaxUrl); ?>">Express Tax Upload</a>
                <a class="ptx-nav-link" href="<?php echo $ptxUrl($ptxTaxTestUrl); ?>">Free Tax Health Check</a>
                <a class="ptx-nav-link" href="<?php echo $ptxUrl($ptxContactUrl); ?>">Contact</a>
                <a class="ptx-nav-link ptx-member-logout" href="<?php echo $ptxUrl($ptxLogoutUrl); ?>">Logout</a>
            </nav>
        </div>
    </div>
</header>
<?php else: ?>
<header class="ptx-site-header" id="ptxHeader">
    <div class="ptx-header-inner">
        <a class="ptx-logo" href="<?php echo $ptxUrl("index.php"); ?>" aria-label="<?php echo htmlspecialchars($ptxBrand, ENT_QUOTES, 'UTF-8'); ?> home">
            <img src="<?php echo $ptxLogoUrl; ?>" alt="<?php echo htmlspecialchars($ptxBrand, ENT_QUOTES, 'UTF-8'); ?>">
        </a>

        <button class="ptx-nav-toggle" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="ptxNavMain" data-ptx-nav-toggle>
            <span class="ptx-nav-toggle-bar"></span>
            <span class="ptx-nav-toggle-bar"></span>
            <span class="ptx-nav-toggle-bar"></span>
        </button>

        <nav class="ptx-nav-main" id="ptxNavMain" aria-label="Main navigation">
            <button class="ptx-nav-close" type="button" aria-label="Close menu" data-ptx-nav-close>
                <i class="ti ti-x" aria-hidden="true"></i>
            </button>
            <a class="ptx-nav-link" href="<?php echo $ptxUrl($ptxExpressTaxUrl); ?>">Express Tax Upload</a>
            <a class="ptx-nav-link" href="<?php echo $ptxUrl($ptxTaxTestUrl); ?>">Free Tax Health Check</a>
            <a class="ptx-nav-link" href="<?php echo $ptxUrl($ptxContactUrl); ?>">Contact</a>
            <?php if (!empty($ptxLoginUrl)): ?>
            <a class="ptx-nav-link ptx-nav-login" href="<?php echo $ptxUrl($ptxLoginUrl); ?>">Login</a>
            <?php endif; ?>
            <a class="ptx-nav-link ptx-nav-cta" href="<?php echo $ptxUrl($ptxBookingUrl); ?>" data-ptx-open-booking>Book Now</a>
        </nav>
    </div>
</header>
<?php endif; ?>

<?php if ($ptxDebugLogin): ?>
    <div style="position:fixed;top:0;left:0;right:0;z-index:99999;background:var(--blue-dark);color:#fff;padding:10px 16px;font-family:Arial,sans-serif;font-size:14px;border-bottom:4px solid var(--blue-mid);">
        <strong>LOGIN DEBUG:</strong>
        Logged in: <?php echo $ptxMemberLoggedIn ? "YES" : "NO"; ?> |
        Raw session value: <?php echo htmlspecialchars(var_export($_SESSION["member_logged_in"] ?? null, true), ENT_QUOTES, "UTF-8"); ?> |
        Session ID: <?php echo htmlspecialchars(session_id(), ENT_QUOTES, "UTF-8"); ?>
    </div>
<?php endif; ?>

<script>
function ptxHeaderScroll(){
    var header = document.querySelector(".ptx-site-header");
    if(header && !header.classList.contains("ptx-member-header")){
        header.classList.toggle("scrolled", window.scrollY > 50);
    }
}
window.addEventListener("scroll", ptxHeaderScroll);
ptxHeaderScroll();

function ptxSetMemberHeaderOffset(){
    var header = document.querySelector(".ptx-member-header");
    if(header){
        document.body.style.setProperty("padding-top", header.offsetHeight + "px", "important");
    }
}
window.addEventListener("load", ptxSetMemberHeaderOffset);
window.addEventListener("resize", ptxSetMemberHeaderOffset);
ptxSetMemberHeaderOffset();

document.addEventListener("click", function(event){
    var navToggle = event.target.closest("[data-ptx-nav-toggle]");
    if(navToggle){
        var navMain  = document.getElementById("ptxNavMain");
        var willOpen = navToggle.getAttribute("aria-expanded") !== "true";
        navToggle.setAttribute("aria-expanded", String(willOpen));
        navToggle.classList.toggle("is-open", willOpen);
        if(navMain){ navMain.classList.toggle("is-open", willOpen); }
        return;
    }

    var navClose = event.target.closest("[data-ptx-nav-close]");
    if(navClose){
        var openNav    = document.getElementById("ptxNavMain");
        var openToggle = document.querySelector("[data-ptx-nav-toggle]");
        if(openNav){ openNav.classList.remove("is-open"); }
        if(openToggle){ openToggle.classList.remove("is-open"); openToggle.setAttribute("aria-expanded", "false"); }
        return;
    }

    if(event.target.closest(".ptx-nav-main .ptx-nav-link")){
        var openNav    = document.getElementById("ptxNavMain");
        var openToggle = document.querySelector("[data-ptx-nav-toggle]");
        if(openNav){ openNav.classList.remove("is-open"); }
        if(openToggle){ openToggle.classList.remove("is-open"); openToggle.setAttribute("aria-expanded", "false"); }
    }
});
</script>

<?php
/* ── Booking modal — content driven by $site ─────────────────────────────── */
$ptxPhoneSafe  = htmlspecialchars($ptxPhone, ENT_QUOTES, 'UTF-8');
$ptxPhoneTel   = 'tel:' . preg_replace('/\D/', '', $ptxPhone);
?>
<div class="ptx-bk-overlay" id="ptxBookingModal" role="dialog" aria-modal="true" aria-labelledby="ptxBkTitle" aria-hidden="true">
    <div class="ptx-bk-dialog">
        <button class="ptx-bk-close" type="button" data-ptx-close-booking aria-label="Close booking options">×</button>

        <div class="ptx-bk-head">
            <span class="ptx-bk-eyebrow"><i class="ti ti-calendar-star" aria-hidden="true"></i> Book with Garry Angus</span>
            <h2 id="ptxBkTitle">How would you like to book?</h2>
            <p>Pick the option that suits you best: book instantly online, call us, or tell us the times that fit your roster.</p>
        </div>

        <div class="ptx-bk-options">
            <a class="ptx-bk-option" href="<?php echo $ptxUrl($ptxBookingUrl); ?>"
               data-ptx-tip="Pick an available date and time instantly from our live calendar."
               title="Pick an available date and time instantly from our live calendar.">
                <span class="ptx-bk-ico"><i class="ti ti-calendar-check" aria-hidden="true"></i></span>
                <span class="ptx-bk-text">
                    <strong>Book online</strong>
                    <small>Choose a time instantly from our live booking calendar.</small>
                </span>
                <i class="ti ti-arrow-right ptx-bk-arrow" aria-hidden="true"></i>
            </a>

            <a class="ptx-bk-option ptx-bk-option--call" href="<?php echo $ptxPhoneTel; ?>"
               data-ptx-tip="Speak with our team now on <?php echo $ptxPhoneSafe; ?>."
               title="Speak with our team now on <?php echo $ptxPhoneSafe; ?>.">
                <span class="ptx-bk-ico"><i class="ti ti-phone" aria-hidden="true"></i></span>
                <span class="ptx-bk-text">
                    <strong>Call now — <?php echo $ptxPhoneSafe; ?></strong>
                    <small>Speak directly with our team during business hours.</small>
                </span>
                <i class="ti ti-arrow-right ptx-bk-arrow" aria-hidden="true"></i>
            </a>

            <a class="ptx-bk-option" href="<?php echo $ptxUrl($ptxBookingUrl); ?>"
               data-ptx-tip="Tell us your preferred times and we'll arrange an appointment around your shifts."
               title="Tell us your preferred times and we'll arrange an appointment around your shifts.">
                <span class="ptx-bk-ico"><i class="ti ti-calendar-plus" aria-hidden="true"></i></span>
                <span class="ptx-bk-text">
                    <strong>Suggest an appointment</strong>
                    <small>Tell us times that fit your roster and we'll arrange it.</small>
                </span>
                <i class="ti ti-arrow-right ptx-bk-arrow" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</div>

<script>
(function(){
    var modal = document.getElementById("ptxBookingModal");
    if(!modal) return;
    var lastFocus = null;

    function openBooking(trigger){
        lastFocus = trigger || null;
        modal.classList.add("is-open");
        modal.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";
        var first = modal.querySelector(".ptx-bk-option");
        if(first){ first.focus(); }
    }

    function closeBooking(){
        modal.classList.remove("is-open");
        modal.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
        if(lastFocus && typeof lastFocus.focus === "function"){ lastFocus.focus(); }
    }

    document.addEventListener("click", function(event){
        var opener = event.target.closest("[data-ptx-open-booking]");
        if(opener){ event.preventDefault(); openBooking(opener); return; }
        if(event.target.closest("[data-ptx-close-booking]")){ event.preventDefault(); closeBooking(); return; }
        if(event.target === modal){ closeBooking(); }
    });

    document.addEventListener("keydown", function(event){
        if(event.key === "Escape" && modal.classList.contains("is-open")){ closeBooking(); }
    });
})();
</script>