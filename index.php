<?php
/*
==================================================
REUSABLE TAX LANDING PAGE TEMPLATE
==================================================
All site configuration lives in config.php.
Edit config.php to customise content, colours and URLs.
Sections omitted from config.php are simply not rendered.
==================================================
*/

require_once __DIR__ . '/config.php';

if (file_exists(__DIR__ . '/db_connect.php')) {
    require_once __DIR__ . '/db_connect.php';
    if (function_exists('ptx_session_start')) {
        ptx_session_start();
    }
}

/* ── JSON-LD schema ────────────────────────────────────────────────────────── */
$schemaGraph = [];

$schemaGraph[] = [
    '@type'     => 'WebSite',
    '@id'       => rtrim($site['domain'] ?? '', '/') . '/#website',
    'url'       => rtrim($site['domain'] ?? '', '/') . '/',
    'name'      => $site['brand'] ?? '',
    'publisher' => ['@id' => rtrim($site['domain'] ?? '', '/') . '/#organization'],
    'inLanguage'=> 'en-AU',
];

$schemaGraph[] = [
    '@type'       => 'Organization',
    '@id'         => rtrim($site['domain'] ?? '', '/') . '/#organization',
    'name'        => $site['brand']       ?? '',
    'url'         => rtrim($site['domain'] ?? '', '/') . '/',
    'logo'        => rtrim($site['domain'] ?? '', '/') . '/' . ltrim($site['logo'] ?? '', '/'),
    'description' => $site['description'] ?? '',
    'telephone'   => $site['phone']       ?? '',
    'email'       => $site['email']       ?? '',
    'address'     => !empty($site['address']) ? [
        '@type'           => 'PostalAddress',
        'streetAddress'   => $site['address']['street']   ?? '',
        'addressLocality' => $site['address']['locality'] ?? '',
        'addressRegion'   => $site['address']['region']   ?? '',
        'postalCode'      => $site['address']['postcode'] ?? '',
        'addressCountry'  => $site['address']['country']  ?? '',
    ] : null,
    'contactPoint' => [[
        '@type'             => 'ContactPoint',
        'telephone'         => $site['phone'] ?? '',
        'contactType'       => 'customer service',
        'areaServed'        => 'AU',
        'availableLanguage' => 'English',
    ]],
    'sameAs'      => $site['social'] ?? [],
];

$schemaGraph[] = [
    '@type'       => 'AccountingService',
    '@id'         => rtrim($site['domain'] ?? '', '/') . '/#accountingservice',
    'name'        => ($site['brand'] ?? '') . ' - Tax Specialists',
    'url'         => rtrim($site['domain'] ?? '', '/') . '/',
    'telephone'   => $site['phone']       ?? '',
    'email'       => $site['email']       ?? '',
    'priceRange'  => $site['price_range'] ?? '',
    'description' => $site['description'] ?? '',
    'areaServed'  => ['@type' => 'Country', 'name' => 'Australia'],
    'provider'    => ['@id' => rtrim($site['domain'] ?? '', '/') . '/#organization'],
];

if (!empty($site['faq']['items'])) {
    $schemaFaqEntities = [];
    foreach ($site['faq']['items'] as $faqItem) {
        $schemaFaqEntities[] = [
            '@type' => 'Question',
            'name'  => $faqItem['question'] ?? '',
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faqItem['answer'] ?? ''],
        ];
    }
    $schemaGraph[] = [
        '@type'      => 'FAQPage',
        '@id'        => rtrim($site['domain'] ?? '', '/') . '/#faq',
        'mainEntity' => $schemaFaqEntities,
    ];
}

/* ── LocalBusiness + WebPage nodes (geo, hours, image) ─────────────────────── */
$ldBase    = rtrim($site['domain'] ?? '', '/');
$ldLogoUrl = $ldBase . '/' . ltrim($site['logo'] ?? '', '/');
$ldAddress = !empty($site['address']) ? [
    '@type'           => 'PostalAddress',
    'streetAddress'   => $site['address']['street']   ?? '',
    'addressLocality' => $site['address']['locality'] ?? '',
    'addressRegion'   => $site['address']['region']   ?? '',
    'postalCode'      => $site['address']['postcode'] ?? '',
    'addressCountry'  => $site['address']['country']  ?? '',
] : null;

