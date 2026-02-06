# Masjid Bukit Palma - Sistem Informasi Website

A comprehensive mosque management and information system built for Masjid Bukit Palma, Surabaya. This web application provides financial transparency, content management, activity scheduling, and community engagement tools.

## Tech Stack

| Layer | Technology |
|-------|-----------|
| **Framework** | Laravel 12 (PHP 8.2+) |
| **Frontend** | Blade + Livewire 4 + Alpine.js |
| **CSS** | Tailwind CSS 3 |
| **Build Tool** | Vite 7 |
| **Database** | SQLite (dev) / MySQL (production) |
| **Authentication** | Laravel Breeze + Google OAuth (Socialite) |
| **Authorization** | Spatie Laravel Permission (5 roles) |
| **Media** | Spatie Media Library |
| **Activity Log** | Spatie Activity Log |
| **PDF** | Barryvdh DomPDF |
| **HTML Sanitizer** | Mews Purifier |

## Features

### Public Pages
- **Homepage** - Mosque overview, announcements, prayer times, wisdom quotes
- **Financial Dashboard** - Real-time ZISWAF balance transparency, monthly trends
- **Donation** - Active donation targets with progress tracking
- **Articles** - News and articles with categories
- **Activities** - Event listings with calendar view
- **Construction Progress** - Building phases with photo documentation
- **Belajar Islam** - Islamic learning pages (Syahadat, Sholat, Mengaji)
- **Layanan** - Services (Prayer schedule, Marriage, Consultation, Requests)
- **Profile** - Mosque history, vision/mission, organizational structure, location
- **Contact** - Contact form with Turnstile CAPTCHA protection

### Admin Panel
- **Dashboard** - Overview statistics and quick actions
- **Financial Management** - Transaction CRUD with ZISWAF categorization
- **Approval Workflow** - Draft → Submitted → Approved/Rejected flow
- **PDF Reports** - Monthly financial reports generation
- **Content Management** - Articles, galleries, video ceramah, wisdom quotes
- **User Management** - Role-based user administration
- **Audit Log** - Full activity tracking via Spatie Activity Log
- **Contact Messages** - View and manage incoming messages

### Role-Based Access (5 Roles)

| Role | Access |
|------|--------|
| **Admin** | Full system access |
| **Takmir Inti** | Approve transactions, manage content & structure |
| **Bendahara** | Create & manage financial transactions |
| **Media** | Manage articles, galleries, and activities |
| **Jamaah** | Public access + authenticated features |

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer 2.x
- Node.js 18+ & npm
- SQLite (for development) or MySQL 8.0+ (for production)

### Quick Setup

```bash
# 1. Clone the repository
git clone <repository-url>
cd mbp-si-website/project

# 2. Run the automated setup
composer setup
```

The `composer setup` command will:
- Install PHP dependencies
- Copy `.env.example` to `.env`
- Generate application key
- Run database migrations
- Install Node.js dependencies
- Build frontend assets

### Manual Setup

```bash
# 1. Install PHP dependencies
composer install

# 2. Copy environment file
cp .env.example .env

# 3. Generate application key
php artisan key:generate

# 4. Create SQLite database (for local development)
touch database/database.sqlite

# 5. Run migrations
php artisan migrate

# 6. Seed the database
php artisan db:seed

# 7. Install Node.js dependencies
npm install

# 8. Build assets
npm run build

# 9. Create storage symlink
php artisan storage:link
```

## Development

### Start Development Server

```bash
composer dev
```

This single command starts all services concurrently:
- **Laravel server** at `http://localhost:8000`
- **Queue worker** for background jobs
- **Pail** for log tailing
- **Vite** dev server with HMR

### Individual Commands

```bash
# Start only the PHP server
php artisan serve

# Start Vite dev server
npm run dev

# Run queue worker
php artisan queue:listen
```

## Testing

Tests use SQLite in-memory database for fast execution.

### Run All Tests

```bash
composer test
# or
php artisan test
```

### Run Specific Test Suites

```bash
# Unit tests only
php artisan test --testsuite=Unit

# Feature tests only
php artisan test --testsuite=Feature

# Run a specific test file
php artisan test --filter=FinancialServiceTest
php artisan test --filter=ApprovalWorkflowTest
php artisan test --filter=PublicPagesTest
```

### Test Coverage

| Test Suite | Description |
|-----------|------------|
| `FinancialServiceTest` | ZISWAF balance calculations, monthly reports, code generation |
| `ApprovalWorkflowTest` | Transaction lifecycle, role-based access, Livewire forms |
| `PublicPagesTest` | All public routes return HTTP 200 |
| `ProfileTest` | User profile management (Breeze default) |
| `Auth/*` | Authentication flow tests (Breeze default) |

## Database Seeding

```bash
# Run all seeders (roles, content, financial data)
php artisan db:seed

# Run specific seeders
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=ContentSeeder
php artisan db:seed --class=FinancialDataSeeder

# Fresh migration + seed
php artisan migrate:fresh --seed
```

### Seeded Data

- **Roles & Permissions** - 5 roles with granular permissions
- **Static Pages** - Sejarah, Visi Misi, Lokasi, Sambutan Ketua
- **Organizational Structure** - Sample takmir structure
- **Announcements** - 3 sample announcements
- **Wisdom Quotes** - 5 Islamic wisdom quotes with sources
- **Prayer Times** - Current month prayer schedule
- **Financial Transactions** - 150-240 realistic transactions across 3 months
- **Donation Targets** - 4 targets (3 active, 1 completed)

