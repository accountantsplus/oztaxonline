<?php
/*
 * Modular footer — all content comes from $site['footer'].
 * All colours reference the main page's CSS custom properties
 * (--blue-dark, --blue-mid, --hero-highlight, --border, etc.)
 * so changing $site['theme'] automatically re-themes the footer.
 */
$f  = $site['footer'] ?? [];
$fe = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
?>
<style>
/* ── Footer — uses main page theme variables, no local overrides ─────────── */
.ptx-modern-footer,
.ptx-modern-footer *{ box-sizing:border-box; }

.ptx-modern-footer{
    width:100%;
    background:#fff;
    border-top:5px solid var(--blue-dark);
    color:var(--blue-dark);
    font-family:"IBM Plex Sans", Arial, Helvetica, sans-serif;
    font-size:15px;
}

.ptx-modern-footer a{ color:inherit; text-decoration:none; }

.ptx-footer-shell{ max-width:1180px; margin:0 auto; padding:0 22px; }

/* Top brand bar */
.ptx-footer-top{
    display:grid;
    grid-template-columns:0.9fr 1.7fr 0.8fr;
    gap:28px;
    align-items:center;
    padding:24px 0;
    border-bottom:1px solid var(--border);
}

.ptx-modern-footer .ptx-logo{ display:inline-flex; flex-direction:column; align-items:flex-start; gap:8px; }
.ptx-modern-footer .ptx-logo img{ display:block; height:56px; width:auto; object-fit:contain; }

.ptx-logo-subtitle{
    color:var(--blue-mid);
    font-size:12px;
    font-weight:600;
    letter-spacing:.04em;
    text-transform:uppercase;
}

.ptx-positioning{ display:flex; gap:16px; align-items:center; }

.ptx-shield{
    width:52px; height:52px; min-width:52px;
    border:2px solid var(--blue-dark);
    border-radius:14px;
    display:flex; align-items:center; justify-content:center;
    color:var(--blue-mid);
    background:#fff;
    font-size:26px; font-weight:900;
    box-shadow:0 8px 18px rgba(0,48,73,.08);
}

.ptx-positioning h2{
    color:var(--blue-dark);
    font-size:clamp(18px,1.7vw,24px);
    font-weight:700; line-height:1.25; margin:0;
    text-transform:uppercase; letter-spacing:-.01em;
}

.ptx-positioning p{ color:var(--text-body); margin:7px 0 0; font-size:14px; line-height:1.5; }

.ptx-call{ text-align:right; }
.ptx-call span{ display:block; color:var(--text-body); font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:.05em; }
.ptx-call strong{ display:block; color:var(--blue-mid); font-size:clamp(24px,2.2vw,30px); font-weight:700; line-height:1; margin-top:8px; white-space:nowrap; }

/* Main 3-column grid */
.ptx-footer-main{
    display:grid;
    grid-template-columns:1.05fr 0.85fr 1.05fr;
    gap:22px;
    padding:26px 0 24px;
}

.ptx-footer-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:18px;
    padding:22px;
    box-shadow:0 10px 26px rgba(0,48,73,.045);
}

.ptx-footer-card h3{
    color:var(--blue-dark);
    font-size:18px; font-weight:700; line-height:1.2;
    margin:0 0 18px;
    text-transform:uppercase; letter-spacing:.02em;
}

.ptx-footer-card h3::after{
    content:"";
    width:52px; height:3px;
    background:var(--blue-mid);
    display:block; margin-top:10px; border-radius:999px;
}

/* Service rows */
.ptx-service{
    display:grid;
    grid-template-columns:36px 1fr auto;
    gap:13px; align-items:center;
    padding:16px 0;
    border-bottom:1px solid var(--border);
    transition:transform .2s ease;
}
.ptx-service:last-child{ border-bottom:none; padding-bottom:0; }
.ptx-service:hover{ transform:translateX(3px); }

.ptx-number{
    width:32px; height:32px;
    background:var(--blue-mid); color:#fff;
    border-radius:50%;
    display:flex; justify-content:center; align-items:center;
    font-size:14px; font-weight:900;
}

.ptx-service-text strong{ display:block; color:var(--blue-dark); font-size:17px; font-weight:700; line-height:1.15; }
.ptx-service-text em{ display:block; color:var(--blue-mid); font-style:normal; font-size:13px; font-weight:600; margin:5px 0; }
.ptx-service-text p{ color:var(--text-body); font-size:13px; line-height:1.5; margin:0; }
.ptx-price{ color:var(--blue-dark); font-size:22px; font-weight:700; white-space:nowrap; }

/* Quick links */
.ptx-quick-link{
    display:flex; align-items:center; justify-content:space-between;
    gap:14px; padding:14px 0;
    border-bottom:1px solid var(--border);
    color:var(--blue-dark);
    font-size:15px; font-weight:600;
    transition:color .2s ease, transform .2s ease;
}
.ptx-quick-link:last-child{ border-bottom:none; padding-bottom:0; }
.ptx-quick-link::after{ content:"›"; color:var(--blue-mid); font-size:24px; line-height:1; }
.ptx-quick-link:hover{ color:var(--blue-mid); transform:translateX(3px); }