$ldHours = [];
foreach (($site['hours'] ?? []) as $slot) {
    $ldHours[] = [
        '@type'     => 'OpeningHoursSpecification',
        'dayOfWeek' => $slot['days']   ?? [],
        'opens'     => $slot['opens']  ?? '',
        'closes'    => $slot['closes'] ?? '',
    ];
}

$schemaGraph[] = array_filter([
    '@type'       => 'LocalBusiness',
    '@id'         => $ldBase . '/#localbusiness',
    'name'        => $site['brand']       ?? '',
    'url'         => $ldBase . '/',
    'image'       => $ldLogoUrl,
    'telephone'   => $site['phone']       ?? '',
    'email'       => $site['email']       ?? '',
    'priceRange'  => $site['price_range'] ?? '',
    'description' => $site['description']  ?? '',
    'address'     => $ldAddress,
    'openingHoursSpecification' => $ldHours,
    'areaServed'  => ['@type' => 'Country', 'name' => 'Australia'],
    'parentOrganization' => ['@id' => $ldBase . '/#organization'],
]);

$schemaGraph[] = [
    '@type'       => 'WebPage',
    '@id'         => $ldBase . '/#webpage',
    'url'         => $ldBase . '/',
    'name'        => $site['title']       ?? ($site['brand'] ?? ''),
    'description' => $site['description']  ?? '',
    'isPartOf'    => ['@id' => $ldBase . '/#website'],
    'about'       => ['@id' => $ldBase . '/#accountingservice'],
    'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => $ldLogoUrl],
    'inLanguage'  => 'en-AU',
];

$schema = ['@context' => 'https://schema.org', '@graph' => $schemaGraph];

/* ── Hero overlay colour derived from theme primary ────────────────────────── */
$heroHex = ltrim($site['theme']['primary'] ?? '#003049', '#');
$heroR   = hexdec(substr($heroHex, 0, 2));
$heroG   = hexdec(substr($heroHex, 2, 2));
$heroB   = hexdec(substr($heroHex, 4, 2));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if (!empty($site['description'])): ?>
<meta name="description" content="<?= e($site['description']); ?>">
<?php endif; ?>
<?php if (!empty($site['keywords'])): ?>
<meta name="keywords" content="<?= e($site['keywords']); ?>">
<?php endif; ?>
<link rel="canonical" href="<?= e(rtrim($site['domain'] ?? '', '/') . '/'); ?>">
<meta property="og:title"       content="<?= e($site['title'] ?? ''); ?>">
<meta property="og:description" content="<?= e($site['description'] ?? ''); ?>">
<meta property="og:image"       content="<?= e(rtrim($site['domain'] ?? '', '/') . '/' . ltrim($site['logo'] ?? '', '/')); ?>">
<meta property="og:type"        content="website">
<meta property="og:url"         content="<?= e(rtrim($site['domain'] ?? '', '/') . '/'); ?>">
<meta property="og:site_name"   content="<?= e($site['brand'] ?? ''); ?>">
<meta property="og:locale"      content="en_AU">
<meta name="twitter:card"        content="summary_large_image">
<meta name="twitter:title"       content="<?= e($site['title'] ?? ''); ?>">
<meta name="twitter:description" content="<?= e($site['description'] ?? ''); ?>">
<meta name="twitter:image"       content="<?= e(rtrim($site['domain'] ?? '', '/') . '/' . ltrim($site['logo'] ?? '', '/')); ?>">
<title><?= e($site['title'] ?? ''); ?></title>

<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="index_style.css?v=<?= time(); ?>">

