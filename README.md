# ehsan-bhai-app (The SharePage)

## Local XAMPP Setup

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) installed (PHP 7.4+ recommended)
- MySQL running via XAMPP

---

### 1. Place the project

Copy (or clone) this repository into your XAMPP `htdocs` folder.  
The project can be placed either at the **web root** or in a **subdirectory**:

| Placement | URL |
|---|---|
| `C:\xampp\htdocs\` (web root) | `http://localhost/` |
| `C:\xampp\htdocs\SHAREPAGE_CODES-Hafiz_Dev\` | `http://localhost/SHAREPAGE_CODES-Hafiz_Dev/` |

`BASE_URL` is now computed **automatically** from the filesystem path, so asset links
(CSS, JS, images) will resolve correctly regardless of where the project folder lives.

---

### 2. Create `.env`

The application reads configuration from a `.env` file using PHP's `parse_ini_file()`.

**Where to put `.env`:**

* **Preferred (XAMPP web root):** `C:\xampp\htdocs\.env`  
  This is `$_SERVER['DOCUMENT_ROOT']/.env`.

* **Fallback (project root):** `C:\xampp\htdocs\SHAREPAGE_CODES-Hafiz_Dev\.env`  
  Automatically used if the file is not found at the web root.

---

### 3. Example `.env`

```ini
; Environment: local | dev | production
ENV=local

; ── Database ─────────────────────────────────────────────────────────────────
; DB_HOST must be a plain hostname/IP – never a URL path.
; For XAMPP use 'localhost' (or '127.0.0.1').
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=theshare_share

; ── Domain / branding ─────────────────────────────────────────────────────────
; DOMAIN is used for display / email purposes only – NOT for building URLs.
; Keep it as a bare hostname (no http:// prefix, no path).
DOMAIN=localhost

; ── Front-end asset bundles (leave blank if not using a build tool) ───────────
JS_FILE=
CSS_FILE=

; ── Company info ──────────────────────────────────────────────────────────────
COMPANY=The SharePage
BRAND=SharePage
CONTACT=contact@thesharepage.com
COUNTRY=US
PHONE=+1-000-000-0000

; ── Encryption / payment keys ─────────────────────────────────────────────────
SECRET_KEY=your_secret_key_here
PUBLIC_KEY=your_public_key_here
CARD_PASSWORD=your_card_password_here
encrypt_iv=your_iv_here
encrypt_key=your_encrypt_key_here

; ── AWS SNS ───────────────────────────────────────────────────────────────────
sns_key=your_sns_key
sns_secret=your_sns_secret

; ── Click-Send SMS ────────────────────────────────────────────────────────────
click_send_username=your_username
click_send_api_key=your_api_key

; ── SMTP (email) ──────────────────────────────────────────────────────────────
smtp_host=smtp.mailtrap.io
smtp_port=587
smtp_username=your_smtp_username
smtp_password=your_smtp_password
regmail_username=registration@thesharepage.com
regmail_password=your_regmail_password
noreplymail_username=noreply@thesharepage.com
noreplymail_password=your_noreplymail_password
```

---

### 4. Import the database

1. Open `http://localhost/phpmyadmin`
2. Create a database named `theshare_share` (or whatever `DB_NAME` is set to)
3. Import the SQL dump from the `sql/` folder in this repository

---

### 5. Start Apache & MySQL in XAMPP, then open the app

```
http://localhost/SHAREPAGE_CODES-Hafiz_Dev/
```

---

## Common Errors & Fixes

| Error | Cause | Fix |
|---|---|---|
| `mysqli_connect(): (HY000/2002)` | `DB_HOST` is wrong | Set `DB_HOST=localhost` in `.env` |
| Assets 404 / blank page | `BASE_URL` missing subdirectory | Already fixed – dynamic computation; ensure project folder is correct |
| `net::ERR_NAME_NOT_RESOLVED` | `DOMAIN` used as a URL hostname | Set `DOMAIN=localhost` (bare hostname, no path) |
| `.env` not found / `parse_ini_file` warning | `.env` missing | Create `.env` at `C:\xampp\htdocs\.env` or in the project root |

---

## Project Structure (key files)

```
<project-root>/
├── univ/
│   ├── main.php          # Loads .env, defines BASE_URL / DBHOST / DOMAIN etc.
│   └── baseurl.php       # Sets $BaseUrl (PHP variable) for templates
├── mlayer/
│   └── _data.class.php   # Singleton DB connection (uses DBHOST)
├── common.php            # Shared helpers, loads _data.class.php
├── index.php             # App entry point
└── .env                  # NOT committed – create manually (see above)
```
