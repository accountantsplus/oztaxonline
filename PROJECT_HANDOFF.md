# Project Handoff — Multi-Site Tax Template System

_Last updated: 2026-06-30_

Pick-up doc for the PoliceTax / OzTaxOnline network. Captures every file we touched, the
architecture, decisions made, and what's still open.

---

## 1. The business & server

One Plesk account (`accoun40`), one shared server. Every brand is a **subfolder** under
`public_html/`, so all sites share the same `localhost` MySQL and SMTP. This is the key fact:
**a file copied into any subfolder reaches the same backend with zero connection changes.**

Live brand subfolders:
`police/`, `nursestax.com.au/`, `firefighterstax.com.au/`, `ambostax.com.au/`,
`teacherstax.com.au/`, `defencetax.com.au/`, `tradiestaxonline.com.au/` (also `tradiestax.com.au/`),
`atofightback.com.au/`, `fasttaxrefunds.com.au/`, plus many unrelated sites.

Scheduler DB (used by express_tax + appo booking):
`localhost` / `accoun40_root` / `accoun40_accounta_scheduler_tax` (Easy!Appointments schema:
`ea_appointments`, `ea_users`, `ea_express_tax_submissions`).
SMTP: `mail.ddns.com.au`, account `garry@policetax.com.au`.
⚠️ DB password + SMTP creds are hardcoded in `express_tax.php`. Flagged to move to an include
outside webroot **later** — deferred, not done.

---

## 2. The modular template system (landing pages)

Goal: one template, one config file per audience. Edit only `config.php` per site.

### Shared files — identical across ALL sites, drop-in copy, never edit per-site:
- `tax_site_template.php` / `index.php` — does `require_once __DIR__.'/config.php'`, renders
  everything from `$site`. Injects `$site['theme']` into `:root` CSS variables so themes
  re-skin automatically. All sections use `!empty()` guards → omitting a config key hides
  that section.
- `header.php` — fully `$site`-driven. Login button only renders if `header.login_url` is set
  (so police keeps login, nurses/ambos/etc. omit it → no button).
- `footer.php` — fully `$site['footer']`-driven. "Members" card heading driven by
  `quick_links_heading` (falls back to "Members"). Renders `cta_image` raw (no base-URL
  resolver) → **cta_image paths must be root-relative `/assets/...` or absolute** or they break
  on non-root pages.
- `index_style.css`, `header_style.css` — theme injected from config; no per-site edits.

### Per-site file — the ONLY thing that differs:
`config.php` holds `$site = [...]`: brand, domain, title/description/keywords, logo,
hero_image, email, theme (11 colour keys), hero, choices, services, trust, footer, faq, video.

### Configs built so far:
| Brand | Theme | Members? | Notes |
|-------|-------|----------|-------|
| Tradies | orange | (original) | the original `config.php`, fully populated |
| Nurses | teal/navy | **no** | join section + member services + login removed |
| Ambos | emergency green/amber | **no** | booking `industry=EMG` |
| Firefighters | charcoal/fire-red | **no** | booking `industry=EMG`, legal email `info@firefighterstax.com.au` |

### Decisions locked for new landing-page configs:
- **No members** on the new sites (no login button, no "Join the Family" section, no
  member-only services block). Police keeps them.
- Booking URL: `policetax.com.au/apponew/index.php?industry=XX`
  (AH = nurses, EMG = ambos & firefighters).
- Express tax → `policetax.com.au/express_tax` ; free health check → `policetax.com.au/TaxTest`.
- Trust-strip logos point to `policetax.com.au/images/` (confirmed to exist there):
  `tpa-logo.png`, `IPA_Logo.jpg`, `images-TIA.jpg`, `NTAA-logo.png`.
- **Path gotcha (recurring bug):** relative paths (`assets/...`) break on subpages because
  footer/header output them raw. Use leading-slash root-relative (`/assets/img/<brand>/...`).
  Nurses footer image bug was exactly this.
- Logo lived at `/img/logos/logo.png` on each site (not `/assets/img/logo.png`).

### Per-site images to upload (root-relative paths in config):
- Hero: `/assets/img/<brand>/<role>-uniform.jpeg`
- Footer CTA: `/assets/img/<brand>/footer<Brand>_Healthcheck.png`
- Logo: `/img/logos/logo.png`
AI image prompts were generated per profession (two-people, arms-crossed, facing-left,
right-of-frame composition so the left-side theme overlay sits over the text). Claude cannot
generate images — prompts only.

---

## 3. Shared multi-brand `express_tax.php` (lives in PoliceTax)

**One file serves all brands.** Replaces the idea of per-site copies. Sits at
`policetax.com.au/express_tax.php`.