<!-- Theme CSS variables — all values from config.php $site['theme'] -->
<style>
:root{
    --blue-dark:     <?= theme_var($site, 'primary',          '#003049'); ?>;
    --blue-mid:      <?= theme_var($site, 'primary_mid',      '#f77f00'); ?>;
    --blue-light:    <?= theme_var($site, 'primary_light',    '#eae2b7'); ?>;
    --red:           <?= theme_var($site, 'accent',           '#d62828'); ?>;
    --red-dark:      <?= theme_var($site, 'accent_dark',      '#b01f1f'); ?>;
    --hero-highlight:<?= theme_var($site, 'hero_highlight',   '#fcbf49'); ?>;
    --surface:       <?= theme_var($site, 'surface',          '#faf8ef'); ?>;
    --border:        <?= theme_var($site, 'border',           '#d8cfa0'); ?>;
    --text-body:     <?= theme_var($site, 'text',             '#4a5a6b'); ?>;
    /* Header aliases — also driven by config.php */
    --ptx-navy:       <?= theme_var($site, 'primary',          '#003049'); ?>;
    --ptx-navy-light: <?= theme_var($site, 'primary_shade',    '#004a70'); ?>;
    --ptx-red:        <?= theme_var($site, 'primary_mid',      '#f77f00'); ?>;
    --ptx-red-dark:   <?= theme_var($site, 'primary_mid_dark', '#d46b00'); ?>;
}
<?php if (!empty($site['hero_image'])): ?>
.hero{
    background:
        linear-gradient(
            90deg,
            rgba(<?= $heroR ?>,<?= $heroG ?>,<?= $heroB ?>,.96),
            rgba(<?= $heroR ?>,<?= $heroG ?>,<?= $heroB ?>,.88) 48%,
            rgba(<?= $heroR ?>,<?= $heroG ?>,<?= $heroB ?>,.30)
        ),
        url('<?= e($site['hero_image']); ?>') center/cover no-repeat;
}
<?php endif; ?>
</style>

<script type="application/ld+json">
<?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>
</script>
</head>

<body>
<?php if (file_exists(__DIR__ . '/header.php')): ?>
<?php include __DIR__ . '/header.php'; ?>
<?php endif; ?>

<?php if (!empty($site['hero'])): ?>
<section class="hero">
    <div class="container hero-content">
        <?php if (!empty($site['hero']['badge'])): ?>
        <div class="hero-badge"><?= e($site['hero']['badge']); ?></div>
        <?php endif; ?>

        <h1>
            <?= e($site['hero']['heading'] ?? ''); ?>
            <?php if (!empty($site['hero']['highlight'])): ?>
            <span><?= e($site['hero']['highlight']); ?></span>
            <?php endif; ?>
        </h1>

        <?php if (!empty($site['hero']['body'])): ?>
        <p><?= e($site['hero']['body']); ?></p>
        <?php endif; ?>

        <?php if (!empty($site['hero']['primary_cta']) || !empty($site['hero']['secondary_cta'])): ?>
        <div class="hero-actions">
            <?php if (!empty($site['hero']['primary_cta'])): ?>
            <a class="hero-primary" href="<?= e($site['hero']['primary_cta']['url'] ?? '#'); ?>">
                <?= e($site['hero']['primary_cta']['label'] ?? ''); ?>
            </a>
            <?php endif; ?>
            <?php if (!empty($site['hero']['secondary_cta'])): ?>
            <a class="hero-secondary" href="<?= e($site['hero']['secondary_cta']['url'] ?? '#'); ?>">
                <?= e($site['hero']['secondary_cta']['label'] ?? ''); ?>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($site['hero']['stats'])): ?>
        <div class="hero-stats">
            <?php foreach ($site['hero']['stats'] as $stat): ?>
            <div class="hero-stat">
                <strong><?= e($stat['value'] ?? ''); ?></strong>
                <span><?= e($stat['label'] ?? ''); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<?php if (!empty($site['choices']['cards'])): ?>
<section class="choice-section">
    <div class="container">
        <?php if (!empty($site['choices']['heading']) || !empty($site['choices']['body'])): ?>
        <div class="section-heading">
            <?php if (!empty($site['choices']['heading'])): ?>
            <h2><?= e($site['choices']['heading']); ?></h2>
            <?php endif; ?>
            <?php if (!empty($site['choices']['body'])): ?>
            <p><?= e($site['choices']['body']); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="choice-grid">
            <?php foreach ($site['choices']['cards'] as $card): ?>
            <div class="choice-card">
                <h3><?= e($card['title'] ?? ''); ?></h3>
                <p><?= e($card['text'] ?? ''); ?></p>
                <a href="<?= e($card['url'] ?? '#'); ?>"><?= e($card['link_label'] ?? ''); ?></a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (!empty($site['trust']['items'])): ?>
