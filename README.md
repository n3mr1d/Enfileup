# UploadAnon v2

![img](https://enfileup.prtcl.icu/storage/files/c7eb8fef-c8a0-4245-b95d-c0d0acc98d05.png)

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.0-red?style=for-the-badge&logo=laravel" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php" alt="PHP Version">
  <img src="https://img.shields.io/badge/Tailwind-4.0-38B2AC?style=for-the-badge&logo=tailwind-css" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">
</p>

**UploadAnon v2** is a modern, privacy-focused anonymous file sharing and pastebin service built with Laravel 12.0. It allows users to upload files and share text snippets without requiring registration, while providing optional password protection and expiration settings for enhanced security.

## ✨ Features

### 🔒 Privacy & Security

- **Anonymous uploads** - No user registration required
- **UUID-based access** - Files are accessed via unique identifiers instead of sequential IDs
- **Password protection** - Optional password protection for sensitive files
- **Cookie-based authentication** - Temporary access for password-protected files
- **IP tracking** - Logs uploader IP for abuse prevention (admin only)
- **Delete tokens** - Secure file deletion with unique tokens

### 📁 File Management

- **Multi-file uploads** - Upload up to 100 files simultaneously (max 100MB per file)
- **Bulk operations** - Manage multiple files as a single collection
- **Smart file handling** - Different display logic for images vs other file types
- **File expiration** - Automatic file cleanup with configurable expiration times
- **Download tracking** - View and download count statistics
- **File type detection** - Automatic MIME type detection and file extension handling

### 📝 Pastebin Functionality

- **Text sharing** - Share code snippets, notes, and text content
- **Syntax highlighting** - Support for various programming languages
- **Expiration options** - Set custom expiration times for pastes
- **Password protection** - Secure your sensitive text content

### 🎨 User Interface

- **Responsive design** - Works seamlessly on desktop and mobile devices
- **Dark theme** - Easy on the eyes with a modern dark UI
- **Intuitive interface** - Clean and user-friendly design
- **Real-time feedback** - Immediate upload progress and status updates

### ⚙️ Admin Features

- **Admin dashboard** - Monitor uploads, manage files, and view analytics
- **Visitor tracking** - Track visitor statistics and usage patterns
- **File management** - Admin tools for file moderation and cleanup
- **Analytics** - View upload trends and system usage

## 📋 Requirements

- **PHP 8.2+**
- **Composer**
- **Node.js & NPM**
- **SQLite/MySQL/PostgreSQL** (SQLite used by default)
- **Web server** (Apache/Nginx)

## 🚀 Quick Start

### Installation

1. **Clone the repository**

   ```bash
   git clone <repository-url>
   cd uploadAnonv2
   ```

2. **Install dependencies**

   ```bash
   composer install
   npm install
   ```

3. **Environment setup**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**

   ```bash
   touch database/database.sqlite  # For SQLite
   php artisan migrate
   ```

5. **Storage setup**

   ```bash
   php artisan storage:link
   ```

6. **Generate IDE helpers** (optional)
   ```bash
   php artisan ide-helper:generate
   ```

### Development

**Start the complete development environment:**

```bash
composer dev
```

This command starts all necessary services:

- Laravel development server
- Queue worker for background jobs
- Application log monitoring
- Vite development server for assets

**Or start services individually:**

```bash
php artisan serve                    # Laravel server
php artisan queue:listen --tries=1   # Queue worker
php artisan pail --timeout=0         # Log monitoring
npm run dev                          # Asset development
```

### Production Deployment

1. **Build assets**

   ```bash
   npm run build
   ```

2. **Optimize Laravel**

   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. **Set proper permissions**
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

## 🏗️ Architecture Overview

### Core Models

#### Files Model (`app/Models/Files.php`)

- Handles file uploads with UUID-based identification
- Manages password protection and expiration dates
- Tracks download/view counts and uploader information
- Supports bulk upload operations via `bulk_id` grouping
- Implements scopes for expired/active file filtering

#### Pastebin Model (`app/Models/Pastebin.php`)

- Manages text/code sharing functionality
- UUID-based anonymous access
- Supports expiration and password protection
- Tracks view and download statistics

#### Visitor Model (`app/Models/Visitor.php`)

- Analytics and visitor tracking
- Stores IP addresses and user agents
- Used for usage statistics and abuse prevention

### Key Features Implementation

**File Storage System**

- Files stored in `storage/app/public/files/`
- Naming convention: `{uuid}.{extension}`
- Access via Laravel's storage link system
- Image files have special display handling

**Security Features**

- Password protection uses MD5 hashing with cookie storage
- Delete tokens provide secure file removal
- UUID-based access prevents enumeration attacks
- IP logging for abuse tracking

**Expiration System**

- Configurable expiration times: 1 day, 7 days, 3 months, 1 year, never
- Database-level expiration tracking
- Automatic cleanup capabilities
- Scope methods for filtering expired content

### Route Structure

| Method     | Route                          | Description               |
| ---------- | ------------------------------ | ------------------------- |
| `GET`      | `/`                            | Main upload interface     |
| `POST`     | `/upload/files`                | File upload endpoint      |
| `GET/POST` | `/filesbin/{uuid}`             | Single file view/download |
| `GET`      | `/upload/files/bulk/{bulk_id}` | Bulk file management      |
| `POST`     | `/upload/deleted/action`       | File deletion             |
| `GET`      | `/pastebin`                    | Pastebin creation form    |
| `POST`     | `/pastebin`                    | Create new paste          |
| `GET/POST` | `/pastebin/{uuid}`             | View paste                |
| `GET`      | `/admin`                       | Admin login               |
| `GET`      | `/admin/dashboard`             | Admin dashboard           |

## 🛠️ Development Commands

### Testing

```bash
# Run all tests
composer test
# or
php artisan test

# Run specific test file
php artisan test tests/Feature/FileUploadTest.php

# Run PHPUnit directly
vendor/bin/phpunit
```

### Code Quality

```bash
# Format code with Laravel Pint
vendor/bin/pint

# Check code style
vendor/bin/pint --test
```

### Cache Management

```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Cache for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Database Operations

```bash
# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Fresh migration (destructive)
php artisan migrate:fresh

# Seed database
php artisan db:seed
```

## 📁 Project Structure

```
uploadAnonv2/
├── app/
│   ├── Http/Controllers/
│   │   ├── FilesController.php      # Main file handling logic
│   │   ├── PastebinController.php   # Pastebin functionality
│   │   └── AdminPost.php           # Admin authentication
│   └── Models/
│       ├── Files.php               # File model
│       ├── Pastebin.php           # Pastebin model
│       └── Visitor.php            # Visitor tracking
├── database/
│   └── migrations/                 # Database structure
├── resources/
│   ├── css/app.css                # Tailwind CSS styles
│   ├── js/app.js                  # Frontend JavaScript
│   └── views/                     # Blade templates
│       ├── welcome.blade.php      # Main upload interface
│       ├── bulkKontainer.blade.php # Bulk file view
│       └── pastebin.blade.php     # Pastebin interface
├── routes/web.php                 # Application routes
├── storage/app/public/files/      # File storage location
└── public/storage/                # Public storage link
```

## 🔧 Configuration

### Environment Variables

Key environment variables in `.env`:

```env
# Application
APP_NAME="UploadAnon v2"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Database (SQLite default)
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database/database.sqlite

# File Upload Limits
MAX_FILE_SIZE=102400  # 100MB in KB
MAX_FILES_PER_UPLOAD=100

# Admin Credentials
ADMIN_EMAIL=admin@example.com
ADMIN_PASSWORD=secure_password
```

### File Upload Configuration

Edit `php.ini` for larger file uploads:

```ini
upload_max_filesize = 100M
post_max_size = 1000M
max_file_uploads = 100
max_execution_time = 300
```

## 🛡️ Security Considerations

- **File validation**: All uploads are validated for type and size
- **UUID access**: Prevents file enumeration attacks
- **Password protection**: Optional security for sensitive files
- **IP logging**: Tracks uploaders for abuse prevention
- **Delete tokens**: Secure file removal system
- **Expiration system**: Automatic cleanup of old files
- **Admin authentication**: Protected admin routes

## 📊 Usage Examples

### File Upload

1. Visit the homepage
2. Select one or more files (max 100MB each)
3. Optionally set a password and expiration time
4. Click upload to receive a unique URL

### Pastebin

1. Navigate to `/pastebin`
2. Enter your text or code
3. Set optional password and expiration
4. Share the generated URL

### Bulk Upload

1. Select multiple files for upload
2. All files are grouped with a bulk ID
3. Manage all files through a single interface
4. Individual file access still available

## 🔍 Monitoring & Analytics

The application tracks:

- Upload statistics
- Download/view counts
- Visitor analytics
- File expiration data
- Storage usage
- Popular file types

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/amazing-feature`
3. Commit your changes: `git commit -m 'Add amazing feature'`
4. Push to the branch: `git push origin feature/amazing-feature`
5. Open a Pull Request

### Development Guidelines

- Follow PSR-12 coding standards
- Write tests for new features
- Use Laravel best practices
- Update documentation as needed
- Run `vendor/bin/pint` before committing

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🆘 Support

If you encounter any issues or have questions:

1. Check the [documentation](WARP.md)
2. Search existing issues
3. Create a new issue with detailed information
4. Provide steps to reproduce problems

## 🙏 Acknowledgments

- Built with [Laravel 12.0](https://laravel.com)
- Styled with [Tailwind CSS 4.0](https://tailwindcss.com)
- Powered by [Vite](https://vitejs.dev)
- Icons from [Heroicons](https://heroicons.com)

---

<p align="center">Made with ❤️ for anonymous file sharing</p>
