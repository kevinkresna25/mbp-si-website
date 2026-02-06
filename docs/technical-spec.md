# Technical Specification Document
**Masjid Bukit Palma Web Application**

---

## Document Information

| **Attribute** | **Details** |
|---------------|-------------|
| **Product Name** | Masjid Bukit Palma Web Application |
| **Version** | 1.0.0 (MVP) |
| **Document Type** | Technical Specification |
| **Document Owner** | Senior Solution Architect |
| **Last Updated** | February 6, 2026 |
| **Domain** | https://masjidbukitpalma.or.id |
| **Infrastructure** | Hostinger Shared Hosting |

---

## Table of Contents

1. [System Architecture](#1-system-architecture)
2. [Technology Stack](#2-technology-stack)
3. [Infrastructure and Deployment (Hostinger)](#3-infrastructure-and-deployment-hostinger)
4. [Database Schema Design](#4-database-schema-design)
5. [Functional Implementation Logic](#5-functional-implementation-logic)
6. [Security Specifications](#6-security-specifications)
7. [Performance Optimization](#7-performance-optimization)
8. [API Integrations](#8-api-integrations)
9. [Development Phases](#9-development-phases)
10. [Testing Strategy](#10-testing-strategy)
11. [Deployment Checklist](#11-deployment-checklist)

---

## 1. System Architecture

### 1.1 High-Level Architecture

┌─────────────────────────────────────────────────────────────┐
│                    CLIENT LAYER                              │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │   Browser    │  │   Mobile     │  │   Tablet     │      │
│  │  (Chrome,    │  │  (Safari,    │  │  (Chrome,    │      │
│  │   Firefox)   │  │   Chrome)    │  │   Safari)    │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
└─────────────────────────────────────────────────────────────┘
                            │
                            │ HTTPS (SSL/TLS)
                            ▼
┌─────────────────────────────────────────────────────────────┐
│                 CLOUDFLARE LAYER (Optional)                  │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  • CDN Caching                                       │   │
│  │  • DDoS Protection                                   │   │
│  │  • Turnstile CAPTCHA                                 │   │
│  │  • SSL/TLS Termination                               │   │
│  └──────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────┘
                            │
                            ▼
┌─────────────────────────────────────────────────────────────┐
│              WEB SERVER LAYER (Hostinger)                    │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  Apache 2.4+ / LiteSpeed                             │   │
│  │  • mod_rewrite enabled                               │   │
│  │  • .htaccess security rules                          │   │
│  │  • PHP 8.2+ FPM                                      │   │
│  └──────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────┘
                            │
                            ▼
┌─────────────────────────────────────────────────────────────┐
│               APPLICATION LAYER (Laravel 12)                 │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐  │   │
│  │  │  Routing    │  │   Livewire  │  │   Blade     │  │   │
│  │  │  (Web/API)  │  │  Components │  │  Templates  │  │   │
│  │  └─────────────┘  └─────────────┘  └─────────────┘  │   │
│  │                                                       │   │
│  │  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐  │   │
│  │  │   Auth      │  │  Controllers│  │   Services  │  │   │
│  │  │  (Breeze +  │  │   (Logic)   │  │   (Business)│  │   │
│  │  │  Socialite) │  └─────────────┘  └─────────────┘  │   │
│  │  └─────────────┘                                     │   │
│  │                                                       │   │
│  │  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐  │   │
│  │  │   Models    │  │  Middleware │  │   Events    │  │   │
│  │  │  (Eloquent) │  │   (CSRF,    │  │  (Observers)│  │   │
│  │  └─────────────┘  │   RateLimit)│  └─────────────┘  │   │
│  │                   └─────────────┘                    │   │
│  └──────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────┘
                            │
                            ▼
┌─────────────────────────────────────────────────────────────┐
│                    DATA LAYER                                │
│  ┌──────────────────────┐  ┌──────────────────────┐        │
│  │   MySQL 8.0+         │  │   File System        │        │
│  │   • InnoDB Engine    │  │   • Uploads          │        │
│  │   • Transactions     │  │   • Logs             │        │
│  │   • Indexes          │  │   • Cache (File)     │        │
│  └──────────────────────┘  └──────────────────────┘        │
└─────────────────────────────────────────────────────────────┘
                            │
                            ▼
┌─────────────────────────────────────────────────────────────┐
│               EXTERNAL SERVICES                              │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │  Google      │  │  Prayer Time │  │  Cloudflare  │      │
│  │  OAuth 2.0   │  │  API (Alt)   │  │  Turnstile   │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
└─────────────────────────────────────────────────────────────┘

### 1.2 Application Architecture Pattern

**Pattern:** MVC + Service Layer + Repository Pattern

┌─────────────────────────────────────────────────────────────┐
│                     REQUEST FLOW                             │
└─────────────────────────────────────────────────────────────┘
                            │
                            ▼
                    ┌───────────────┐
                    │   Middleware  │
                    │  - Auth       │
                    │  - CSRF       │
                    │  - RateLimit  │
                    └───────────────┘
                            │
                            ▼
        ┌──────────────────────────────────────┐
        │          Routes (web.php)             │
        └──────────────────────────────────────┘
                            │
                ┌───────────┴───────────┐
                │                       │
                ▼                       ▼
        ┌──────────────┐        ┌──────────────┐
        │  Controller  │        │   Livewire   │
        │              │        │  Component   │
        └──────────────┘        └──────────────┘
                │                       │
                └───────────┬───────────┘
                            │
                            ▼
                ┌───────────────────────┐
                │    Service Layer      │
                │  - Business Logic     │
                │  - Validation         │
                │  - Authorization      │
                └───────────────────────┘
                            │
                            ▼
                ┌───────────────────────┐
                │   Repository Layer    │
                │  - Data Access        │
                │  - Query Builder      │
                │  - Caching            │
                └───────────────────────┘
                            │
                            ▼
                ┌───────────────────────┐
                │    Eloquent Model     │
                │  - Relationships      │
                │  - Accessors/Mutators │
                │  - Events/Observers   │
                └───────────────────────┘
                            │
                            ▼
                ┌───────────────────────┐
                │      Database         │
                └───────────────────────┘

### 1.3 Directory Structure (Hostinger Shared Hosting)

/home/username/
├── public_html/                    # Web root (only Laravel public files)
│   ├── index.php                   # Modified entry point
│   ├── .htaccess                   # Security rules + rewrite
│   ├── favicon.ico
│   ├── robots.txt
│   ├── css/                        # Compiled assets
│   ├── js/                         # Compiled assets
│   └── storage/                    # Symlink to ../laravel_app/storage/app/public
│
├── laravel_app/                    # Main application (OUTSIDE public_html)
│   ├── app/
│   │   ├── Console/
│   │   ├── Exceptions/
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   │   ├── Admin/
│   │   │   │   ├── Public/
│   │   │   │   └── Auth/
│   │   │   ├── Livewire/
│   │   │   │   ├── TransactionForm.php
│   │   │   │   ├── ApprovalTable.php
│   │   │   │   ├── DonationProgress.php
│   │   │   │   └── FinancialDashboard.php
│   │   │   ├── Middleware/
│   │   │   └── Requests/
│   │   ├── Models/
│   │   │   ├── User.php
│   │   │   ├── Role.php
│   │   │   ├── Transaction.php
│   │   │   ├── Article.php
│   │   │   ├── Gallery.php
│   │   │   └── ...
│   │   ├── Services/
│   │   │   ├── FinancialService.php
│   │   │   ├── ReportService.php
│   │   │   ├── PrayerTimeService.php
│   │   │   └── ApprovalService.php
│   │   ├── Repositories/
│   │   │   ├── TransactionRepository.php
│   │   │   └── ...
│   │   ├── Observers/
│   │   │   └── TransactionObserver.php
│   │   └── Enums/
│   │       ├── TransactionType.php
│   │       ├── CategoryZiswaf.php
│   │       └── TransactionStatus.php
│   │
│   ├── bootstrap/
│   │   └── cache/
│   ├── config/
│   │   ├── app.php
│   │   ├── database.php
│   │   ├── services.php
│   │   ├── filesystems.php
│   │   └── media-library.php
│   ├── database/
│   │   ├── migrations/
│   │   ├── seeders/
│   │   └── factories/
│   ├── public/
│   ├── resources/
│   │   ├── views/
│   │   │   ├── layouts/
│   │   │   │   ├── app.blade.php
│   │   │   │   └── admin.blade.php
│   │   │   ├── public/
│   │   │   │   ├── home.blade.php
│   │   │   │   ├── financial/
│   │   │   │   ├── articles/
│   │   │   │   └── ...
│   │   │   ├── admin/
│   │   │   │   ├── dashboard.blade.php
│   │   │   │   ├── transactions/
│   │   │   │   ├── approval/
│   │   │   │   └── ...
│   │   │   └── livewire/
│   │   ├── css/
│   │   │   └── app.css
│   │   └── js/
│   │       └── app.js
│   ├── routes/
│   │   ├── web.php
│   │   ├── admin.php
│   │   └── api.php
│   ├── storage/
│   │   ├── app/
│   │   │   ├── public/
│   │   │   └── private/
│   │   ├── framework/
│   │   │   ├── cache/
│   │   │   ├── sessions/
│   │   │   └── views/
│   │   └── logs/
│   ├── tests/
│   ├── vendor/
│   ├── .env
│   ├── .env.example
│   ├── artisan
│   ├── composer.json
│   ├── composer.lock
│   ├── package.json
│   ├── tailwind.config.js
│   └── vite.config.js
│
└── backups/

---

## 2. Technology Stack

### 2.1 Backend Framework

| Component | Technology | Version | Justification |
|-----------|-----------|---------|---------------|
| **Framework** | Laravel | 12.x | Latest stable, modern PHP features, excellent ecosystem |
| **PHP** | PHP | 8.2+ | Required by Laravel 12, performance improvements |
| **Database** | MySQL | 8.0+ | Standard on Hostinger, InnoDB transactions |
| **ORM** | Eloquent | Built-in | Active Record pattern, relationships |

### 2.2 Frontend Stack

| Component | Technology | Version | Justification |
|-----------|-----------|---------|---------------|
| **Template Engine** | Blade | Built-in | Native Laravel, component system |
| **Reactive Components** | Livewire | 3.x | No build step, reactive without JS framework |
| **CSS Framework** | Tailwind CSS | 4.x | Utility-first, production optimization |
| **Build Tool** | Vite | Latest | Fast HMR, production bundling |
| **JavaScript** | Alpine.js | 3.x | Lightweight, Livewire companion |

### 2.3 Core Packages

{
  "require": {
    "php": "^8.2",
    "laravel/framework": "^12.0",
    "laravel/breeze": "^2.0",
    "laravel/socialite": "^5.12",
    "livewire/livewire": "^3.0",
    "barryvdh/laravel-dompdf": "^3.0",
    "spatie/laravel-medialibrary": "^11.0",
    "spatie/laravel-activitylog": "^4.8",
    "spatie/laravel-permission": "^6.3"
  },
  "require-dev": {
    "laravel/telescope": "^5.0",
    "laravel/pint": "^1.13",
    "phpunit/phpunit": "^11.0"
  }
}

### 2.4 External Services

| Service | Purpose | Configuration |
|---------|---------|---------------|
| **Google OAuth 2.0** | Admin authentication | Client ID + Secret in `.env` |
| **Cloudflare Turnstile** | CAPTCHA (Login, Contact) | Site Key + Secret Key |
| **Prayer Time API** | Jadwal Salat (Alternative to Aladhan) | API Key + Fallback JSON |

---

## 3. Infrastructure and Deployment (Hostinger)

### 3.1 Security-First Directory Setup

**Problem:** Hostinger shared hosting exposes `public_html` as web root. We must protect `.env` and application logic.

**Solution:** Separate application core from web-accessible files.

#### Step 1: Upload Application

# SSH or File Manager
/home/username/
├── laravel_app/          # Upload entire Laravel project HERE
└── public_html/          # Keep empty initially

#### Step 2: Move Public Assets

# Move contents of laravel_app/public/ to public_html/
mv /home/username/laravel_app/public/* /home/username/public_html/
mv /home/username/laravel_app/public/.htaccess /home/username/public_html/

#### Step 3: Modify public_html/index.php

**Critical:** Link `public_html/index.php` to Laravel application outside web root.

**Original index.php:**
<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());

**Modified public_html/index.php for Hostinger:**
<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// MODIFIED: Point to laravel_app directory (one level up, then into laravel_app)
$appPath = __DIR__.'/../laravel_app';

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = $appPath.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require $appPath.'/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once $appPath.'/bootstrap/app.php')
    ->handleRequest(Request::capture());

#### Step 4: Create Storage Symlink

# SSH into Hostinger
cd /home/username/public_html
ln -s /home/username/laravel_app/storage/app/public storage

# Or via Laravel Artisan (if SSH available)
cd /home/username/laravel_app
php artisan storage:link --relative

#### Step 5: Set Permissions

# Directories: 755
find /home/username/laravel_app -type d -exec chmod 755 {} \;

# Files: 644
find /home/username/laravel_app -type f -exec chmod 644 {} \;

# Storage and Cache: 775
chmod -R 775 /home/username/laravel_app/storage
chmod -R 775 /home/username/laravel_app/bootstrap/cache

### 3.2 .htaccess Security Hardening

**File:** `/home/username/public_html/.htaccess`

<IfModule mod_negotiation.c>
    Options -MultiViews -Indexes
</IfModule>

<IfModule mod_rewrite.c>
    RewriteEngine On

    # Force HTTPS
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}/$1 [R=301,L]

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>

# Security Headers
<IfModule mod_headers.c>
    # Content Security Policy (CSP)
    Header set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://challenges.cloudflare.com https://www.google.com https://www.gstatic.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https:; frame-src https://challenges.cloudflare.com https://www.google.com; connect-src 'self' https://challenges.cloudflare.com;"
    
    # Prevent clickjacking
    Header always set X-Frame-Options "SAMEORIGIN"
    
    # XSS Protection
    Header always set X-XSS-Protection "1; mode=block"
    
    # Prevent MIME sniffing
    Header always set X-Content-Type-Options "nosniff"
    
    # Referrer Policy
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
    
    # Permissions Policy
    Header always set Permissions-Policy "geolocation=(), microphone=(), camera=()"
</IfModule>

# Disable Directory Browsing
Options -Indexes

# Prevent Access to .env and other sensitive files
<FilesMatch "^\.">
    Order allow,deny
    Deny from all
</FilesMatch>

# Prevent access to sensitive files
<FilesMatch "(composer\.json|composer\.lock|package\.json|\.gitignore|\.env|\.env\.example)$">
    Order allow,deny
    Deny from all
</FilesMatch>

### 3.3 Environment Configuration

**File:** `/home/username/laravel_app/.env`

APP_NAME="Masjid Bukit Palma"
APP_ENV=production
APP_KEY=base64:GENERATE_WITH_php_artisan_key:generate
APP_DEBUG=false
APP_TIMEZONE=Asia/Jakarta
APP_URL=https://masjidbukitpalma.or.id

# Logging
LOG_CHANNEL=daily
LOG_LEVEL=error
LOG_DAILY_DAYS=7

# Database
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u123456789_masjid
DB_USERNAME=u123456789_admin
DB_PASSWORD=SECURE_PASSWORD_HERE

# Session
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Cache
CACHE_DRIVER=file
CACHE_PREFIX=mbp_

# Queue (use 'sync' for shared hosting)
QUEUE_CONNECTION=sync

# Google OAuth
GOOGLE_CLIENT_ID=your-google-client-id.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URI=https://masjidbukitpalma.or.id/auth/google/callback

# Cloudflare Turnstile
TURNSTILE_SITE_KEY=0x4AAAAAAA...
TURNSTILE_SECRET_KEY=0x4AAAAAAA...

# Prayer Time API (Alternative)
PRAYER_TIME_API_KEY=your_api_key_here
PRAYER_TIME_CITY=Surabaya
PRAYER_TIME_COUNTRY=Indonesia

# Mail (Optional - for notifications)
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=noreply@masjidbukitpalma.or.id
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@masjidbukitpalma.or.id
MAIL_FROM_NAME="${APP_NAME}"

# Media Library
MEDIA_DISK=public

### 3.4 Deployment Steps

# 1. Connect via SSH or use File Manager
ssh username@yourhostinger.com

# 2. Navigate to application directory
cd /home/username/laravel_app

# 3. Install dependencies (if SSH available)
composer install --optimize-autoloader --no-dev

# 4. Generate application key
php artisan key:generate

# 5. Run migrations
php artisan migrate --force

# 6. Seed initial data
php artisan db:seed --class=InitialDataSeeder

# 7. Create storage symlink
php artisan storage:link

# 8. Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 9. Build frontend assets (locally, then upload)
npm run build
# Upload /public_html/css and /public_html/js

# 10. Set permissions
chmod -R 775 storage bootstrap/cache

---

## 4. Database Schema Design

### 4.1 Entity Relationship Diagram (ERD)

┌─────────────────────┐         ┌─────────────────────┐
│       users         │         │       roles         │
├─────────────────────┤         ├─────────────────────┤
│ id (PK)             │◄───────┐│ id (PK)             │
│ name                │        ││ name                │
│ email (unique)      │        ││ slug                │
│ email_verified_at   │        ││ description         │
│ google_id (unique)  │        ││ created_at          │
│ avatar              │        ││ updated_at          │
│ created_at          │        │└─────────────────────┘
│ updated_at          │        │
└─────────────────────┘        │
         │                     │
         │                     │
         └─────────┬───────────┘
                   │
                   │ Many-to-Many
                   ▼
         ┌─────────────────────┐
         │    role_user        │
         ├─────────────────────┤
         │ id (PK)             │
         │ user_id (FK)        │
         │ role_id (FK)        │
         │ created_at          │
         └─────────────────────┘


┌─────────────────────────────────────────────────────────────┐
│                     transactions                             │
├─────────────────────────────────────────────────────────────┤
│ id (PK)                                                      │
│ transaction_code (unique) - TRX-YYYYMMDD-XXX                │
│ tanggal (date)                                               │
│ type (enum: debit, credit)                                   │
│ category_ziswaf (enum: zakat, infaq, sedekah, wakaf, op)    │
│ category_detail (string) - Listrik, Honor Imam, dll.        │
│ nominal (decimal 15,2)                                       │
│ keterangan (text, nullable)                                  │
│ bukti_foto (string, nullable)                                │
│ status (enum: draft, submitted, approved, rejected)          │
│ rejection_reason (text, nullable)                            │
│ created_by (FK users.id)                                     │
│ approved_by (FK users.id, nullable)                          │
│ approved_at (timestamp, nullable)                            │
│ created_at                                                   │
│ updated_at                                                   │
│                                                              │
│ INDEXES:                                                     │
│ - idx_tanggal (tanggal)                                      │
│ - idx_status (status)                                        │
│ - idx_category_ziswaf (category_ziswaf)                      │
│ - idx_created_by (created_by)                                │
│ - idx_approved_at (approved_at)                              │
│ - idx_composite (tanggal, status, category_ziswaf)          │
└─────────────────────────────────────────────────────────────┘
                   │
                   │ Has Many (Audit Trail)
                   ▼
         ┌─────────────────────┐
         │  activity_log       │
         ├─────────────────────┤
         │ id (PK)             │
         │ log_name            │
         │ description         │
         │ subject_type        │
         │ subject_id          │
         │ causer_type         │
         │ causer_id (FK)      │
         │ properties (json)   │
         │ created_at          │
         └─────────────────────┘


┌─────────────────────┐
│   donation_targets  │
├─────────────────────┤
│ id (PK)             │
│ name                │
│ category_ziswaf     │
│ target_amount       │
│ current_amount      │
│ start_date          │
│ end_date (nullable) │
│ status (enum)       │
│ description (text)  │
│ created_at          │
│ updated_at          │
│                     │
│ INDEXES:            │
│ - idx_status        │
│ - idx_category      │
└─────────────────────┘


┌─────────────────────┐         ┌─────────────────────┐
│     articles        │         │  article_categories │
├─────────────────────┤         ├─────────────────────┤
│ id (PK)             │◄────────│ id (PK)             │
│ category_id (FK)    │         │ name                │
│ author_id (FK)      │         │ slug (unique)       │
│ title               │         │ description         │
│ slug (unique)       │         │ created_at          │
│ content (longtext)  │         │ updated_at          │
│ excerpt (text)      │         └─────────────────────┘
│ featured_image      │
│ status (enum)       │
│ published_at        │
│ created_at          │
│ updated_at          │
│                     │
│ INDEXES:            │
│ - idx_slug          │
│ - idx_published_at  │
│ - idx_category_id   │
└─────────────────────┘


┌─────────────────────┐         ┌─────────────────────┐
│     galleries       │         │      media          │
├─────────────────────┤         ├─────────────────────┤
│ id (PK)             │◄────────│ id (PK)             │
│ title               │         │ model_type          │
│ description         │         │ model_id (FK)       │
│ category (enum)     │         │ collection_name     │
│ tanggal             │         │ name                │
│ uploaded_by (FK)    │         │ file_name           │
│ created_at          │         │ mime_type           │
│ updated_at          │         │ disk                │
│                     │         │ size                │
│ INDEXES:            │         │ manipulations (json)│
│ - idx_category      │         │ custom_properties   │
│ - idx_tanggal       │         │ responsive_images   │
└─────────────────────┘         │ order_column        │
                                │ created_at          │
                                │ updated_at          │
                                │                     │
                                │ INDEXES:            │
                                │ - idx_model         │
                                │ - idx_collection    │
                                └─────────────────────┘


┌─────────────────────┐
│      kegiatan       │
├─────────────────────┤
│ id (PK)             │
│ nama_kegiatan       │
│ jenis (enum)        │
│ tanggal             │
│ waktu (time)        │
│ lokasi              │
│ ustadz (nullable)   │
│ deskripsi (text)    │
│ banner_image        │
│ status (enum)       │
│ created_by (FK)     │
│ created_at          │
│ updated_at          │
│                     │
│ INDEXES:            │
│ - idx_tanggal       │
│ - idx_status        │
│ - idx_jenis         │
└─────────────────────┘


┌─────────────────────┐
│  pembangunan_fase   │
├─────────────────────┤
│ id (PK)             │
│ nama_fase           │
│ deskripsi (text)    │
│ target_selesai      │
│ progress_persen     │
│ status (enum)       │
│ order_column        │
│ updated_by (FK)     │
│ created_at          │
│ updated_at          │
│                     │
│ INDEXES:            │
│ - idx_order_column  │
│ - idx_status        │
└─────────────────────┘


┌─────────────────────┐
│      struktur       │
├─────────────────────┤
│ id (PK)             │
│ nama                │
│ jabatan             │
│ foto                │
│ kontak (nullable)   │
│ order_column        │
│ created_at          │
│ updated_at          │
│                     │
│ INDEXES:            │
│ - idx_order_column  │
└─────────────────────┘


┌─────────────────────┐
│   pengumuman        │
├─────────────────────┤
│ id (PK)             │
│ title               │
│ content (text)      │
│ status (enum)       │
│ expired_at (nullable)│
│ created_by (FK)     │
│ created_at          │
│ updated_at          │
│                     │
│ INDEXES:            │
│ - idx_status        │
│ - idx_expired_at    │
└─────────────────────┘


┌─────────────────────┐
│   contact_messages  │
├─────────────────────┤
│ id (PK)             │
│ nama                │
│ email               │
│ subject             │
│ pesan (text)        │
│ is_read (boolean)   │
│ read_at (nullable)  │
│ read_by (FK, null)  │
│ created_at          │
│ updated_at          │
│                     │
│ INDEXES:            │
│ - idx_is_read       │
│ - idx_created_at    │
└─────────────────────┘


┌─────────────────────┐
│    prayer_times     │
├─────────────────────┤
│ id (PK)             │
│ tanggal (date)      │
│ subuh (time)        │
│ dzuhur (time)       │
│ ashar (time)        │
│ maghrib (time)      │
│ isya (time)         │
│ imsak (time, null)  │
│ created_at          │
│ updated_at          │
│                     │
│ INDEXES:            │
│ - idx_tanggal (unique)│
└─────────────────────┘


┌─────────────────────┐
│    static_pages     │
├─────────────────────┤
│ id (PK)             │
│ key (unique)        │
│ title               │
│ content (longtext)  │
│ updated_by (FK)     │
│ created_at          │
│ updated_at          │
│                     │
│ INDEXES:            │
│ - idx_key (unique)  │
└─────────────────────┘

### 4.2 Database Migrations

#### Migration: Create Users Table

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('google_id')->unique()->nullable();
            $table->string('avatar')->nullable();
            $table->timestamps();
            
            $table->index('email');
            $table->index('google_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

#### Migration: Create Roles and Role User Tables

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['user_id', 'role_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }
};

#### Migration: Create Transactions Table (CRITICAL)

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique();
            $table->date('tanggal');
            $table->enum('type', ['debit', 'credit']);
            $table->enum('category_ziswaf', ['zakat', 'infaq', 'sedekah', 'wakaf', 'operasional']);
            $table->string('category_detail');
            $table->decimal('nominal', 15, 2);
            $table->text('keterangan')->nullable();
            $table->string('bukti_foto')->nullable();
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected'])->default('draft');
            $table->text('rejection_reason')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            
            // CRITICAL INDEXES for performance
            $table->index('tanggal', 'idx_tanggal');
            $table->index('status', 'idx_status');
            $table->index('category_ziswaf', 'idx_category_ziswaf');
            $table->index('created_by', 'idx_created_by');
            $table->index('approved_at', 'idx_approved_at');
            $table->index(['tanggal', 'status', 'category_ziswaf'], 'idx_composite');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

#### Migration: Create Donation Targets Table

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donation_targets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category_ziswaf', ['zakat', 'infaq', 'sedekah', 'wakaf', 'operasional']);
            $table->decimal('target_amount', 15, 2);
            $table->decimal('current_amount', 15, 2)->default(0);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['active', 'completed', 'paused'])->default('active');
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->index('status', 'idx_status');
            $table->index('category_ziswaf', 'idx_category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donation_targets');
    }
};

#### Migration: Create Articles and Categories Tables

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('article_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('article_categories');
            $table->foreignId('author_id')->constrained('users');
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->text('excerpt')->nullable();
            $table->string('featured_image')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            
            $table->index('slug', 'idx_slug');
            $table->index('published_at', 'idx_published_at');
            $table->index('category_id', 'idx_category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('article_categories');
    }
};

#### Migration: Create Galleries Table

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('category', ['kegiatan', 'pembangunan', 'umum'])->default('umum');
            $table->date('tanggal');
            $table->foreignId('uploaded_by')->constrained('users');
            $table->timestamps();
            
            $table->index('category', 'idx_category');
            $table->index('tanggal', 'idx_tanggal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};

#### Migration: Create Prayer Times Table

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prayer_times', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->unique();
            $table->time('subuh');
            $table->time('dzuhur');
            $table->time('ashar');
            $table->time('maghrib');
            $table->time('isya');
            $table->time('imsak')->nullable();
            $table->timestamps();
            
            $table->unique('tanggal', 'idx_tanggal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prayer_times');
    }
};

### 4.3 Eloquent Models

#### Model: Transaction.php

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Enums\TransactionType;
use App\Enums\CategoryZiswaf;
use App\Enums\TransactionStatus;

class Transaction extends Model
{
    use LogsActivity;

    protected $fillable = [
        'transaction_code',
        'tanggal',
        'type',
        'category_ziswaf',
        'category_detail',
        'nominal',
        'keterangan',
        'bukti_foto',
        'status',
        'rejection_reason',
        'created_by',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'nominal' => 'decimal:2',
        'type' => TransactionType::class,
        'category_ziswaf' => CategoryZiswaf::class,
        'status' => TransactionStatus::class,
        'approved_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'tanggal', 'type', 'category_ziswaf', 'category_detail', 
                'nominal', 'keterangan', 'status', 'approved_by', 'approved_at'
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', TransactionStatus::Approved);
    }

    public function scopePendingApproval($query)
    {
        return $query->where('status', TransactionStatus::Submitted);
    }

    public function scopeByZiswaf($query, string $category)
    {
        return $query->where('category_ziswaf', $category);
    }

    public function scopeDebit($query)
    {
        return $query->where('type', TransactionType::Debit);
    }

    public function scopeCredit($query)
    {
        return $query->where('type', TransactionType::Credit);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if (empty($transaction->transaction_code)) {
                $transaction->transaction_code = self::generateTransactionCode();
            }
        });
    }

    public static function generateTransactionCode(): string
    {
        $date = now()->format('Ymd');
        $lastTransaction = self::whereDate('created_at', now())
            ->orderBy('id', 'desc')
            ->first();

        $sequence = $lastTransaction 
            ? ((int) substr($lastTransaction->transaction_code, -3)) + 1 
            : 1;

        return 'TRX-' . $date . '-' . str_pad($sequence, 3, '0', STR_PAD_LEFT);
    }
}

#### Enum: TransactionType.php

<?php

namespace App\Enums;

enum TransactionType: string
{
    case Debit = 'debit';
    case Credit = 'credit';

    public function label(): string
    {
        return match($this) {
            self::Debit => 'Pemasukan',
            self::Credit => 'Pengeluaran',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Debit => 'success',
            self::Credit => 'danger',
        };
    }
}

#### Enum: CategoryZiswaf.php

<?php

namespace App\Enums;

enum CategoryZiswaf: string
{
    case Zakat = 'zakat';
    case Infaq = 'infaq';
    case Sedekah = 'sedekah';
    case Wakaf = 'wakaf';
    case Operasional = 'operasional';

    public function label(): string
    {
        return match($this) {
            self::Zakat => 'Zakat',
            self::Infaq => 'Infaq',
            self::Sedekah => 'Sedekah',
            self::Wakaf => 'Wakaf',
            self::Operasional => 'Operasional',
        };
    }

    public function description(): string
    {
        return match($this) {
            self::Zakat => 'Harus disalurkan ke 8 golongan mustahiq',
            self::Infaq => 'Dapat digunakan untuk operasional dan program masjid',
            self::Sedekah => 'Dapat digunakan untuk program sosial',
            self::Wakaf => 'Untuk aset jangka panjang (tanah, bangunan)',
            self::Operasional => 'Dana operasional dari sumber non-zakat',
        };
    }

    public function canBeUsedFor(string $purpose): bool
    {
        return match($this) {
            self::Zakat => in_array($purpose, ['mustahiq', 'social']),
            self::Infaq => in_array($purpose, ['operational', 'program', 'social']),
            self::Sedekah => in_array($purpose, ['operational', 'social']),
            self::Wakaf => in_array($purpose, ['asset', 'construction']),
            self::Operasional => in_array($purpose, ['operational', 'maintenance']),
        };
    }
}

#### Enum: TransactionStatus.php

<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case Draft = 'draft';
    case Submitted = 'submitted';
    case Approved = 'approved';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match($this) {
            self::Draft => 'Draft',
            self::Submitted => 'Menunggu Approval',
            self::Approved => 'Disetujui',
            self::Rejected => 'Ditolak',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Draft => 'secondary',
            self::Submitted => 'warning',
            self::Approved => 'success',
            self::Rejected => 'danger',
        };
    }

    public function canTransitionTo(self $newStatus): bool
    {
        return match($this) {
            self::Draft => in_array($newStatus, [self::Submitted]),
            self::Submitted => in_array($newStatus, [self::Approved, self::Rejected]),
            self::Approved => false,
            self::Rejected => in_array($newStatus, [self::Draft, self::Submitted]),
        };
    }
}

---

## 5. Functional Implementation Logic

### 5.1 Financial Calculation Logic (CRITICAL)

**Principle:** Calculate balances **On-the-Fly** using SQL aggregation. NO separate balances table.

**Why?**
- Data Consistency: Single source of truth (transactions table)
- Prevents Sync Issues: No risk of balance table getting out of sync
- Audit-Friendly: All calculations traceable to raw transactions
- Rollback-Safe: Can recalculate historical balances anytime

#### Service: FinancialService.php

<?php

namespace App\Services;

use App\Models\Transaction;
use App\Enums\TransactionType;
use App\Enums\CategoryZiswaf;
use App\Enums\TransactionStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class FinancialService
{
    public function getBalanceByCategory(CategoryZiswaf $category): float
    {
        $cacheKey = "balance_{$category->value}";

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($category) {
            $debit = Transaction::approved()
                ->byZiswaf($category->value)
                ->debit()
                ->sum('nominal');

            $credit = Transaction::approved()
                ->byZiswaf($category->value)
                ->credit()
                ->sum('nominal');

            return $debit - $credit;
        });
    }

    public function getAllBalances(): array
    {
        return Cache::remember('all_balances', now()->addMinutes(30), function () {
            $result = Transaction::select(
                'category_ziswaf',
                DB::raw('SUM(CASE WHEN type = "debit" THEN nominal ELSE 0 END) as total_debit'),
                DB::raw('SUM(CASE WHEN type = "credit" THEN nominal ELSE 0 END) as total_credit'),
                DB::raw('SUM(CASE WHEN type = "debit" THEN nominal ELSE -nominal END) as balance')
            )
            ->where('status', TransactionStatus::Approved)
            ->groupBy('category_ziswaf')
            ->get()
            ->keyBy('category_ziswaf')
            ->map(fn($item) => [
                'debit' => (float) $item->total_debit,
                'credit' => (float) $item->total_credit,
                'balance' => (float) $item->balance,
            ]);

            return $result->toArray();
        });
    }

    public function getMonthlyReport(int $year, int $month): array
    {
        $startDate = now()->setYear($year)->setMonth($month)->startOfMonth();
        $endDate = now()->setYear($year)->setMonth($month)->endOfMonth();

        $transactions = Transaction::approved()
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal')
            ->get();

        $summary = $transactions->groupBy('category_ziswaf')->map(function ($group, $category) {
            $debit = $group->where('type', TransactionType::Debit)->sum('nominal');
            $credit = $group->where('type', TransactionType::Credit)->sum('nominal');

            return [
                'category' => CategoryZiswaf::from($category)->label(),
                'pemasukan' => $debit,
                'pengeluaran' => $credit,
                'selisih' => $debit - $credit,
            ];
        });

        return [
            'period' => $startDate->format('F Y'),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'summary' => $summary,
            'transactions' => $transactions,
            'total_pemasukan' => $transactions->where('type', TransactionType::Debit)->sum('nominal'),
            'total_pengeluaran' => $transactions->where('type', TransactionType::Credit)->sum('nominal'),
        ];
    }

    public function getTransactionTrends(int $months = 6): array
    {
        $result = [];

        for ($i = $months - 1; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $startDate = $date->copy()->startOfMonth();
            $endDate = $date->copy()->endOfMonth();

            $debit = Transaction::approved()
                ->debit()
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->sum('nominal');

            $credit = Transaction::approved()
                ->credit()
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->sum('nominal');

            $result[] = [
                'month' => $date->format('M Y'),
                'pemasukan' => (float) $debit,
                'pengeluaran' => (float) $credit,
                'selisih' => (float) ($debit - $credit),
            ];
        }

        return $result;
    }

    public function validateZiswafUsage(CategoryZiswaf $category, string $purpose): bool
    {
        return $category->canBeUsedFor($purpose);
    }

    public function clearCache(): void
    {
        Cache::forget('all_balances');
        
        foreach (CategoryZiswaf::cases() as $category) {
            Cache::forget("balance_{$category->value}");
        }
    }
}

### 5.2 Approval Workflow (Maker-Checker Pattern)

**State Machine:**

┌─────────┐
│  DRAFT  │  ← Bendahara creates/edits
└────┬────┘
     │ submit()
     ▼
┌──────────┐
│SUBMITTED │  ← Waiting for Takmir Inti
└────┬─────┘
     │
     ├────approve()────► ┌──────────┐
     │                   │ APPROVED │ ← Visible to public
     │                   └──────────┘
     │
     └────reject()─────► ┌──────────┐
                         │ REJECTED │ ← Back to Bendahara
                         └──────────┘
                              │
                              │ resubmit()
                              ▼
                         ┌──────────┐
                         │SUBMITTED │
                         └──────────┘

#### Service: ApprovalService.php

<?php

namespace App\Services;

use App\Models\Transaction;
use App\Enums\TransactionStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApprovalService
{
    public function __construct(
        private FinancialService $financialService
    ) {}

    public function submitForApproval(Transaction $transaction): bool
    {
        if ($transaction->status !== TransactionStatus::Draft) {
            throw new \Exception('Only draft transactions can be submitted');
        }

        return DB::transaction(function () use ($transaction) {
            $transaction->update([
                'status' => TransactionStatus::Submitted,
            ]);

            activity()
                ->performedOn($transaction)
                ->causedBy(Auth::user())
                ->log('Transaction submitted for approval');

            return true;
        });
    }

    public function approve(Transaction $transaction): bool
    {
        if ($transaction->status !== TransactionStatus::Submitted) {
            throw new \Exception('Only submitted transactions can be approved');
        }

        return DB::transaction(function () use ($transaction) {
            $transaction->update([
                'status' => TransactionStatus::Approved,
                'approved_by' => Auth::id(),
                'approved_at' => now(),
            ]);

            activity()
                ->performedOn($transaction)
                ->causedBy(Auth::user())
                ->log('Transaction approved');

            $this->financialService->clearCache();

            return true;
        });
    }

    public function reject(Transaction $transaction, string $reason): bool
    {
        if ($transaction->status !== TransactionStatus::Submitted) {
            throw new \Exception('Only submitted transactions can be rejected');
        }

        return DB::transaction(function () use ($transaction, $reason) {
            $transaction->update([
                'status' => TransactionStatus::Rejected,
                'rejection_reason' => $reason,
                'approved_by' => Auth::id(),
                'approved_at' => now(),
            ]);

            activity()
                ->performedOn($transaction)
                ->causedBy(Auth::user())
                ->withProperties(['reason' => $reason])
                ->log('Transaction rejected');

            return true;
        });
    }

    public function getPendingCount(): int
    {
        return Transaction::where('status', TransactionStatus::Submitted)->count();
    }

    public function getPendingTransactions()
    {
        return Transaction::with(['creator', 'approver'])
            ->where('status', TransactionStatus::Submitted)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}

### 5.3 Key Livewire Components

#### Livewire: TransactionForm.php

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Transaction;
use App\Enums\TransactionType;
use App\Enums\CategoryZiswaf;
use App\Enums\TransactionStatus;
use Illuminate\Support\Facades\Auth;

class TransactionForm extends Component
{
    use WithFileUploads;

    public $transactionId;
    public $tanggal;
    public $type = 'debit';
    public $category_ziswaf = 'operasional';
    public $category_detail;
    public $nominal;
    public $keterangan;
    public $bukti_foto;
    public $existingBuktiFoto;

    protected $rules = [
        'tanggal' => 'required|date|before_or_equal:today',
        'type' => 'required|in:debit,credit',
        'category_ziswaf' => 'required|in:zakat,infaq,sedekah,wakaf,operasional',
        'category_detail' => 'required|string|max:255',
        'nominal' => 'required|numeric|min:1',
        'keterangan' => 'nullable|string|max:1000',
        'bukti_foto' => 'nullable|image|max:2048',
    ];

    public function mount($transactionId = null)
    {
        if ($transactionId) {
            $transaction = Transaction::findOrFail($transactionId);
            
            if ($transaction->status !== TransactionStatus::Draft) {
                abort(403, 'Cannot edit non-draft transaction');
            }

            $this->transactionId = $transaction->id;
            $this->tanggal = $transaction->tanggal->format('Y-m-d');
            $this->type = $transaction->type->value;
            $this->category_ziswaf = $transaction->category_ziswaf->value;
            $this->category_detail = $transaction->category_detail;
            $this->nominal = $transaction->nominal;
            $this->keterangan = $transaction->keterangan;
            $this->existingBuktiFoto = $transaction->bukti_foto;
        } else {
            $this->tanggal = now()->format('Y-m-d');
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'tanggal' => $this->tanggal,
            'type' => $this->type,
            'category_ziswaf' => $this->category_ziswaf,
            'category_detail' => $this->category_detail,
            'nominal' => $this->nominal,
            'keterangan' => $this->keterangan,
            'created_by' => Auth::id(),
        ];

        if ($this->bukti_foto) {
            $data['bukti_foto'] = $this->bukti_foto->store('bukti_transaksi', 'public');
        }

        if ($this->transactionId) {
            $transaction = Transaction::findOrFail($this->transactionId);
            $transaction->update($data);
            $message = 'Transaksi berhasil diupdate';
        } else {
            $transaction = Transaction::create($data);
            $message = 'Transaksi berhasil disimpan sebagai Draft';
        }

        session()->flash('success', $message);
        return redirect()->route('admin.transactions.index');
    }

    public function render()
    {
        return view('livewire.transaction-form', [
            'transactionTypes' => TransactionType::cases(),
            'ziswafCategories' => CategoryZiswaf::cases(),
        ]);
    }
}

#### Livewire: ApprovalTable.php

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Transaction;
use App\Services\ApprovalService;

class ApprovalTable extends Component
{
    use WithPagination;

    public $selectedTransaction;
    public $rejectionReason;
    public $showRejectModal = false;

    protected $listeners = ['refreshTable' => '$refresh'];

    public function approve($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);
        
        try {
            app(ApprovalService::class)->approve($transaction);
            session()->flash('success', 'Transaksi berhasil disetujui');
            $this->emit('refreshTable');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function openRejectModal($transactionId)
    {
        $this->selectedTransaction = $transactionId;
        $this->showRejectModal = true;
        $this->rejectionReason = '';
    }

    public function reject()
    {
        $this->validate([
            'rejectionReason' => 'required|string|min:10',
        ]);

        $transaction = Transaction::findOrFail($this->selectedTransaction);
        
        try {
            app(ApprovalService::class)->reject($transaction, $this->rejectionReason);
            session()->flash('success', 'Transaksi ditolak');
            $this->showRejectModal = false;
            $this->emit('refreshTable');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        $transactions = Transaction::with(['creator', 'approver'])
            ->pendingApproval()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.approval-table', [
            'transactions' => $transactions,
        ]);
    }
}

#### Livewire: FinancialDashboard.php

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\FinancialService;
use App\Enums\CategoryZiswaf;

class FinancialDashboard extends Component
{
    public $selectedMonth;
    public $selectedYear;

    public function mount()
    {
        $this->selectedMonth = now()->month;
        $this->selectedYear = now()->year;
    }

    public function render()
    {
        $financialService = app(FinancialService::class);

        return view('livewire.financial-dashboard', [
            'balances' => $financialService->getAllBalances(),
            'monthlyReport' => $financialService->getMonthlyReport(
                $this->selectedYear,
                $this->selectedMonth
            ),
            'trends' => $financialService->getTransactionTrends(6),
            'ziswafCategories' => CategoryZiswaf::cases(),
        ]);
    }
}

---

## 6. Security Specifications

### 6.1 Authentication and Authorization

#### Laravel Breeze + Google OAuth Integration

**Install packages:**
composer require laravel/breeze laravel/socialite
php artisan breeze:install blade
npm install && npm run build

**Config: config/services.php**
return [
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
    ],

    'turnstile' => [
        'site_key' => env('TURNSTILE_SITE_KEY'),
        'secret_key' => env('TURNSTILE_SECRET_KEY'),
    ],
];

**Controller: app/Http/Controllers/Auth/GoogleController.php**
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'email_verified_at' => now(),
                ]);
            } else {
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
            }

            Auth::login($user);

            return redirect()->intended('/admin/dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Google authentication failed');
        }
    }
}

#### Role-Based Access Control Middleware

**Middleware: app/Http/Middleware/CheckRole.php**
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $userRoles = $user->roles->pluck('slug')->toArray();

        if (array_intersect($roles, $userRoles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}

**Register middleware in bootstrap/app.php (Laravel 12):**
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'role' => \App\Http\Middleware\CheckRole::class,
    ]);
})

**Usage in routes:**
Route::middleware(['auth', 'role:bendahara'])->group(function () {
    Route::get('/admin/transactions/create', [TransactionController::class, 'create']);
});

Route::middleware(['auth', 'role:takmir_inti'])->group(function () {
    Route::get('/admin/approval', [ApprovalController::class, 'index']);
});

### 6.2 Rate Limiting

**Configure in bootstrap/app.php:**
use Illuminate\Support\Facades\RateLimiter;

->withMiddleware(function (Middleware $middleware) {
    RateLimiter::for('login', function (Request $request) {
        return Limit::perMinute(5)->by($request->ip());
    });

    RateLimiter::for('contact', function (Request $request) {
        return Limit::perMinute(3)->by($request->ip());
    });

    RateLimiter::for('api', function (Request $request) {
        return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
    });
})

**Apply in routes:**
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:login');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:contact');

### 6.3 Cloudflare Turnstile Integration

**Install package:**
composer require codebar-ag/laravel-turnstile

**Publish config:**
php artisan vendor:publish --tag=turnstile-config

**Validation Rule:**
use Codebar\Turnstile\Rules\TurnstileCheck;

public function rules()
{
    return [
        'cf-turnstile-response' => ['required', new TurnstileCheck()],
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];
}

**Blade Template (Contact Form):**
<form method="POST" action="{{ route('contact.store') }}">
    @csrf
    
    <input type="email" name="email" required>
    <textarea name="message" required></textarea>
    
    <div class="cf-turnstile" 
         data-sitekey="{{ config('services.turnstile.site_key') }}"
         data-theme="light">
    </div>
    
    <button type="submit">Kirim Pesan</button>
</form>

<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

**Login Form with Turnstile:**
<form method="POST" action="{{ route('login') }}">
    @csrf
    
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    
    <div class="cf-turnstile" 
         data-sitekey="{{ config('services.turnstile.site_key') }}"
         data-theme="light">
    </div>
    
    <button type="submit">Login</button>
</form>

<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

### 6.4 CSRF Protection

**Automatically enabled by Laravel. Ensure all forms include:**
<form method="POST" action="{{ route('...') }}">
    @csrf
    <!-- form fields -->
</form>

**For Livewire components, CSRF is handled automatically.**

### 6.5 SQL Injection Prevention

**Always use Eloquent ORM or Query Builder with parameter binding:**

// SECURE - Parameterized query
$transactions = Transaction::where('status', $status)->get();

// SECURE - Query Builder with bindings
$balance = DB::table('transactions')
    ->where('category_ziswaf', $category)
    ->sum('nominal');

// INSECURE - Raw SQL without bindings
$balance = DB::select("SELECT SUM(nominal) FROM transactions WHERE category_ziswaf = '$category'");

### 6.6 XSS Prevention

**Blade automatically escapes output:**
<!-- SECURE - Auto-escaped -->
<p>{{ $article->content }}</p>

<!-- INSECURE - Unescaped (only use for trusted admin content) -->
<p>{!! $article->content !!}</p>

**For rich text content (articles), use HTML Purifier:**
composer require mews/purifier

use Mews\Purifier\Facades\Purifier;

$article->content = Purifier::clean($request->input('content'));

### 6.7 File Upload Security

**Validation in controllers:**
$request->validate([
    'bukti_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    'document' => 'required|mimes:pdf|max:5120',
]);

$path = $request->file('bukti_foto')->store('bukti_transaksi', 'public');

**Media Library Configuration:**
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Gallery extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('medium')
            ->width(800)
            ->height(600)
            ->sharpen(10)
            ->format('webp')
            ->quality(80);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photos')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/jpg'])
            ->maxFilesize(2 * 1024 * 1024);
    }
}

---

## 7. Performance Optimization

### 7.1 Database Optimization

**Index Strategy (Already defined in migrations):**
- `transactions.tanggal` - For date range queries
- `transactions.status` - For filtering approved/pending
- `transactions.category_ziswaf` - For ZISWAF breakdown
- Composite index: `(tanggal, status, category_ziswaf)` - For dashboard queries

**Query Optimization Examples:**
// OPTIMIZED - Eager loading relationships
$transactions = Transaction::with(['creator', 'approver'])
    ->approved()
    ->get();

// SLOW - N+1 query problem
$transactions = Transaction::approved()->get();
foreach ($transactions as $t) {
    echo $t->creator->name;
}

// OPTIMIZED - Select only needed columns
$transactions = Transaction::select('id', 'tanggal', 'nominal', 'category_ziswaf')
    ->approved()
    ->get();

// OPTIMIZED - Use chunk for large datasets
Transaction::approved()
    ->chunk(200, function ($transactions) {
        foreach ($transactions as $transaction) {
            // Process
        }
    });

### 7.2 Cache Strategy (File-Based)

**Config: config/cache.php**
'default' => env('CACHE_DRIVER', 'file'),

'stores' => [
    'file' => [
        'driver' => 'file',
        'path' => storage_path('framework/cache/data'),
    ],
],

'prefix' => env('CACHE_PREFIX', 'mbp'),

**Cache Usage in Services:**
use Illuminate\Support\Facades\Cache;

$balance = Cache::remember('balance_zakat', 1800, function () {
    return Transaction::approved()
        ->byZiswaf('zakat')
        ->sum('nominal');
});

$prayerTimes = Cache::remember('prayer_times_' . now()->format('Y-m-d'), 86400, function () {
    return app(PrayerTimeService::class)->getToday();
});

Cache::forget('balance_zakat');

**Clear cache after data changes:**
public function updated(Transaction $transaction)
{
    if ($transaction->wasChanged('status') && $transaction->status === TransactionStatus::Approved) {
        app(FinancialService::class)->clearCache();
    }
}

### 7.3 Asset Optimization

**Vite Configuration: vite.config.js**
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['alpinejs'],
                },
            },
        },
    },
});

**Tailwind CSS Purging: tailwind.config.js**
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./app/Http/Livewire/**/*.php",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#ECFDF5',
                    500: '#10B981',
                    600: '#059669',
                    700: '#047857',
                },
            },
        },
    },
    plugins: [],
}

**Production Build:**
npm run build

### 7.4 Livewire Performance

**Lazy Loading:**
<livewire:financial-dashboard lazy />

**Defer Loading:**
public function loadData()
{
    $this->data = $this->expensiveQuery();
}

public function render()
{
    return view('livewire.component');
}

<div wire:init="loadData">
    @if($data)
        <!-- Display data -->
    @else
        <p>Loading...</p>
    @endif
</div>

### 7.5 Image Optimization (Spatie Media Library)

**Config: config/media-library.php**
return [
    'disk_name' => env('MEDIA_DISK', 'public'),

    'max_file_size' => 1024 * 1024 * 2,

    'image_optimizers' => [
        Spatie\ImageOptimizer\Optimizers\Jpegoptim::class => [
            '--max=80',
            '--strip-all',
            '--all-progressive',
        ],
        Spatie\ImageOptimizer\Optimizers\Pngquant::class => [
            '--force',
        ],
    ],

    'temporary_directory_path' => storage_path('app/temp'),
];

**Usage:**
$gallery->addMedia($request->file('photo'))
    ->toMediaCollection('photos');

$url = $gallery->getFirstMediaUrl('photos', 'medium');

---

## 8. API Integrations

### 8.1 Prayer Time API Service (Alternative to Aladhan)

**Service: app/Services/PrayerTimeService.php**
<?php

namespace App\Services;

use App\Models\PrayerTime;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PrayerTimeService
{
    private $apiKey;
    private $city;
    private $country;
    private $fallbackPath;

    public function __construct()
    {
        $this->apiKey = config('services.prayer_time.api_key');
        $this->city = config('services.prayer_time.city', 'Surabaya');
        $this->country = config('services.prayer_time.country', 'Indonesia');
        $this->fallbackPath = storage_path('app/prayer_times_fallback.json');
    }

    public function getToday(): ?PrayerTime
    {
        $today = now()->format('Y-m-d');

        $prayerTime = PrayerTime::where('tanggal', $today)->first();

        if ($prayerTime) {
            return $prayerTime;
        }

        try {
            $prayerTime = $this->fetchFromAPI($today);
            
            if ($prayerTime) {
                return $prayerTime;
            }
        } catch (\Exception $e) {
            Log::error('Prayer Time API failed: ' . $e->getMessage());
        }

        return $this->getFromFallback($today);
    }

    public function getMonth(int $month, int $year): array
    {
        $startDate = now()->setYear($year)->setMonth($month)->startOfMonth();
        $endDate = now()->setYear($year)->setMonth($month)->endOfMonth();

        $prayerTimes = PrayerTime::whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal')
            ->get();

        if ($prayerTimes->count() === $endDate->day) {
            return $prayerTimes->toArray();
        }

        try {
            $this->fetchMonthFromAPI($month, $year);
            
            return PrayerTime::whereBetween('tanggal', [$startDate, $endDate])
                ->orderBy('tanggal')
                ->get()
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Prayer Time Month API failed: ' . $e->getMessage());
            return $this->getMonthFromFallback($month);
        }
    }

    private function fetchFromAPI(string $date): ?PrayerTime
    {
        $response = Http::timeout(10)->get('https://api.example.com/prayer-times', [
            'city' => $this->city,
            'country' => $this->country,
            'date' => $date,
            'api_key' => $this->apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            return PrayerTime::create([
                'tanggal' => $date,
                'subuh' => $data['timings']['Fajr'],
                'dzuhur' => $data['timings']['Dhuhr'],
                'ashar' => $data['timings']['Asr'],
                'maghrib' => $data['timings']['Maghrib'],
                'isya' => $data['timings']['Isha'],
                'imsak' => $data['timings']['Imsak'] ?? null,
            ]);
        }

        return null;
    }

    private function fetchMonthFromAPI(int $month, int $year): void
    {
        $response = Http::timeout(10)->get('https://api.example.com/prayer-times-month', [
            'city' => $this->city,
            'country' => $this->country,
            'month' => $month,
            'year' => $year,
            'api_key' => $this->apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            foreach ($data['data'] as $dayData) {
                PrayerTime::updateOrCreate(
                    ['tanggal' => $dayData['date']['readable']],
                    [
                        'subuh' => $dayData['timings']['Fajr'],
                        'dzuhur' => $dayData['timings']['Dhuhr'],
                        'ashar' => $dayData['timings']['Asr'],
                        'maghrib' => $dayData['timings']['Maghrib'],
                        'isya' => $dayData['timings']['Isha'],
                        'imsak' => $dayData['timings']['Imsak'] ?? null,
                    ]
                );
            }
        }
    }

    private function getFromFallback(string $date): ?PrayerTime
    {
        if (!file_exists($this->fallbackPath)) {
            Log::error('Prayer times fallback file not found');
            return null;
        }

        $fallbackData = json_decode(file_get_contents($this->fallbackPath), true);
        
        $dayOfYear = now()->parse($date)->dayOfYear;
        
        if (isset($fallbackData[$dayOfYear])) {
            $data = $fallbackData[$dayOfYear];
            
            return PrayerTime::create([
                'tanggal' => $date,
                'subuh' => $data['subuh'],
                'dzuhur' => $data['dzuhur'],
                'ashar' => $data['ashar'],
                'maghrib' => $data['maghrib'],
                'isya' => $data['isya'],
                'imsak' => $data['imsak'] ?? null,
            ]);
        }

        return null;
    }

    private function getMonthFromFallback(int $month): array
    {
        return [];
    }

    public function getNextPrayer(): ?array
    {
        $prayerTime = $this->getToday();
        
        if (!$prayerTime) {
            return null;
        }

        $now = now()->format('H:i');
        
        $prayers = [
            'Subuh' => $prayerTime->subuh,
            'Dzuhur' => $prayerTime->dzuhur,
            'Ashar' => $prayerTime->ashar,
            'Maghrib' => $prayerTime->maghrib,
            'Isya' => $prayerTime->isya,
        ];

        foreach ($prayers as $name => $time) {
            if ($time > $now) {
                return [
                    'name' => $name,
                    'time' => $time,
                ];
            }
        }

        return [
            'name' => 'Subuh',
            'time' => $prayerTime->subuh,
            'tomorrow' => true,
        ];
    }
}

**Fallback JSON Structure: storage/app/prayer_times_fallback.json**
{
  "1": {
    "tanggal": "2026-01-01",
    "subuh": "04:30",
    "dzuhur": "11:55",
    "ashar": "15:20",
    "maghrib": "18:05",
    "isya": "19:15"
  },
  "2": {
    "tanggal": "2026-01-02",
    "subuh": "04:31",
    "dzuhur": "11:56",
    "ashar": "15:21",
    "maghrib": "18:06",
    "isya": "19:16"
  }
}

### 8.2 Google OAuth Configuration

**Setup in Google Cloud Console:**
1. Create project: "Masjid Bukit Palma Web"
2. Enable "Google+ API"
3. Create OAuth 2.0 Client ID (Web application)
4. Authorized redirect URIs: `https://masjidbukitpalma.or.id/auth/google/callback`
5. Copy Client ID and Client Secret to `.env`

**Routes: routes/web.php**
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

---

## 9. Development Phases

### Phase 1: Core MVP (Week 1-6)

#### Week 1-2: Foundation Setup

**Tasks:**
- Laravel 12 installation
- Tailwind CSS 4 setup with Vite
- Laravel Breeze installation
- Google OAuth integration
- Role & Permission system (Spatie)
- Admin layout (Blade components)
- Public layout (Blade components)
- Environment configuration

**Deliverables:**
- Working authentication system
- Role-based dashboard access
- Responsive layouts (desktop + mobile)

---

#### Week 3-4: Financial Module (PRIORITY)

**Tasks:**
- Database migrations (transactions, donation_targets)
- Transaction Eloquent model with Enums
- FinancialService implementation
- ApprovalService implementation
- Livewire: TransactionForm
- Livewire: ApprovalTable
- Livewire: FinancialDashboard
- PDF Report generation (DomPDF)
- Audit trail (Spatie ActivityLog)
- QRIS display page

**Deliverables:**
- Bendahara can input transactions (Draft to Submitted)
- Takmir Inti can approve/reject transactions
- Public can view dashboard with balances by ZISWAF
- PDF reports downloadable
- Audit trail tracking all changes

---

#### Week 5-6: Profil and Beranda

**Tasks:**
- Beranda: Sambutan Takmir (editable)
- Beranda: Galeri Foto carousel
- Beranda: Jadwal Sholat widget (API integration)
- Beranda: Pengumuman management
- Profil: Sejarah Masjid (static page editor)
- Profil: Visi & Misi (static page editor)
- Profil: Struktur Organisasi (CRUD)
- Profil: Lokasi & Peta (Google Maps embed)
- User Management (Admin CRUD users + assign roles)
- Internal Notifications

**Deliverables:**
- Functional public homepage
- Complete profil masjid section
- User management dashboard

---

### Phase 2: Content and Engagement (Week 7-10)

#### Week 7-8: Artikel and Media

**Tasks:**
- Article categories CRUD (Media role)
- Articles CRUD with WYSIWYG editor
- Featured image upload with optimization
- SEO-friendly slugs
- Video Ceramah (YouTube embed management)
- Galeri Foto (batch upload with Spatie MediaLibrary)
- Gallery categories
- Lightbox view

**Deliverables:**
- 10+ artikel published
- 5+ video ceramah embedded
- 15+ galeri photos uploaded

---

#### Week 9-10: Kegiatan and Layanan

**Tasks:**
- Kegiatan CRUD (Kajian, Maulid, Sosial, Remaja)
- Kalender Kegiatan (monthly view)
- Jadwal Salat full month page
- Imsakiyah generation (Ramadan mode)
- Layanan pages (Nikah, Konsultasi, Aula)
- WhatsApp redirect integration
- Contact form with Cloudflare Turnstile
- Social media links management
- Pengumuman dynamic display

**Deliverables:**
- Calendar with 10+ events
- Layanan pages with WA integration
- Working contact form

---

### Phase 3: Pembangunan and Polish (Week 11-14)

#### Week 11-12: Pembangunan Masjid

**Tasks:**
- Desain & Masterplan upload
- Progress Pembangunan (% update by Takmir Inti)
- Galeri Foto Proyek (tagged by fase)
- Timeline Gantt Chart (optional)
- Link to financial reports

**Deliverables:**
- Complete pembangunan tracking module
- Progress visualization

---

#### Week 13: Belajar Islam and Features

**Tasks:**
- Syahadat page (text + audio)
- Pelatihan Sholat (step-by-step guide)
- Belajar Mengaji info page
- Target Donasi & Progress Bar
- Grafik Tren Donasi (6 months)
- UI/UX refinement (colors, spacing, mobile)

**Deliverables:**
- Belajar Islam section complete
- Donation tracking with progress bars

---

#### Week 14: Testing and Launch

**Tasks:**
- Cross-browser testing (Chrome, Firefox, Safari, Edge)
- Mobile responsive testing (iOS, Android)
- Performance optimization (PageSpeed > 80)
- Security audit (OWASP checklist)
- UAT with admin users
- Training session (video + manual)
- Production deployment to Hostinger
- SSL certificate validation
- Google Analytics setup

**Deliverables:**
- Production-ready application
- Training materials
- Launch announcement

---

## 10. Testing Strategy

### 10.1 Unit Testing (PHPUnit)

**Example: Test Financial Calculation**

<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Transaction;
use App\Services\FinancialService;
use App\Enums\TransactionType;
use App\Enums\CategoryZiswaf;
use App\Enums\TransactionStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FinancialServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_balance_calculation_for_ziswaf_category()
    {
        $user = User::factory()->create();
        
        Transaction::factory()->create([
            'type' => TransactionType::Debit,
            'category_ziswaf' => CategoryZiswaf::Zakat,
            'nominal' => 1000000,
            'status' => TransactionStatus::Approved,
            'created_by' => $user->id,
        ]);

        Transaction::factory()->create([
            'type' => TransactionType::Credit,
            'category_ziswaf' => CategoryZiswaf::Zakat,
            'nominal' => 300000,
            'status' => TransactionStatus::Approved,
            'created_by' => $user->id,
        ]);

        $service = new FinancialService();
        $balance = $service->getBalanceByCategory(CategoryZiswaf::Zakat);

        $this->assertEquals(700000, $balance);
    }

    public function test_draft_transactions_not_included_in_balance()
    {
        $user = User::factory()->create();
        
        Transaction::factory()->create([
            'type' => TransactionType::Debit,
            'category_ziswaf' => CategoryZiswaf::Infaq,
            'nominal' => 500000,
            'status' => TransactionStatus::Draft,
            'created_by' => $user->id,
        ]);

        $service = new FinancialService();
        $balance = $service->getBalanceByCategory(CategoryZiswaf::Infaq);

        $this->assertEquals(0, $balance);
    }
}

### 10.2 Feature Testing

**Example: Test Approval Workflow**

<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Transaction;
use App\Enums\TransactionStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApprovalWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_bendahara_can_submit_draft_transaction()
    {
        $bendahara = User::factory()->create();
        $bendaharaRole = Role::factory()->create(['slug' => 'bendahara']);
        $bendahara->roles()->attach($bendaharaRole);

        $transaction = Transaction::factory()->create([
            'status' => TransactionStatus::Draft,
            'created_by' => $bendahara->id,
        ]);

        $response = $this->actingAs($bendahara)->post(
            route('admin.transactions.submit', $transaction->id)
        );

        $response->assertStatus(302);
        $this->assertEquals(TransactionStatus::Submitted, $transaction->fresh()->status);
    }

    public function test_takmir_inti_can_approve_submitted_transaction()
    {
        $takmir = User::factory()->create();
        $takmirRole = Role::factory()->create(['slug' => 'takmir_inti']);
        $takmir->roles()->attach($takmirRole);

        $transaction = Transaction::factory()->create([
            'status' => TransactionStatus::Submitted,
        ]);

        $response = $this->actingAs($takmir)->post(
            route('admin.transactions.approve', $transaction->id)
        );

        $response->assertStatus(302);
        $transaction = $transaction->fresh();
        $this->assertEquals(TransactionStatus::Approved, $transaction->status);
        $this->assertEquals($takmir->id, $transaction->approved_by);
        $this->assertNotNull($transaction->approved_at);
    }

    public function test_bendahara_cannot_approve_transaction()
    {
        $bendahara = User::factory()->create();
        $bendaharaRole = Role::factory()->create(['slug' => 'bendahara']);
        $bendahara->roles()->attach($bendaharaRole);

        $transaction = Transaction::factory()->create([
            'status' => TransactionStatus::Submitted,
        ]);

        $response = $this->actingAs($bendahara)->post(
            route('admin.transactions.approve', $transaction->id)
        );

        $response->assertStatus(403);
    }
}

### 10.3 Browser Testing (Manual Checklist)

**Public Pages:**
- Homepage loads correctly
- Jadwal sholat displays today's times
- Galeri foto carousel works
- Pengumuman displays correctly
- Financial dashboard shows balances
- PDF report downloads successfully
- Contact form submits with Turnstile
- All links work (no 404 errors)
- Mobile responsive (iPhone, Android)

**Admin Dashboard:**
- Google OAuth login works
- Role-based access control enforced
- Transaction form validation works
- File uploads succeed
- Approval workflow functions correctly
- Audit trail logs all actions
- Livewire components update reactively
- PDF generation works

---

## 11. Deployment Checklist

### Pre-Deployment

- All migrations tested locally
- Seeders prepared with initial data
- `.env.example` updated with all variables
- Frontend assets built (`npm run build`)
- Code committed to Git repository
- Database backup plan documented

### Deployment Steps

- Upload `laravel_app` directory to `/home/username/`
- Move `public/*` to `/home/username/public_html/`
- Modify `public_html/index.php` (point to `../laravel_app`)
- Upload `.env` file with production credentials
- Set file permissions (755 dirs, 644 files)
- Run `composer install --optimize-autoloader --no-dev`
- Run `php artisan key:generate`
- Run `php artisan migrate --force`
- Run `php artisan db:seed --force`
- Run `php artisan storage:link`
- Run optimization commands:
  - `php artisan config:cache`
  - `php artisan route:cache`
  - `php artisan view:cache`
- Upload compiled assets to `public_html/css` and `public_html/js`
- Test `.htaccess` security headers
- Verify SSL certificate (HTTPS)
- Configure Google OAuth redirect URI
- Configure Cloudflare Turnstile site keys
- Test all critical user flows

### Post-Deployment

- Monitor error logs (`storage/logs/laravel.log`)
- Test with real user accounts
- Verify email notifications (if configured)
- Check Google Analytics tracking
- Announce to stakeholders
- Provide training to admin users

---

## Conclusion

This technical specification provides a complete blueprint for building the **Masjid Bukit Palma Web Application** with:

- Secure Hostinger deployment with proper directory isolation
- Robust financial system with on-the-fly balance calculation
- Maker-Checker workflow for transparency and accountability
- Comprehensive security (CSP, Rate Limiting, Turnstile, RBAC)
- Performance optimization (indexes, file cache, Livewire)
- Production-ready code examples for all critical components

**Next Steps:**
1. Review and approve this specification
2. Begin Phase 1 development (Week 1-6)
3. Conduct weekly progress reviews
4. Deploy to production by Q2 2026

**Document Version:** 1.0.0  
**Last Updated:** February 6, 2026  
**Status:** Ready for Implementation

---

**Prepared by:** Senior Solution Architect  
**Approved by:** _[Pending]_  
**Date:** February 6, 2026