### Brand detection priority chain (resolves `$brand`, then persists to
`$_SESSION['ptx_express_brand']` so it survives the form POST-back / refresh):
1. `?brand=nurses` URL param (PRIMARY — set this on each site's express link)
2. `HTTP_HOST` domain match (if reached via own domain)
3. session memory
4. referer sniff (last resort)
5. default `police`

Links to put on each site: `https://www.policetax.com.au/express_tax?brand=<key>`
Debug: append `&ptxdebug=1` to see resolved brand.

### `$PROFILES` array — **7 brands**: police, nurses, firefighters, ambos, teachers, defence, tradies.
Each profile: name, logo (`images/<brand>-logo.png`), theme (header/accent/button), price,
phone, deduction `labels`, donation tooltip, hero_images.

### Backend is byte-for-byte the police original — DO NOT TOUCH:
DB connect, slot finder, `ea_appointments` insert, `ea_express_tax_submissions` insert,
PHPMailer. Verified: all **11 POST field names** preserved, all **4 SQL bind signatures**
intact, brackets balanced.

### Deduction-field strategy = **Option A: reuse police DB columns, only relabel**.
A nurse's AHPRA fee still POSTs as `police_union` → stored in the `police_union` column. DB
column names "lie" but backend needs zero changes. Email Garry/Anne read shows correct label.
Same inbox (`staff@policetax.com.au`), tagged by brand in subject. Same scheduler for all.

Per-profession label map (the 5 editable rows; D1/D3.1 laundry $150/D5.2 phone $100/D5.3 WFH
kept identical for everyone):
- `uniform` (D3.2), `police_union` (D5.1), `tactical` (D5.4), `misc` (D5.5),
  `carparking_tolls` (D2) — see `$PROFILES` for each brand's wording.

### hero_images — ⚠️ OPEN ITEM:
All 7 brands currently point at the SAME shared `images/BudgetBuster_Express.png` and
`images/tax-support.png`. To make them per-brand: save brand files as
`images/<brand>-budgetbuster.png` + `images/<brand>-support.png` in `police/images/`, then
update each profile's `hero_images` paths. **Not yet done.** User generating images.

### Logos to upload to `police/images/`:
`nurses-logo.png`, `firefighters-logo.png`, `ambos-logo.png`, `teachers-logo.png`,
`defence-logo.png`, `tradies-logo.png` (download each from `<site>/img/logos/logo.png`, rename).

---

## 4. `SignElectronic.php` fix (defencetax — and the same pattern site-wide)

**Symptom:** clients don't see "form submitted", re-submit multiple times; emails not arriving.
**Root cause:** silent failure — no AJAX `error:` handler, button never locks, reCAPTCHA loaded
twice (if `grecaptcha...execute().then()` never fires, AJAX never runs, zero feedback).

**Delivered:** a drop-in replacement for the final `<script>` block (starts `var data =
getUrlVars();`). Changes: button-lock + "Sending..." on both `.btn-send` and `.btn-sendAmend`,
`error:` handlers with red "call 1800 819 692" message, clear green success + scroll-to-top,
reCAPTCHA failure handling, 20s timeout. Also fixed a latent bug: manual-signature branch
checked "Digital Signature" twice → manual uploads never attached (corrected to "Manual
Signature").

**Required HTML tweak:** the Amend form's status div is also `id="msgSubmit"` (duplicate ID) —
rename to `id="msgSubmitAmend"`.

**Caveat — NOT fully solved:** "no emails arriving" is almost certainly server-side in the
`email` endpoint this form POSTs to (not in this file). Client fix makes the failure *visible*
and stops duplicates. After deploy: red error = email endpoint failing; green success but no
email = mail routing/SPF/DKIM/inbox. The `email` handler script was never reviewed.

---

## 5. Open / next steps

- [ ] Generate + upload per-brand express hero images (BudgetBuster + support); wire
      `hero_images` paths per profile in `express_tax.php`.
- [ ] Upload the 6 brand logos to `police/images/`.
- [ ] Add `?brand=<key>` to each site's express-tax link in its config/header.
- [ ] Verify session brand-persistence on the live server (submit `?brand=nurses`, confirm
      POST-back keeps nurse branding).
- [ ] Confirm profession deduction labels match the firm's real wording (currently best-guess
      for firefighters/ambos/teachers/defence/tradies).
- [ ] Deploy SignElectronic.php script block + rename `msgSubmitAmend`; then diagnose the
      server-side `email` endpoint for the "no emails" issue.
- [ ] (Deferred) Move hardcoded DB/SMTP creds out of `express_tax.php` into an include outside
      webroot.
- [ ] Build remaining landing-page configs: teachers, defence (same no-members pattern).

---

## 6. How to add a brand New brand (e.g. teachers)

1. **Landing page:** copy shared files into the subfolder; create `config.php` from the nurses
   config, edit ~30-40 keys (identity, theme, hero, choices, footer, faq). Booking `industry`
   code, root-relative image paths, no members.
2. **Express tax:** add one entry to `$PROFILES` in the shared `express_tax.php`; add the host
   string to the `HTTP_HOST` + referer detection maps; upload logo + (optional) hero images;
   set the site's express link to `?brand=<key>`.
