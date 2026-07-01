<?php
// Config provides $site for the modular header/footer + theme colours.
// (Session + optional db_connect are handled inside header.php.)
require_once __DIR__ . '/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contact Oz Tax Online for specialist Australian tax support for professionals and individuals. Call 1800 819 692, email our team, or send an enquiry online.">
    <meta name="keywords" content="Oz Tax Online contact, online tax support, tax return advice, Australian tax returns">
    <meta property="og:title" content="Contact Oz Tax Online | Specialist Online Tax Support">
    <meta property="og:description" content="Speak with Oz Tax Online about tax returns, deductions, appointments and specialist advice for Australians.">
    <meta property="og:url" content="https://www.oztaxonline.com.au/contact.php">
    <meta property="og:site_name" content="Oz Tax Online">
    <meta property="og:image" content="https://www.oztaxonline.com.au/img/logos/logo.png">
    <meta property="og:locale" content="en_AU">
    <meta property="og:type" content="website">
    <meta name="robots" content="index, follow">

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "WebSite",
          "@id": "https://www.oztaxonline.com.au/#website",
          "url": "https://www.oztaxonline.com.au/",
          "name": "Oz Tax Online",
          "publisher": {
            "@id": "https://www.oztaxonline.com.au/#organization"
          },
          "inLanguage": "en-AU"
        },
        {
          "@type": "Organization",
          "@id": "https://www.oztaxonline.com.au/#organization",
          "name": "Oz Tax Online",
          "url": "https://www.oztaxonline.com.au/",
          "logo": "https://www.oztaxonline.com.au/img/logos/logo.png",
          "telephone": "+61-1800-819-692",
          "email": "customerservice@oztaxonline.com.au",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Level 1/19 Market Street",
            "addressLocality": "Nunawading",
            "addressRegion": "VIC",
            "postalCode": "3131",
            "addressCountry": "AU"
          },
          "sameAs": [
            "https://www.youtube.com/@policetax"
          ]
        },
        {
          "@type": "LocalBusiness",
          "@id": "https://www.oztaxonline.com.au/#localbusiness",
          "name": "Oz Tax Online",
          "url": "https://www.oztaxonline.com.au/",
          "image": "https://www.oztaxonline.com.au/img/logos/logo.png",
          "telephone": "+61-1800-819-692",
          "email": "customerservice@oztaxonline.com.au",
          "priceRange": "$165+",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Level 1/19 Market Street",
            "addressLocality": "Nunawading",
            "addressRegion": "VIC",
            "postalCode": "3131",
            "addressCountry": "AU"
          },
          "openingHoursSpecification": [
            {
              "@type": "OpeningHoursSpecification",
              "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday"],
              "opens": "08:00",
              "closes": "18:00"
            },
            {
              "@type": "OpeningHoursSpecification",
              "dayOfWeek": ["Friday", "Saturday"],
              "opens": "08:00",
              "closes": "16:00"
            }
          ],
          "parentOrganization": {
            "@id": "https://www.oztaxonline.com.au/#organization"
          }
        },
        {
          "@type": "ContactPage",
          "@id": "https://www.oztaxonline.com.au/contact.php#webpage",
          "url": "https://www.oztaxonline.com.au/contact.php",
          "name": "Contact Oz Tax Online",
          "description": "Contact Oz Tax Online for specialist Australian tax support for professionals and individuals.",
          "isPartOf": {
            "@id": "https://www.oztaxonline.com.au/#website"
          },
          "about": {
            "@id": "https://www.oztaxonline.com.au/#organization"
          },
          "mainEntity": {
            "@id": "https://www.oztaxonline.com.au/#localbusiness"
          },
          "inLanguage": "en-AU"
        },
        {
          "@type": "BreadcrumbList",
          "@id": "https://www.oztaxonline.com.au/contact.php#breadcrumb",
          "itemListElement": [
            {
              "@type": "ListItem",
              "position": 1,
              "name": "Home",
              "item": "https://www.oztaxonline.com.au/"
            },
            {
              "@type": "ListItem",
              "position": 2,
              "name": "Contact",
              "item": "https://www.oztaxonline.com.au/contact.php"
            }
          ]
        }
      ]
    }
    </script>

    <title>Contact Oz Tax Online | 1800 819 692 | Specialist Online Tax Support</title>

    <link rel="icon" type="image/png" href="/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/header_style.css?v=<?php echo time(); ?>">

    <style>
        /* Brand tokens — sourced from config.php theme, so this page
           re-themes with the rest of the site. Neutrals/type are fixed. */
        :root {
            --ptx-navy:       <?php echo theme_var($site, 'primary',          '#003366'); ?>;
            --ptx-red:        <?php echo theme_var($site, 'primary_mid',      '#f37021'); ?>;
            --ptx-red-dark:   <?php echo theme_var($site, 'primary_mid_dark', '#d65f15'); ?>;
            --ptx-blue:       <?php echo theme_var($site, 'primary',          '#003366'); ?>;
            --ptx-blue-light: #e8eef5;
            --ptx-ink:        #111827;
            --ptx-text:       <?php echo theme_var($site, 'text',             '#3a4a5b'); ?>;
            --ptx-green:      #215605;
            --ptx-font:       "IBM Plex Sans", "Poppins", Arial, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: #f6f9fc;
            color: var(--ptx-ink);
            font-family: var(--ptx-font);
            margin: 0;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .container {
            margin: 0 auto;
            max-width: 1180px;
            padding: 0 22px;
            width: 100%;
        }

        .contact-hero {
            background:
                linear-gradient(90deg, rgba(0, 51, 102, 0.92), rgba(0, 51, 102, 0.62)),
                url("/assets/img/oztax/oztax-hero.png");
            background-position: center;
            background-size: cover;
            color: #fff;
            padding: 148px 0 84px;
        }

        .contact-hero-inner {
            max-width: 760px;
        }

        .contact-eyebrow {
            color: #9fd6ff;
            display: block;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.08em;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        .contact-hero h1 {
            color: #fff;
            font-size: clamp(38px, 5vw, 62px);
            line-height: 1.05;
            margin: 0 0 18px;
        }

        .contact-hero p {
            color: rgba(255, 255, 255, 0.9);
            font-size: clamp(17px, 1.5vw, 21px);
            line-height: 1.62;
            margin: 0 0 28px;
            max-width: 690px;
        }

        .contact-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .contact-button {
            align-items: center;
            border-radius: 8px;
            display: inline-flex;
            font-size: 15px;
            font-weight: 800;
            gap: 8px;
            justify-content: center;
            min-height: 48px;
            padding: 13px 18px;
            transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease;
        }

        .contact-button--primary {
            background: var(--ptx-red);
            color: #fff;
        }

        .contact-button--primary:hover {
            background: var(--ptx-red-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .contact-button--secondary {
            background: #fff;
            color: var(--ptx-navy);
        }

        .contact-button--secondary:hover {
            background: var(--ptx-blue-light);
            color: var(--ptx-navy);
            transform: translateY(-1px);
        }

        .contact-section {
            padding: 72px 0;
        }

        .contact-grid {
            align-items: start;
            display: grid;
            gap: 28px;
            grid-template-columns: minmax(0, 0.88fr) minmax(420px, 1.12fr);
        }

        .contact-panel,
        .contact-form-panel,
        .contact-map-panel {
            background: #fff;
            border: 1px solid #dce5ec;
            border-radius: 8px;
            box-shadow: 0 14px 34px rgba(10, 55, 96, 0.08);
        }

        .contact-panel {
            overflow: hidden;
        }

        .contact-panel img {
            aspect-ratio: 4 / 3;
            display: block;
            height: auto;
            object-fit: cover;
            width: 100%;
        }

        .contact-card-stack {
            display: grid;
            gap: 14px;
            padding: 20px;
        }

        .contact-info-card {
            align-items: flex-start;
            border: 1px solid #dce5ec;
            border-radius: 8px;
            display: grid;
            gap: 14px;
            grid-template-columns: 42px 1fr;
            padding: 16px;
        }

        .contact-info-card i {
            align-items: center;
            background: var(--ptx-blue-light);
            border-radius: 8px;
            color: var(--ptx-navy);
            display: inline-flex;
            font-size: 23px;
            height: 42px;
            justify-content: center;
            width: 42px;
        }

        .contact-info-card h2 {
            color: var(--ptx-navy);
            font-size: 17px;
            margin: 0 0 5px;
        }

        .contact-info-card p,
        .contact-info-card a {
            color: var(--ptx-text);
            font-size: 15px;
            line-height: 1.55;
            margin: 0;
        }

        .contact-info-card a:hover {
            color: var(--ptx-blue);
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .contact-form-panel {
            padding: clamp(24px, 4vw, 42px);
        }

        .contact-form-header {
            margin-bottom: 24px;
        }

        .contact-form-header h2 {
            color: var(--ptx-navy);
            font-size: clamp(28px, 3vw, 40px);
            line-height: 1.12;
            margin: 0 0 12px;
        }

        .contact-form-header p {
            color: var(--ptx-text);
            font-size: 17px;
            line-height: 1.65;
            margin: 0;
        }

        .contact-form-grid {
            display: grid;
            gap: 16px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .form-group {
            margin: 0 0 16px;
        }

        .form-group--full {
            grid-column: 1 / -1;
        }

        .form-control {
            background: #f8fbfe;
            border: 1px solid #cfdbe5;
            border-radius: 8px;
            color: var(--ptx-ink);
            display: block;
            font: inherit;
            min-height: 50px;
            padding: 13px 14px;
            width: 100%;
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .form-control:focus {
            background: #fff;
            border-color: var(--ptx-blue);
            box-shadow: 0 0 0 3px rgba(22, 118, 173, 0.14);
            outline: none;
        }

        .contact-submit {
            border: 0;
            cursor: pointer;
            width: auto;
        }

        .form-messege {
            color: var(--ptx-green);
            font-size: 14px;
            margin-top: 14px;
        }

        .contact-map-section {
            padding: 0 0 78px;
        }

        .contact-map-panel {
            display: grid;
            gap: 0;
            grid-template-columns: minmax(0, 0.85fr) minmax(0, 1.15fr);
            overflow: hidden;
        }

        .contact-location-copy {
            padding: clamp(24px, 4vw, 40px);
        }

        .contact-location-copy h2 {
            color: var(--ptx-navy);
            font-size: clamp(26px, 2.7vw, 36px);
            line-height: 1.16;
            margin: 0 0 12px;
        }

        .contact-location-copy p {
            color: var(--ptx-text);
            font-size: 16px;
            line-height: 1.68;
            margin: 0 0 16px;
        }

        .contact-location-list {
            display: grid;
            gap: 12px;
            margin-top: 20px;
        }

        .contact-location-list div {
            border-left: 3px solid var(--ptx-red);
            padding-left: 14px;
        }

        .contact-location-list strong {
            color: var(--ptx-navy);
            display: block;
            font-size: 15px;
            margin-bottom: 4px;
        }

        .contact-location-list span {
            color: var(--ptx-text);
            display: block;
            font-size: 14px;
            line-height: 1.55;
        }

        .contact-map {
            min-height: 420px;
        }

        .contact-map iframe {
            border: 0;
            display: block;
            height: 100%;
            min-height: 420px;
            width: 100%;
        }

        @media (max-width: 960px) {
            .contact-grid,
            .contact-map-panel {
                grid-template-columns: 1fr;
            }

            .contact-panel img {
                aspect-ratio: 16 / 9;
            }
        }

        @media (max-width: 640px) {
            .container {
                padding: 0 16px;
            }

            .contact-hero {
                padding: 124px 0 58px;
            }

            .contact-section {
                padding: 48px 0;
            }

            .contact-actions,
            .contact-button,
            .contact-submit {
                width: 100%;
            }

            .contact-form-grid {
                grid-template-columns: 1fr;
            }

            .contact-card-stack {
                padding: 16px;
            }
        }
    </style>
</head>

<body>
    <?php include "header.php"; ?>

    <main>
        <section class="contact-hero">
            <div class="container">
                <div class="contact-hero-inner">
                    <span class="contact-eyebrow">Contact Oz Tax Online</span>
                    <h1>Talk to a specialist tax team that works for you.</h1>
                    <p>Call, email, book an appointment or send us a message. We help Australians with tax returns, deductions, rentals, CGT, retirement questions and complex tax matters.</p>
                    <div class="contact-actions">
                        <a class="contact-button contact-button--primary" href="tel:1800819692">
                            <i class="ti ti-phone" aria-hidden="true"></i> Call 1800 819 692
                        </a>
                        <a class="contact-button contact-button--secondary" href="https://www.policetax.com.au/apponew/index.php?industry=OTH">
                            <i class="ti ti-calendar-check" aria-hidden="true"></i> Book appointment
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-section">
            <div class="container">
                <div class="contact-grid">
                    <aside class="contact-panel" aria-label="Oz Tax Online contact details">
                        <img src="/assets/img/contact/receptionist2.jpg" alt="Oz Tax Online customer support team">
                        <div class="contact-card-stack">
                            <article class="contact-info-card">
                                <i class="ti ti-map-pin" aria-hidden="true"></i>
                                <div>
                                    <h2>Office Address</h2>
                                    <p>Level 1/19 Market Street<br>Nunawading, Australia</p>
                                </div>
                            </article>
                            <article class="contact-info-card">
                                <i class="ti ti-phone-call" aria-hidden="true"></i>
                                <div>
                                    <h2>Call Us</h2>
                                    <p><a href="tel:1800819692">1800 819 692</a></p>
                                </div>
                            </article>
                            <article class="contact-info-card">
                                <i class="ti ti-mail" aria-hidden="true"></i>
                                <div>
                                    <h2>Email Us</h2>
                                    <p><a href="mailto:customerservice@oztaxonline.com.au">customerservice@oztaxonline.com.au</a></p>
                                </div>
                            </article>
                            <article class="contact-info-card">
                                <i class="ti ti-clock-hour-4" aria-hidden="true"></i>
                                <div>
                                    <h2>Office Hours</h2>
                                    <p>Monday-Thursday: 8:00am-6:00pm<br>Friday-Saturday: 8:00am-4:00pm<br>Sunday and public holidays: Closed</p>
                                </div>
                            </article>
                        </div>
                    </aside>

                    <section class="contact-form-panel" aria-labelledby="contact-form-title">
                        <div class="contact-form-header">
                            <span class="contact-eyebrow">Send an enquiry</span>
                            <h2 id="contact-form-title">How can we help?</h2>
                            <p>Tell us what you need and our team will get back to you. For urgent appointment bookings, call us directly or use the booking page.</p>
                        </div>

                        <form method="post" action="/firebrig/assets/php/contact.php" id="contact-form">
                            <div class="contact-form-grid">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Your name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Your email" required>
                                </div>
                                <div class="form-group form-group--full">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                                </div>
                                <div class="form-group form-group--full">
                                    <textarea name="message" cols="30" rows="6" class="form-control" placeholder="Write your message"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="contact-button contact-button--primary contact-submit">
                                Send message <i class="ti ti-send" aria-hidden="true"></i>
                            </button>
                            <div class="form-messege"></div>
                        </form>
                    </section>
                </div>
            </div>
        </section>

        <section class="contact-map-section" aria-labelledby="contact-location-title">
            <div class="container">
                <div class="contact-map-panel">
                    <div class="contact-location-copy">
                        <span class="contact-eyebrow">Visit Oz Tax Online</span>
                        <h2 id="contact-location-title">Find us in Nunawading.</h2>
                        <p>Our office is located at Level 1/19 Market Street, Nunawading. Use the map for directions, parking and public transport planning before your appointment.</p>
                        <div class="contact-location-list">
                            <div>
                                <strong>By car</strong>
                                <span>Head toward Market Street in Nunawading and use nearby street parking or local parking options.</span>
                            </div>
                            <div>
                                <strong>By train</strong>
                                <span>Travel to Nunawading Station, then follow local directions to Market Street.</span>
                            </div>
                            <div>
                                <strong>Need help finding us?</strong>
                                <span>Call 1800 819 692 and our team can guide you before your visit.</span>
                            </div>
                        </div>
                    </div>
                    <div class="contact-map">
                        <iframe
                            src="https://maps.google.com/maps?q=Level+1/19+Market+Street,+Nunawading,+Australia&output=embed"
                            width="100%"
                            height="420"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Oz Tax Online office at Level 1/19 Market Street, Nunawading">
                        </iframe>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include "footer.php"; ?>

    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/contact-form.js"></script>
</body>
</html>
