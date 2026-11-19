# Project Requirements & Environment Setup Guide

## Student Travel Portal (Laravel 12)

This document contains all system prerequisites, required environments, libraries, extensions, configurations, and step-by-step instructions to run the **Student Travel Portal** project.

---

## 1. System Prerequisites & Environment

To run this application locally, ensure your system meets the following environment requirements:

| Component | Minimum Version | Recommended Version |
| :--- | :--- | :--- |
| **PHP** | `^8.2.0` | `8.2.x` or `8.3.x` |
| **Composer** | `2.x` | Latest `2.7+` |
| **Node.js** | `18.x` | `20.x LTS` or higher |
| **NPM** | `9.x` | `10.x` or higher |
| **Database** | SQLite 3.35+ or MySQL 8.0+ / MariaDB 10.4+ | SQLite (pre-configured) |
| **Git** | `2.x` | Latest |

---

## 2. Required PHP Extensions

The following PHP extensions must be enabled in your `php.ini` file:

- `bcmath`
- `ctype`
- `curl`
- `dom`
- `fileinfo`
- `filter`
- `hash`
- `json`
- `mbstring`
- `openssl`
- `pcre`
- `pdo`
- `pdo_sqlite` (if using SQLite database)
- `pdo_mysql` (if using MySQL database)
- `session`
- `tokenizer`
- `xml`

---

## 3. Libraries & Dependencies

### Backend Dependencies (Composer)

#### Production (`require`)
- **`php`**: `^8.2` - Core runtime
- **`laravel/framework`**: `^12.0` - Laravel Web Framework
- **`laravel/tinker`**: `^2.10.1` - Interactive REPL for Laravel

#### Development (`require-dev`)
- **`fakerphp/faker`**: `^1.23` - Data generator for factories and testing
- **`laravel/pail`**: `^1.2.2` - CLI log streaming tool
- **`laravel/pint`**: `^1.24` - PHP code style fixer
- **`laravel/sail`**: `^1.41` - Docker development environment
- **`mockery/mockery`**: `^1.6` - Mock object framework
- **`nunomaduro/collision`**: `^8.6` - CLI error reporting
- **`phpunit/phpunit`**: `^11.5.50` - Unit and feature testing framework

### Frontend Dependencies (NPM)

#### Development (`devDependencies`)
- **`vite`**: `^7.0.7` - Frontend build tool and dev server
- **`@tailwindcss/vite`**: `^4.0.0` - Official Tailwind CSS Vite plugin
- **`tailwindcss`**: `^4.0.0` - Utility-first CSS framework
- **`laravel-vite-plugin`**: `^2.0.0` - Laravel integration with Vite
- **`axios`**: `^1.11.0` - Promise-based HTTP client for API requests
- **`concurrently`**: `^9.0.1` - Run multiple CLI tasks simultaneously

---

## 4. Environment Variables Configuration (`.env`)

Key configuration values required in `.env`:

```env
APP_NAME="Student Travel Portal"
APP_ENV=local
APP_KEY=                 # Generated via php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration (Default: SQLite)
DB_CONNECTION=sqlite
# For SQLite, the database file is located at: database/database.sqlite

# If switching to MySQL, configure:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=travel_portal_db
# DB_USERNAME=root
# DB_PASSWORD=

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

---

## 5. Step-by-Step Setup & Run Instructions

Follow these exact terminal commands to set up and run the application from scratch:

### Step 1: Clone the Repository
```bash
git clone https://github.com/syedahsanalibaqri/Student-Travel-Portal-using-Laravel.git
cd Student-Travel-Portal-using-Laravel
```

### Step 2: Install PHP Dependencies
```bash
composer install
```

### Step 3: Install Node Dependencies
```bash
npm install
```

### Step 4: Setup Environment File
```bash
# On Linux / macOS / Git Bash:
cp .env.example .env

# On Windows PowerShell:
Copy-Item .env.example .env
```

### Step 5: Generate Application Encryption Key
```bash
php artisan key:generate
```

### Step 6: Prepare SQLite Database & Run Migrations
```bash
# Ensure sqlite database file exists (if not created automatically):
# On Windows PowerShell:
New-Item -ItemType File -Path database/database.sqlite -Force

# On Linux / macOS:
touch database/database.sqlite

# Run database migrations:
php artisan migrate
```

### Step 7: Build Frontend Assets
```bash
# For development with live reload:
npm run dev

# OR for production build:
npm run build
```

### Step 8: Start the Local Development Server
```bash
php artisan serve
```

Access the application in your browser at:
`http://localhost:8000` or `http://127.0.0.1:8000`