<section class="trust-strip">
    <div class="container">
        <?php if (!empty($site['trust']['heading']) || !empty($site['trust']['body'])): ?>
        <div class="section-heading">
            <?php if (!empty($site['trust']['heading'])): ?>
            <h2><?= e($site['trust']['heading']); ?></h2>
            <?php endif; ?>
            <?php if (!empty($site['trust']['body'])): ?>
            <p><?= e($site['trust']['body']); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="trust-grid">
            <?php foreach ($site['trust']['items'] as $item): ?>
            <div class="trust-card">
                <img src="<?= e($item['image'] ?? ''); ?>" alt="<?= e($item['alt'] ?? ''); ?>">
                <strong><?= e($item['label'] ?? ''); ?></strong>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (!empty($site['reviews']['items'])): ?>
<section class="google-review-strip" aria-label="Google reviews">
    <div class="container">
        <div class="google-review-header">
            <div>
                <?php if (!empty($site['reviews']['eyebrow'])): ?>
                <span class="review-eyebrow"><?= e($site['reviews']['eyebrow']); ?></span>
                <?php endif; ?>
                <?php if (!empty($site['reviews']['heading'])): ?>
                <h2 class="google-review-title"><?= e($site['reviews']['heading']); ?></h2>
                <?php endif; ?>
                <?php if (!empty($site['reviews']['body'])): ?>
                <p class="review-subtitle"><?= e($site['reviews']['body']); ?></p>
                <?php endif; ?>
            </div>
            <?php if (!empty($site['reviews']['badge'])): ?>
            <span class="google-badge">
                <span class="stars">★★★★★</span>
                <span><?= e($site['reviews']['badge']); ?></span>
            </span>
            <?php endif; ?>
        </div>

        <div class="google-review-window">
            <div class="google-review-track">
                <?php for ($i = 0; $i < 2; $i++): ?>
                    <?php foreach ($site['reviews']['items'] as $review): ?>
                    <article class="google-review-card" <?= $i === 1 ? 'aria-hidden="true"' : ''; ?>>
                        <div class="stars">★★★★★</div>
                        <p><?= e($review['text'] ?? ''); ?></p>
                        <h3 class="google-review-name"><?= e($review['name'] ?? ''); ?></h3>
                    </article>
                    <?php endforeach; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (!empty($site['services']['cards'])): ?>
<section class="ptx-services-mega-section" aria-labelledby="services-provide-title">
    <div class="container">
        <div class="ptx-services-mega-panel">
            <div class="ptx-services-mega-heading">
                <?php if (!empty($site['services']['eyebrow'])): ?>
                <span class="ptx-choice-eyebrow"><?= e($site['services']['eyebrow']); ?></span>
                <?php endif; ?>
                <?php if (!empty($site['services']['heading'])): ?>
                <h2 id="services-provide-title"><?= e($site['services']['heading']); ?></h2>
                <?php endif; ?>
                <?php if (!empty($site['services']['body'])): ?>
                <p><?= e($site['services']['body']); ?></p>
                <?php endif; ?>
                <?php if (!empty($site['services']['note'])): ?>
                <div class="ptx-services-member-note">
                    <?php if (!empty($site['services']['note_icon'])): ?>
                    <i class="ti <?= e($site['services']['note_icon']); ?>" aria-hidden="true"></i>
                    <?php endif; ?>
                    <span><?= e($site['services']['note']); ?></span>
                </div>
                <?php endif; ?>
            </div>
            <div class="ptx-services-mega-grid">
                <?php foreach ($site['services']['cards'] as $card): ?>
                <a class="ptx-services-mega-card<?= !empty($card['locked']) ? ' ptx-services-mega-card--member' : ''; ?>"
                   href="<?= e($card['url'] ?? '#'); ?>">
                    <?php if (!empty($card['icon'])): ?>
                    <span class="ptx-services-mega-icon">
                        <i class="ti <?= e($card['icon']); ?>" aria-hidden="true"></i>
                    </span>
                    <?php endif; ?>
                    <div class="ptx-services-mega-content">
                        <h3>
                            <?= e($card['title'] ?? ''); ?>
                            <i class="ti ti-chevron-right" aria-hidden="true"></i>
                        </h3>
                        <?php if (!empty($card['text'])): ?>
                        <p><?= e($card['text']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($card['link_label'])): ?>
                        <span class="ptx-services-mega-link">
                            <?= e($card['link_label']); ?>
                            <i class="ti <?= !empty($card['locked']) ? 'ti-lock' : 'ti-arrow-right'; ?>" aria-hidden="true"></i>
                        </span>
                        <?php endif; ?>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (!empty($site['join'])): ?>