/* Image CTA card */
.ptx-footer-image-card{ position:relative; overflow:hidden; min-height:290px; padding:0; }
.ptx-footer-image-card img{ width:100%; height:290px; object-fit:cover; object-position:center; display:block; background:var(--surface); }

.ptx-soft-cta{
    position:absolute; left:18px; right:18px; bottom:18px;
    background:rgba(255,255,255,.96);
    border:2px solid var(--blue-mid);
    border-radius:14px; padding:16px 18px;
    box-shadow:0 12px 28px rgba(0,0,0,.16);
    transition:transform .2s ease, box-shadow .2s ease;
}
.ptx-soft-cta:hover{ transform:translateY(-3px); box-shadow:0 16px 32px rgba(0,0,0,.2); }
.ptx-soft-cta strong{ display:block; color:var(--blue-mid); font-size:18px; font-weight:700; text-transform:uppercase; line-height:1.15; }
.ptx-soft-cta p{ color:var(--blue-dark); margin:7px 0 0; font-size:13px; line-height:1.4; }

/* Review strip */
.ptx-review-strip{
    border:1px solid var(--border);
    border-radius:18px; padding:20px 22px;
    display:grid; grid-template-columns:1.15fr 1fr auto;
    gap:24px; align-items:center;
    background:linear-gradient(180deg, #fff 0%, var(--surface) 100%);
    margin-bottom:24px;
    box-shadow:0 10px 26px rgba(0,48,73,.045);
}
.ptx-review-strip strong{ display:block; color:var(--blue-dark); font-size:15px; font-weight:700; text-transform:uppercase; letter-spacing:.02em; }
.ptx-review-strip p{ color:var(--text-body); margin:6px 0 0; font-size:13.5px; line-height:1.45; }

.ptx-stars{ color:var(--hero-highlight); font-weight:900; letter-spacing:2px; }

.ptx-google-btn{
    border:2px solid var(--blue-mid);
    border-radius:12px; padding:13px 18px;
    font-size:13px; font-weight:700;
    color:var(--blue-dark) !important;
    white-space:nowrap;
    transition:background .2s ease, color .2s ease, transform .2s ease;
}
.ptx-google-btn:hover{ background:var(--blue-mid); color:#fff !important; transform:translateY(-2px); }

/* Legal bar */
.ptx-legal{
    display:flex; justify-content:center; flex-wrap:wrap;
    gap:0; padding:20px 0;
    border-top:1px solid var(--border);
    border-bottom:1px solid var(--border);
    font-size:13px; background:#fff; text-align:center;
}
.ptx-legal span,
.ptx-legal a{ color:var(--text-body); padding:0 17px; border-right:1px solid rgba(247,127,0,.45); }
.ptx-legal span:last-child,
.ptx-legal a:last-child{ border-right:none; }
.ptx-legal a:hover{ color:var(--blue-mid); text-decoration:underline; text-underline-offset:4px; }

/* Office bar */
.ptx-office{
    background:var(--blue-dark); color:#fff;
    text-align:center; padding:14px 22px;
    font-size:13.5px; font-weight:500; line-height:1.6;
}
.ptx-office strong{ color:#fff; text-transform:uppercase; margin-right:5px; }
.ptx-office a{ color:var(--hero-highlight); font-weight:800; }

/* Responsive */
@media(max-width:1040px){
    .ptx-footer-top,
    .ptx-footer-main,
    .ptx-review-strip{ grid-template-columns:1fr; }
    .ptx-footer-top{ align-items:flex-start; }
    .ptx-call{ text-align:left; }
    .ptx-review-strip{ align-items:flex-start; }
    .ptx-google-btn{ width:max-content; }
}

@media(max-width:680px){
    .ptx-footer-shell{ padding:0 18px; }
    .ptx-footer-top{ padding:24px 0; gap:22px; }
    .ptx-modern-footer .ptx-logo img{ height:48px; }
    .ptx-positioning{ align-items:flex-start; }
    .ptx-shield{ width:46px; height:46px; min-width:46px; font-size:22px; }
    .ptx-positioning h2{ font-size:18px; }
    .ptx-call strong{ font-size:26px; }
    .ptx-footer-main{ padding-top:22px; gap:18px; }
    .ptx-footer-card{ padding:20px; border-radius:15px; }
    .ptx-footer-card h3{ font-size:17px; }
    .ptx-service{ grid-template-columns:34px 1fr; align-items:flex-start; }
    .ptx-price{ grid-column:2; font-size:20px; margin-top:4px; }
    .ptx-service-text strong{ font-size:16px; }
    .ptx-footer-image-card img{ height:250px; }
    .ptx-soft-cta{ position:static; margin:14px; }
    .ptx-quick-link{ font-size:14.5px; }
    .ptx-legal{ flex-direction:column; gap:9px; }
    .ptx-legal span, .ptx-legal a{ border-right:none; padding:0; }
    .ptx-office span{ display:block; }
    .ptx-office span:nth-child(2){ display:none; }
}
</style>

<footer class="ptx-modern-footer">
    <div class="ptx-footer-shell">

        <!-- Top brand bar -->
        <div class="ptx-footer-top">
            <a href="/index.php" class="ptx-logo" aria-label="<?php echo $fe($site['brand'] ?? 'Home'); ?> home">
                <img src="<?php echo $fe($site['logo'] ?? 'assets/img/logo.png'); ?>" alt="<?php echo $fe($site['brand'] ?? ''); ?> logo">
                <small class="ptx-logo-subtitle"><?php echo $fe($f['tagline'] ?? ''); ?></small>
            </a>

            <div class="ptx-positioning">
                <div class="ptx-shield" aria-hidden="true">✓</div>
                <div>
                    <h2><?php echo $fe($f['positioning_heading'] ?? ''); ?></h2>
                    <p><?php echo $fe($f['positioning_body'] ?? ''); ?></p>
                </div>
            </div>

            <div class="ptx-call">
                <span>Need help?</span>
                <a href="tel:<?php echo preg_replace('/\D/', '', $site['phone'] ?? ''); ?>">
                    <strong><?php echo $fe($site['phone'] ?? ''); ?></strong>
                </a>
            </div>
        </div>

        <!-- 3-column main grid -->
        <div class="ptx-footer-main">

            <!-- Services card -->
            <div class="ptx-footer-card">
                <h3>How We Can Help</h3>
                <?php foreach (($f['services'] ?? []) as $i => $svc): ?>
                <a href="<?php echo $fe($svc['url'] ?? '#'); ?>" class="ptx-service">
                    <div class="ptx-number"><?php echo $i + 1; ?></div>
                    <div class="ptx-service-text">
                        <strong><?php echo $fe($svc['title'] ?? ''); ?></strong>
                        <em><?php echo $fe($svc['note'] ?? ''); ?></em>
                        <p><?php echo $fe($svc['desc'] ?? ''); ?></p>
                    </div>
                    <div class="ptx-price"><?php echo $fe($svc['price'] ?? ''); ?></div>
                </a>
                <?php endforeach; ?>
            </div>

            <!-- Quick links card -->
            <div class="ptx-footer-card">
                <h3><?php echo $fe($f['quick_links_heading'] ?? 'Members'); ?></h3>
                <?php foreach (($f['quick_links'] ?? []) as $ql): ?>
                <a href="<?php echo $fe($ql['url'] ?? '#'); ?>" class="ptx-quick-link"><?php echo $fe($ql['label'] ?? ''); ?></a>
                <?php endforeach; ?>
            </div>

            <!-- Image CTA card -->
            <div class="ptx-footer-card ptx-footer-image-card">
                <img src="<?php echo $fe($f['cta_image'] ?? ''); ?>" alt="<?php echo $fe($site['brand'] ?? ''); ?> tax support">
                <a href="<?php echo $fe($f['cta_url'] ?? '#'); ?>" class="ptx-soft-cta">
                    <strong><?php echo $fe($f['cta_label'] ?? ''); ?></strong>
                    <p><?php echo $fe($f['cta_body'] ?? ''); ?></p>
                </a>
            </div>

        </div>

        <!-- Review strip -->
        <div class="ptx-review-strip">
            <div>
                <strong><?php echo $fe($f['review_heading'] ?? ''); ?></strong>
                <p><?php echo $fe($f['review_body'] ?? ''); ?></p>
            </div>
            <div>
                <strong>Leave Us a Google Review</strong>
                <p><span class="ptx-stars">★★★★★</span> Your feedback helps other clients find us.</p>
            </div>
            <a href="<?php echo $fe($f['google_review_url'] ?? '#'); ?>" class="ptx-google-btn" target="_blank" rel="noopener">
                Review Us on Google →
            </a>
        </div>

        <!-- Legal bar -->
        <div class="ptx-legal">
            <?php foreach (($f['legal'] ?? []) as $item): ?>
                <?php if (($item['type'] ?? '') === 'link'): ?>
                    <a href="<?php echo $fe($item['url'] ?? '#'); ?>"><?php echo $item['label'] ?? ''; ?></a>
                <?php else: ?>
                    <span><?php echo $fe($item['label'] ?? ''); ?></span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

    </div>

    <!-- Office bar -->
    <div class="ptx-office">
        <span><strong>Office Hours:</strong> <?php echo $f['office_hours'] ?? ''; ?></span>
        <span> | </span>
        <span><strong>Office:</strong> <?php echo $fe($f['office_address'] ?? ''); ?></span>
    </div>
</footer>

<!-- Begin Shinystat code -->
<section aria-hidden="true">
    <script type="text/javascript" src="https://codice.shinystat.com/cgi-bin/getcod.cgi?USER=Dusty007"></script>
    <noscript>
        <a href="https://www.shinystat.com">
            <img src="https://www.shinystat.com/cgi-bin/shinystat.cgi?USER=Dusty007" alt="Site counter" style="border:0">
        </a>
    </noscript>
</section>
<!-- End Shinystat code -->

<script id="messenger-widget-b" src="https://cdn.botpenguin.com/website-bot.js" defer>656be698aee78a60d5229a4d,656be06b91e0ac15ad8d0d3f</script>