## Default Test Accounts

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@masjidbukitpalma.or.id` | `password` |
| Bendahara | `bendahara@masjidbukitpalma.or.id` | `password` |
| Takmir Inti | `takmir@masjidbukitpalma.or.id` | `password` |
| Media | `media@masjidbukitpalma.or.id` | `password` |

> **Note:** Google OAuth login is also available when configured.

## Environment Configuration

### Required Variables

| Variable | Description | Example |
|----------|-------------|---------|
| `APP_NAME` | Application name | `Masjid Bukit Palma` |
| `APP_URL` | Base URL | `https://masjidbukitpalma.or.id` |
| `DB_CONNECTION` | Database driver | `sqlite` or `mysql` |

### Google OAuth (Optional)

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create OAuth 2.0 credentials
3. Set authorized redirect URI to `{APP_URL}/auth/google/callback`
4. Add credentials to `.env`:

```env
GOOGLE_CLIENT_ID=your-client-id
GOOGLE_CLIENT_SECRET=your-client-secret
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
```

### Cloudflare Turnstile (Contact Form Protection)

```env
TURNSTILE_SITE_KEY=your-site-key
TURNSTILE_SECRET_KEY=your-secret-key
```

### Prayer Time API

```env
PRAYER_TIME_API_KEY=your-api-key
PRAYER_TIME_CITY=Surabaya
PRAYER_TIME_COUNTRY=Indonesia
```

## Deployment to Hostinger

### 1. Prepare Production Environment

```bash
# Switch to MySQL in .env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Set production values
APP_ENV=production
APP_DEBUG=false
APP_URL=https://masjidbukitpalma.or.id
```

### 2. Build Assets

```bash
npm run build
```

### 3. Upload to Hostinger

Upload all files to your Hostinger hosting via File Manager or FTP. Ensure the `public` directory contents map to the web root.

### 4. Server Setup

```bash
# Install dependencies (production only)
composer install --optimize-autoloader --no-dev

# Set permissions
chmod -R 775 storage bootstrap/cache

# Run migrations
php artisan migrate --force

# Seed initial data
php artisan db:seed

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link
```

### 5. Hostinger-Specific Configuration

- Set PHP version to 8.2+ in Hostinger panel
- Configure the document root to point to the `public` directory
- Enable SSL certificate for HTTPS
- Set up cron job for Laravel scheduler:
  ```
  * * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
  ```

## Project Structure

```
project/
├── app/
│   ├── Enums/               # TransactionType, CategoryZiswaf, TransactionStatus
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/       # Admin panel controllers
│   │   │   ├── Auth/        # Google OAuth controller
│   │   │   └── Public/      # Public-facing controllers
│   │   ├── Middleware/       # CheckRole middleware
│   │   └── Requests/        # Form request validation
│   ├── Livewire/            # Livewire components
│   │   ├── ApprovalTable.php
│   │   ├── DonationProgress.php
│   │   ├── DonationTrends.php
│   │   ├── FinancialDashboard.php
│   │   └── TransactionForm.php
│   ├── Models/              # Eloquent models
│   ├── Services/            # Business logic services
│   │   ├── ApprovalService.php
│   │   └── FinancialService.php
│   └── View/                # View composers/components
├── database/
│   ├── factories/           # Model factories (User, Transaction)
│   ├── migrations/          # Database schema
│   └── seeders/             # Data seeders
├── resources/
│   ├── css/                 # Tailwind CSS
│   ├── js/                  # Alpine.js, Axios
│   └── views/
│       ├── admin/           # Admin panel views
│       ├── auth/            # Authentication views
│       ├── components/      # Reusable Blade components
│       ├── layouts/         # Layout templates
│       ├── livewire/        # Livewire component views
│       ├── pdf/             # PDF report templates
│       └── public/          # Public page views
├── routes/
│   ├── web.php              # Public routes
│   ├── admin.php            # Admin routes (prefixed /admin)
│   └── auth.php             # Authentication routes (Breeze)
├── tests/
│   ├── Unit/                # Unit tests
│   └── Feature/             # Feature/integration tests
├── .env.example             # Environment template
├── composer.json            # PHP dependencies
├── package.json             # Node.js dependencies
├── phpunit.xml              # Test configuration
├── tailwind.config.js       # Tailwind configuration
└── vite.config.js           # Vite build configuration
```

## Financial System (ZISWAF)

The financial module implements full ZISWAF categorization:

| Category | Indonesian | Usage Rules |
|----------|-----------|-------------|
| **Zakat** | Zakat | Must be distributed to 8 groups of mustahiq |
| **Infaq** | Infaq | Can be used for operations and mosque programs |
| **Sedekah** | Sedekah | Can be used for social programs |
| **Wakaf** | Wakaf | Long-term assets only (land, buildings) |
| **Operasional** | Operasional | Operational funds from non-zakat sources |

### Transaction Workflow

```
Draft → Submitted → Approved ✓
                  → Rejected → Draft (can resubmit)
```

- **Bendahara** creates transactions (auto-draft status)
- **Bendahara** submits transactions for approval
- **Takmir Inti / Admin** approves or rejects with reason
- Only approved transactions appear in public financial dashboard

## License

This project is proprietary software developed for Masjid Bukit Palma.