<section class="join-section" aria-labelledby="join-title">
    <div class="container">
        <div class="join-panel">
            <div class="join-copy">
                <?php if (!empty($site['join']['eyebrow'])): ?>
                <span class="eyebrow"><?= e($site['join']['eyebrow']); ?></span>
                <?php endif; ?>
                <?php if (!empty($site['join']['heading'])): ?>
                <h2 id="join-title"><?= e($site['join']['heading']); ?></h2>
                <?php endif; ?>
                <?php if (!empty($site['join']['body'])): ?>
                <p><?= e($site['join']['body']); ?></p>
                <?php endif; ?>
                <?php if (!empty($site['join']['cta_label']) && !empty($site['join']['cta_url'])): ?>
                <div class="join-actions">
                    <a class="join-btn join-btn--primary" href="<?= e($site['join']['cta_url']); ?>">
                        <?= e($site['join']['cta_label']); ?> <i class="ti ti-arrow-right"></i>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <?php if (!empty($site['join']['benefits'])): ?>
            <div class="join-path" aria-label="Member benefits">
                <?php if (!empty($site['join']['benefits_label'])): ?>
                <span class="join-benefits-label"><?= e($site['join']['benefits_label']); ?></span>
                <?php endif; ?>
                <ul class="join-benefits">
                    <?php foreach ($site['join']['benefits'] as $benefit): ?>
                    <li class="join-benefit">
                        <?php if (!empty($benefit['icon'])): ?>
                        <i class="ti <?= e($benefit['icon']); ?>" aria-hidden="true"></i>
                        <?php endif; ?>
                        <div>
                            <strong><?= e($benefit['title'] ?? ''); ?></strong>
                            <span><?= e($benefit['text'] ?? ''); ?></span>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (!empty($site['video'])): ?>
<section class="ptx-video-section" aria-labelledby="video-title">
    <div class="container">
        <div class="ptx-video-inner">
            <div class="ptx-video-copy">
                <?php if (!empty($site['video']['eyebrow'])): ?>
                <span class="ptx-choice-eyebrow"><?= e($site['video']['eyebrow']); ?></span>
                <?php endif; ?>
                <?php if (!empty($site['video']['heading'])): ?>
                <h2 id="video-title"><?= e($site['video']['heading']); ?></h2>
                <?php endif; ?>
                <?php if (!empty($site['video']['body'])): ?>
                <p><?= e($site['video']['body']); ?></p>
                <?php endif; ?>
                <?php if (!empty($site['video']['cta_label']) && !empty($site['video']['cta_url'])): ?>
                <a class="theme-btn theme-btn-red" href="<?= e($site['video']['cta_url']); ?>">
                    <?= e($site['video']['cta_label']); ?> <i class="ti ti-arrow-right"></i>
                </a>
                <?php endif; ?>
            </div>
            <?php if (!empty($site['video']['embed_url'])): ?>
            <div class="ptx-video-frame">
                <iframe
                    src="<?= e($site['video']['embed_url']); ?>"
                    title="<?= e($site['video']['heading'] ?? 'Video'); ?>"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen></iframe>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (!empty($site['faq']['items'])): ?>
<section class="faq-section" aria-labelledby="faq-title">
    <div class="container">
        <?php if (!empty($site['faq']['eyebrow']) || !empty($site['faq']['heading']) || !empty($site['faq']['body'])): ?>
        <div class="section-heading">
            <?php if (!empty($site['faq']['eyebrow'])): ?>
            <span class="eyebrow"><?= e($site['faq']['eyebrow']); ?></span>
            <?php endif; ?>
            <?php if (!empty($site['faq']['heading'])): ?>
            <h2 id="faq-title"><?= e($site['faq']['heading']); ?></h2>
            <?php endif; ?>
            <?php if (!empty($site['faq']['body'])): ?>
            <p><?= e($site['faq']['body']); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="faq-grid">
            <?php foreach ($site['faq']['items'] as $item): ?>
            <div class="faq-card">
                <h3><?= e($item['question'] ?? ''); ?></h3>
                <p><?= e($item['answer'] ?? ''); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (file_exists(__DIR__ . '/footer.php')): ?>
<?php include __DIR__ . '/footer.php'; ?>
<?php endif; ?>
</body>
</html>
