# WARP.md

This file provides guidance to WARP (warp.dev) when working with code in this repository.

## Application Overview

This is a Laravel 12.0 application called "uploadAnonv2" - an anonymous file upload service with pastebin functionality. It allows users to upload files and text with optional password protection and expiration settings.

## Development Commands

### Setup and Installation
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies  
npm install

# Copy environment file and generate app key
cp .env.example .env
php artisan key:generate

# Create database file (SQLite default)
touch database/database.sqlite

# Run database migrations
php artisan migrate

# Generate IDE helper files for better autocomplete
php artisan ide-helper:generate
```

### Development Workflow
```bash
# Start the complete development environment (recommended)
composer dev
# This starts: Laravel server, queue worker, log monitoring, and Vite dev server

# Or start services individually:
php artisan serve                    # Start Laravel development server
php artisan queue:listen --tries=1   # Start queue worker
php artisan pail --timeout=0         # Monitor application logs
npm run dev                          # Start Vite development server for assets
```

### Building and Assets
```bash
# Build assets for production
npm run build

# Build assets for development
npm run dev
```

### Testing and Quality
```bash
# Run all tests
composer test
# Or: php artisan test

# Run PHPUnit tests directly  
vendor/bin/phpunit

# Run specific test file
php artisan test tests/Feature/ExampleTest.php

# Run Laravel Pint code formatter
vendor/bin/pint

# Clear various Laravel caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Database Operations
```bash
# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Reset and re-run all migrations
php artisan migrate:fresh

# Run database seeders
php artisan db:seed
```

## Application Architecture

### Core Models and Functionality

**Files Model** (`app/Models/Files.php`)
- Handles file uploads with UUID-based identification
- Supports password protection and expiration dates
- Tracks download/view counts and stores uploader IP
- Bulk upload support via `bulk_id` grouping
- File storage in `storage/app/public/files/`

**Pastebin Model** (`app/Models/Pastebin.php`)
- Text/code sharing functionality similar to traditional pastebins
- Uses UUIDs for anonymous access
- Supports expiration and password protection

**Visitor Model** (`app/Models/Visitor.php`)
- Tracks visitor information (IP, user agent) for analytics

### Key Features

**File Upload System**
- Multi-file upload support (max 100MB per file)
- Image vs. non-image file handling with different display logic
- Expiration options: 1 day, 7 days, 3 months, 1 year, never
- Password protection with cookie-based authentication
- Bulk download functionality for multiple files

**Frontend Stack**
- Tailwind CSS 4.0 for styling
- Vite for asset bundling
- Laravel Blade templating
- Responsive design with dark theme

### Route Structure

**File Routes** (`routes/web.php`)
- `POST /upload/files` - File upload endpoint
- `GET /filesbin/{uuid}` - Single file view/download
- `GET /upload/files/bulk/{bulk_id}` - Bulk file management
- `POST /upload/deleted/action` - File deletion

**Pastebin Routes**
- `GET /pastebin` - Pastebin creation form
- `POST /pastebin` - Create new paste
- `GET /pastebin/{uuid}` - View paste

**Admin Routes** (Protected)
- `GET /admin` - Admin login
- `GET /admin/dashboard` - Admin dashboard

### File Storage Architecture

Files are stored using Laravel's storage system:
- Location: `storage/app/public/files/`
- Naming: `{uuid}.{extension}`
- Access: Via Laravel's storage link (`php artisan storage:link`)

### Development Patterns

**UUID-based Access**: All files and pastes use UUIDs instead of incremental IDs for privacy
**Cookie-based Authentication**: Password-protected files use MD5-hashed cookies for temporary access
**Bulk Operations**: Multiple file uploads are grouped using a common `bulk_id`
**Expiration Handling**: Database-level expiration tracking with scope methods for cleanup

## Technology Stack

- **Backend**: Laravel 12.0, PHP 8.2+
- **Frontend**: Tailwind CSS 4.0, Blade templates, Vite
- **Database**: SQLite (default), supports MySQL/PostgreSQL
- **File Storage**: Laravel Storage (local disk)
- **Testing**: PHPUnit 11.5+
- **Code Quality**: Laravel Pint

## Important Files

- `routes/web.php` - All application routes
- `app/Http/Controllers/FilesController.php` - Main file handling logic
- `app/Http/Controllers/PastebinController.php` - Text sharing functionality  
- `resources/views/welcome.blade.php` - Main upload interface
- `composer.json` - PHP dependencies and custom scripts
- `vite.config.js` - Asset build configuration
