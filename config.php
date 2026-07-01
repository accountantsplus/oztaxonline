<?php
/*
==================================================
SITE CONFIGURATION — Oz Tax Online
==================================================
Edit this file only. All PHP templates and CSS
variables derive their values from $site below.
==================================================
*/

$site = [

    /* ── Basic site settings ───────────────────────────────────────────────── */
    'brand'       => 'Oz Tax Online',
    'domain'      => 'https://www.oztaxonline.com.au',
    'title'       => 'Oz Tax Online | Specialist Online Tax Returns for Australians',
    'description' => 'Oz Tax Online – specialist tax service for professionals and individuals. Expert tax lodgements, maximised deductions, fast online service and tailored tax planning across professions.',
    'keywords'    => 'online tax return Australia, tax return service, online tax lodgement, specialist tax service, tax deductions, professional tax service, Oz Tax Online',
    'logo'        => '/img/logos/logo.png',
    'hero_image'  => '/assets/img/oztax/oztax-hero.png',
    'phone'       => '1800 819 692',
    'email'       => 'info@oztaxonline.com.au',
    'price_range' => '$165+',

    /* ── Theme colours ─────────────────────────────────────────────────────── */
    /*
     * Oz Tax Online palette — professional navy with orange accents,
     * carried over from the original Oz Tax Online branding.
     */
    'theme' => [
        'primary'          => '#003366',   // navy — main brand colour
        'primary_shade'    => '#00264d',   // dark navy — gradients / mobile menu
        'primary_mid'      => '#f37021',   // orange — CTA buttons, links, accents
        'primary_mid_dark' => '#d65f15',   // dark orange — button hover states
        'primary_light'    => '#fde8d8',   // pale orange — light background tints
        'accent'           => '#ff6600',   // bright orange — eyebrow text, indicators
        'accent_dark'      => '#cc5200',   // dark orange — accent hover states
        'hero_highlight'   => '#ff9248',   // amber-orange — hero heading span, stars
        'surface'          => '#f7f9fc',   // cool off-white — alternate section backgrounds
        'border'           => '#dbe3ec',   // cool grey — card borders, dividers
        'text'             => '#3a4a5b',   // slate — body copy
    ],

    /* ── Contact / schema address ──────────────────────────────────────────── */
    'address' => [
        'street'   => '153-155 Springvale Road',
        'locality' => 'Nunawading',
        'region'   => 'VIC',
        'postcode' => '3131',
        'country'  => 'AU',
    ],

    /* ── Opening hours (used by LocalBusiness schema) ──────────────────────── */
    'hours' => [
        ['days' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday'], 'opens' => '08:00', 'closes' => '18:00'],
        ['days' => ['Friday', 'Saturday'],                         'opens' => '08:00', 'closes' => '16:00'],
    ],

    /* ── Social / sameAs profiles (used by Organization schema) ────────────── */
    'social' => [
        'https://www.youtube.com/@policetax',
    ],

    /* ── Hero ──────────────────────────────────────────────────────────────── */
    'hero' => [
        'badge'         => 'Specialist online tax service for Australian professionals and individuals',
        'heading'       => 'Meet the Specialist in',
        'highlight'     => 'Online Tax Returns',
        'body'          => 'Practical tax support for professionals and individuals across Australia who want to claim correctly, maximise eligible deductions and lodge online with confidence.',
        'primary_cta'   => ['label' => 'Start Online Tax',  'url' => 'https://www.policetax.com.au/TaxTest'],
        'secondary_cta' => ['label' => 'Book With Garry',   'url' => 'https://www.policetax.com.au/apponew/index.php?industry=OTH'],
        'stats' => [
            ['value' => '48+',            'label' => 'Years Experience'],
            ['value' => '10,000+',        'label' => 'Clients Australia-wide'],
            ['value' => 'Australia-wide', 'label' => 'Online Tax Support'],
        ],
    ],

    /* ── Getting-started cards ─────────────────────────────────────────────── */
    'choices' => [
        'heading' => 'Choose the right way to lodge',
        'body'    => 'Simple return, work-related deductions, investment income, salary packaging or overdue returns? Pick the option that fits and we will guide you from there.',
        'cards'   => [
            [
                'title'      => 'Start Online Tax',
                'text'       => 'Best for clients who want to upload details online and lodge without waiting for an appointment.',
                'link_label' => 'Start Now',
                'url'        => 'https://www.policetax.com.au/TaxTest',
            ],
            [
                'title'      => 'Book With Garry',
                'text'       => 'Best for salary packaging, rental property income, multi-year late returns or more complex tax matters.',
                'link_label' => 'Book Appointment',
                'url'        => 'https://www.policetax.com.au/apponew/index.php?industry=OTH',
            ],
            [
                'title'      => 'Tax Health Check',
                'text'       => 'Not sure what you can claim? Check whether you may be missing deductions before you lodge.',
                'link_label' => 'Start Free Check',
                'url'        => 'https://www.policetax.com.au/TaxTest',
            ],
        ],
    ],

    /* ── Trust strip ───────────────────────────────────────────────────────── */
    'trust' => [
        'heading' => 'Trusted. Registered. Professionally Accountable.',
        'body'    => 'Credibility matters when clients trust us with their refund, records and ATO position.',
        'items'   => [
            ['image' => 'https://www.policetax.com.au/images/tpa-logo.png',   'alt' => 'Registered Tax Agent', 'label' => 'Registered Tax Agent'],
            ['image' => 'https://www.policetax.com.au/images/IPA_Logo.jpg',   'alt' => 'IPA Member',           'label' => 'IPA Member'],
            ['image' => 'https://www.policetax.com.au/images/images-TIA.jpg', 'alt' => 'The Tax Institute',    'label' => 'The Tax Institute'],
            ['image' => 'https://www.policetax.com.au/images/NTAA-logo.png',  'alt' => 'NTAA Member',          'label' => 'NTAA Member'],
        ],
    ],

    /* ── Reviews ───────────────────────────────────────────────────────────── */
    'reviews' => [

    ],

    /* ── Services (member-only) — removed: Oz Tax Online has no membership ──── */

    /* ── Join / membership CTA — removed: Oz Tax Online has no membership ───── */

    /* ── Video / about specialist ──────────────────────────────────────────── */
    'video' => [
        'eyebrow'   => 'Meet your tax specialist',
        'heading'   => 'About Garry Angus',
        'body'      => 'For decades, Garry Angus has helped Australian workers and families prepare accurate tax returns, identify eligible deductions and handle more complex tax matters.',
        'cta_label' => 'Explore more videos',
        'cta_url'   => 'https://www.youtube.com/@policetax',
        'embed_url' => 'https://www.youtube.com/embed/Z7kyN8Cbzb8',
    ],

    /* ── Header navigation URLs ────────────────────────────────────────────── */
    'header' => [
        'booking_url'         => 'https://www.policetax.com.au/apponew/index.php?industry=OTH',
        'express_tax_url'     => 'https://www.policetax.com.au/express_tax?brand=oztax',
        'tax_test_url'        => 'https://www.policetax.com.au/TaxTest',
        'contact_url'         => '/contact.php',
        'dashboard_url'       => '/dashboard.php',
        'download_centre_url' => '/download-centre.php',
        'logout_url'          => '/logout.php',
    ],

    /* ── Footer ────────────────────────────────────────────────────────────── */
    'footer' => [
        'tagline'             => 'Specialist Online Tax for Australians',
        'positioning_heading' => 'Specialist Online Tax Support for Professionals and Individuals',
        'positioning_body'    => 'Trusted by Australians for practical tax advice, maximised deductions and fast online refund support.',
        'services' => [
            [
                'title' => 'Express Tax Upload',
                'note'  => 'No appointment needed',
                'desc'  => 'Securely upload your documents and let our team prepare and lodge your tax return.',
                'price' => '$165',
                'url'   => 'https://www.policetax.com.au/express_tax?brand=oztax',
            ],
            [
                'title' => 'Book Appointment',
                'note'  => 'For more complex tax matters',
                'desc'  => 'Book a time to discuss deductions, salary packaging, late returns or investment property tax.',
                'price' => '$230',
                'url'   => 'https://www.policetax.com.au/apponew/index.php?industry=OTH',
            ],
        ],
        'quick_links_heading' => 'Tax Resources',
        'quick_links' => [
            ['label' => 'Tax Resources',    'url' => '/about.php'],
            ['label' => 'Contact Our Team', 'url' => '/contact.php'],
        ],
        'cta_image'      => '/assets/img/oztax/footerOzTax_Healthcheck.png',
        'cta_label'      => 'Free Tax Health Check',
        'cta_body'       => 'Check whether you may be missing deductions before you lodge.',
        'cta_url'        => 'https://www.policetax.com.au/TaxTest',
        'review_heading' => 'Online Tax Specialists for Australians',
        'review_body'    => 'Part of the Accountants Plus Group, supporting clients with specialist online tax services.',
        'google_review_url' => 'https://g.page/r/CVxczrmeC11QEAE/review',
        'legal' => [
            ['type' => 'text', 'label' => 'Part of the Accountants Plus Group of Companies'],
            ['type' => 'text', 'label' => 'Tax Agent No. 55961005'],
            ['type' => 'link', 'label' => 'Privacy Policy',                     'url' => '/misc/privacy.html'],
            ['type' => 'link', 'label' => 'Terms &amp; Conditions',             'url' => '/misc/terms.html'],
            ['type' => 'link', 'label' => 'customerservice@oztaxonline.com.au', 'url' => 'mailto:customerservice@oztaxonline.com.au'],
        ],
        'office_hours'   => 'Mon–Thu 8:00am–6:00pm | Fri–Sat 8:00am–4:00pm | Sun &amp; Public Holidays Closed',
        'office_address' => 'Level 1, 19 Market Street, Nunawading VIC 3131',
    ],

    /* ── FAQ ───────────────────────────────────────────────────────────────── */
    'faq' => [
        'eyebrow' => 'Tax questions',
        'heading' => 'Common questions before you lodge',
        'body'    => 'General information only. Your actual claim depends on your work, records and how each expense was used.',
        'items'   => [
            ['question' => 'What deductions can I claim?',       'answer' => 'You may be able to claim expenses directly connected to earning your income — such as work-related uniforms, equipment, professional memberships, self-education and home-office costs — provided they are not reimbursed and are supported by records.'],
            ['question' => 'Can I lodge my tax return online?',  'answer' => 'Yes. The online upload option is designed for clients who want to lodge without needing a face-to-face appointment.'],
            ['question' => 'How fast will I get my refund?',     'answer' => 'Once your return is lodged, the ATO generally processes refunds within about two weeks. Timing can vary depending on the ATO and your individual circumstances.'],
            ['question' => 'Can you handle overdue returns?',    'answer' => 'Yes. We regularly help clients catch up on multiple years of outstanding returns. Book an appointment so we can review your situation.'],
            ['question' => 'What if my tax is more complex?',    'answer' => 'Book an appointment if you have salary packaging, rental property, capital gains, business income, unusual deductions or overdue returns.'],
        ],
    ],

];

/* ── Helper functions ──────────────────────────────────────────────────────── */

if (!function_exists('e')) {
    function e($value) {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('theme_var')) {
    function theme_var($site, $key, $fallback = '') {
        return e($site['theme'][$key] ?? $fallback);
    }
}
