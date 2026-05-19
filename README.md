# LCW Lighting Co - E-Commerce Platform

## Table of Contents

- [Project Overview](#project-overview)
- [Technical Specifications](#technical-specifications)
- [System Architecture](#system-architecture)
- [Prerequisites & Requirements](#prerequisites--requirements)
- [Local Development Setup](#local-development-setup)
- [Database Schema](#database-schema)
- [API Documentation](#api-documentation)
- [Environment Configuration](#environment-configuration)
- [Debugging Guide](#debugging-guide)
- [Deployment (Apache/LAMP)](#deployment-apachelamp)
- [Troubleshooting](#troubleshooting)

---

## Project Overview

LCW Lighting Co is a comprehensive e-commerce platform built for an Australian lighting company specializing in LED lighting products, commercial and residential lighting solutions. The platform consists of three main components:

### Key Features

- **Admin Panel**: Complete backend management system for products, orders, customers, inventory, CMS, and business operations
- **Customer Frontend**: Public-facing e-commerce website with product catalog, shopping cart, checkout, user accounts, wishlists, and blog
- **Shop Owner API**: RESTful API for mobile application enabling shop owners to manage their business operations

### Business Information

- **Company**: LCW Lighting Co
- **Email**: info@lcwlighting.com
- **Phone**: +61 469 302 231
- **Warehouses**: Mount Annan, Revesby, Seven Hills, Silverwater (Australia)

---

## Technical Specifications

### Backend Stack

- **Framework**: Laravel 10.x
- **PHP Version**: 8.1 or higher
- **Database**: MySQL 5.7+ / 8.x (Primary), PostgreSQL (Supported), SQLite (Supported)
- **Authentication**: Laravel Sanctum (API), Session-based (Web)
- **ORM**: Eloquent ORM

### Frontend Stack

- **Template Engine**: Blade Templates
- **Asset Bundler**: Vite
- **JavaScript**: Vanilla JS with jQuery
- **CSS Framework**: Custom CSS (located in `assets/css/` and `public/front/css/`, `public/admin_panel/`)

### Third-Party Integrations & Packages

| Package | Purpose | Version |
|---------|---------|---------|
| `laravel/sanctum` | API Authentication | ^3.2 |
| `stripe/stripe-php` | Payment Gateway | ^17.5 |
| `barryvdh/laravel-dompdf` | PDF Generation (Invoices) | ^3.1 |
| `mpdf/mpdf` | Advanced PDF Generation | ^8.2 |
| `maatwebsite/excel` | Excel Export/Import | 3.1.48 |
| `yajra/laravel-datatables-oracle` | DataTables Server-side | ^10.3.1 |
| `guzzlehttp/guzzle` | HTTP Client | ^7.2 |
| `nesbot/carbon` | Date/Time Manipulation | ^2.68 |
| `stevebauman/location` | IP Geolocation | ^7.0 |

### Development Tools

| Tool | Purpose | Version |
|------|---------|---------|
| `laravel/sail` | Docker Development Environment | ^1.18 |
| `laravel/pint` | Code Style Fixer | ^1.0 |
| `phpunit/phpunit` | Testing Framework | ^10.1 |
| `fakerphp/faker` | Fake Data Generation | ^1.9.1 |
| `spatie/laravel-ignition` | Error Page | ^2.0 |

---

## System Architecture

### Application Layers

```
┌─────────────────────────────────────────────────────────────┐
│                     LCW E-Commerce Platform                  │
└─────────────────────────────────────────────────────────────┘
                              │
        ┌─────────────────────┼─────────────────────┐
        │                     │                     │
        ▼                     ▼                     ▼
┌───────────────┐    ┌───────────────┐    ┌──────────────┐
│  Admin Panel  │    │   Frontend    │    │ Shop Owner   │
│  (Web-based)  │    │  (Customer)   │    │     API      │
└───────────────┘    └───────────────┘    └──────────────┘
        │                     │                     │
        └─────────────────────┼─────────────────────┘
                              │
                              ▼
                    ┌──────────────────┐
                    │  Laravel Backend │
                    │   (MVC Pattern)  │
                    └──────────────────┘
                              │
                ┌─────────────┼─────────────┐
                │             │             │
                ▼             ▼             ▼
        ┌──────────┐  ┌──────────┐  ┌──────────┐
        │  MySQL   │  │  Redis   │  │   AWS    │
        │ Database │  │  Cache   │  │   S3     │
        └──────────┘  └──────────┘  └──────────┘
```

### Folder Structure

```
LCW/
├── app/
│   ├── Console/           # Artisan commands
│   ├── Exceptions/        # Exception handlers
│   ├── Helpers/           # Helper functions
│   ├── Http/
│   │   ├── Controllers/   # Application controllers
│   │   │   ├── Admin/     # Admin panel controllers
│   │   │   ├── Front/     # Customer frontend controllers
│   │   │   └── API/       # API controllers (Shop Owner App)
│   │   ├── Middleware/    # Custom middleware
│   │   └── Kernel.php     # Middleware registration
│   ├── Library/           # Custom libraries (UserLogActivity)
│   ├── Mail/              # Mail templates & classes
│   ├── Models/            # Eloquent models
│   ├── Providers/         # Service providers
│   └── Traits/            # Reusable traits
├── bootstrap/             # Application bootstrap
├── config/                # Configuration files
├── database/
│   ├── migrations/        # Database migrations
│   ├── seeders/           # Database seeders
│   └── factories/         # Model factories
├── public/                # Public web root
│   ├── admin_panel/       # Admin assets (CSS, JS, images)
│   ├── front/             # Frontend assets
│   ├── uploads/           # User uploaded files
│   └── index.php          # Entry point
├── resources/
│   ├── views/             # Blade templates
│   │   ├── Admin/         # Admin panel views
│   │   ├── Front/         # Customer frontend views
│   │   └── mail/          # Email templates
│   ├── css/               # Source CSS
│   ├── js/                # Source JavaScript
│   └── lang/              # Localization files
├── routes/
│   ├── web.php            # Web routes (Admin + Frontend)
│   ├── api.php            # API routes (Shop Owner App)
│   ├── console.php        # Console routes
│   └── channels.php       # Broadcast channels
├── storage/               # Application storage
│   ├── app/               # Application files
│   ├── framework/         # Framework cache/sessions
│   └── logs/              # Application logs
├── tests/                 # Test suites
├── vendor/                # Composer dependencies
├── .env                   # Environment variables (not in repo)
├── artisan               # Artisan CLI
├── composer.json         # PHP dependencies
└── package.json          # Node dependencies
```

### MVC Pattern Implementation

- **Models** (`app/Models/`): Database interactions via Eloquent ORM
- **Views** (`resources/views/`): Blade templates separated by Admin/Front
- **Controllers** (`app/Http/Controllers/`): Business logic organized by feature areas

### Middleware Configuration

Custom middleware includes:
- `isAdmin`: Protects admin panel routes
- `isUser`: Protects customer account routes
- `prevent-back-history`: Prevents browser back button caching

---

## Prerequisites & Requirements

### Server Requirements

- **PHP**: 8.1 or higher
- **Composer**: 2.x
- **Node.js**: 16.x or higher
- **NPM**: 8.x or higher
- **Web Server**: Apache 2.4+ with `mod_rewrite` enabled OR Nginx
- **Database**: MySQL 5.7+ / 8.x OR PostgreSQL 12+ OR MariaDB 10.3+

### Required PHP Extensions

```bash
php -m  # Check installed extensions
```

Required extensions:
- BCMath
- Ctype
- cURL
- DOM
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PCRE
- PDO
- PDO_MySQL (or PDO_PGSQL)
- Tokenizer
- XML
- GD or Imagick (for image processing)
- Zip

### System Tools

- **Git**: Version control
- **MySQL Client**: Database management
- **Text Editor/IDE**: VS Code, PhpStorm, Sublime, etc.

### Optional (for local development)

- **Docker Desktop**: If using Laravel Sail
- **Redis**: For caching and queues (production recommended)
- **Mailpit/Mailtrap**: For testing emails locally

---

## Local Development Setup

### Step 1: Clone Repository

```bash
cd ~/Documents/Repos
git clone <repository-url> LCW
cd LCW
```

### Step 2: Install PHP Dependencies

```bash
composer install
```

If you encounter memory issues:
```bash
php -d memory_limit=-1 /usr/local/bin/composer install
```

### Step 3: Environment Configuration

Create `.env` file from example:
```bash
cp .env.example .env
```

Or create manually with these minimum settings:
```env
APP_NAME="LCW Lighting Co"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lcw_database
DB_USERNAME=root
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@lcwlighting.com"
MAIL_FROM_NAME="${APP_NAME}"

# Payment Gateway (for testing)
STRIPE_KEY=pk_test_your_test_key
STRIPE_SECRET=sk_test_your_test_secret
STRIPE_BASE_URI=https://api.stripe.com

# File Storage
FILESYSTEM_DISK=local
# For production with S3:
# FILESYSTEM_DISK=s3
# AWS_ACCESS_KEY_ID=
# AWS_SECRET_ACCESS_KEY=
# AWS_DEFAULT_REGION=ap-southeast-2
# AWS_BUCKET=
```

### Step 4: Generate Application Key

```bash
php artisan key:generate
```

This will set `APP_KEY` in your `.env` file.

### Step 5: Create Database

Create a MySQL database:
```bash
mysql -u root -p
```

```sql
CREATE DATABASE lcw_database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Step 6: Run Migrations

```bash
php artisan migrate
```

If you need to reset and re-run:
```bash
php artisan migrate:fresh
```

### Step 7: Seed Database (Optional)

If seeders are configured:
```bash
php artisan db:seed
```

Or migrate and seed together:
```bash
php artisan migrate:fresh --seed
```

### Step 8: Create Storage Symlink

Link public storage to storage/app/public:
```bash
php artisan storage:link
```

### Step 9: Install Frontend Dependencies

```bash
npm install
```

### Step 10: Build Frontend Assets

For development (with hot reload):
```bash
npm run dev
```

For production build:
```bash
npm run build
```

### Step 11: Start Development Server

```bash
php artisan serve
```

Application will be available at: **http://127.0.0.1:8000**

**Admin Panel**: http://127.0.0.1:8000/admin
**Frontend**: http://127.0.0.1:8000/

### Alternative: Using Laravel Sail (Docker)

If you prefer Docker-based development:

```bash
# Install Sail
composer require laravel/sail --dev

# Publish Sail configuration
php artisan sail:install

# Start Sail containers
./vendor/bin/sail up -d

# Run migrations
./vendor/bin/sail artisan migrate

# Access application at http://localhost
```

### Clear Caches (if needed)

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

---

## Database Schema

The application uses 50+ database tables organized by functional areas.

### Authentication & User Management

#### `master_admins`
Admin users with role-based access control.
- **Key Fields**: `user_id`, `user_name`, `email`, `password`, `role_id`, `user_type`
- **Relations**: Belongs to role_privileges

#### `user_registers`
Customer/end-user accounts.
- **Key Fields**: `customer_id`, `email`, `phone_no`, `full_name`, `password`, `otp`, `is_otp_verified`
- **Relations**: Has many orders, wishlists, addresses

#### `user_addresses`
Multiple shipping/billing addresses per user.
- **Key Fields**: `user_id`, `address_type`, `first_name`, `last_name`, `street`, `city`, `state`, `postal_code`
- **Relations**: Belongs to user_registers

#### `role_privileges`
Role-based permissions for admin users.
- **Key Fields**: `role_name`, `permissions` (JSON)
- **Relations**: Has many master_admins

### Master Data Tables

#### `country_masters`
Countries list for address management.
- **Key Fields**: `country_name`, `country_code`, `status`

#### `state_masters`
States/provinces by country.
- **Key Fields**: `country_id`, `state_name`, `status`
- **Relations**: Belongs to country_masters

#### `city_masters`
Cities by state.
- **Key Fields**: `state_id`, `city_name`, `status`
- **Relations**: Belongs to state_masters

#### `pin_code_masters`
Postal/PIN codes.
- **Key Fields**: `city_id`, `pin_code`, `status`
- **Relations**: Belongs to city_masters

#### `gst_masters`
GST/Tax rates configuration.
- **Key Fields**: `gst_name`, `gst_percentage`, `status`

#### `brands_masters`
Product brands.
- **Key Fields**: `brand_name`, `brand_logo`, `slug_url`, `status`

### Product Catalog

#### `category_masters`
Top-level product categories.
- **Key Fields**: `category_name`, `category_image`, `slug_url`, `meta_title`, `status`
- **Relations**: Has many sub_category_masters, products

#### `sub_category_masters`
Second-level categories.
- **Key Fields**: `category_id`, `sub_category_name`, `slug_url`, `status`
- **Relations**: Belongs to category_masters, has many sub_sub_category_masters

#### `sub_sub_category_masters`
Third-level categories.
- **Key Fields**: `sub_category_id`, `sub_sub_category_name`, `slug_url`, `status`
- **Relations**: Belongs to sub_category_masters

#### `category_trees`
Hierarchical category relationships.
- **Key Fields**: `category_id`, `sub_category_id`, `sub_sub_category_id`

#### `all_categories`
Flattened view of all categories for quick lookups.

#### `product_parameter_masters`
Product filter parameters (e.g., Voltage, Wattage, IP Rating).
- **Key Fields**: `parameter_name`, `parameter_type`, `status`

#### `product_parameter_value_masters`
Parameter values (e.g., 240V, 12V for Voltage parameter).
- **Key Fields**: `parameter_id`, `parameter_value`, `status`
- **Relations**: Belongs to product_parameter_masters

#### `products`
Main products table.
- **Key Fields**: 
  - `product_id`, `product_name`, `sku`, `slug_url`
  - `category_id`, `sub_category_id`, `sub_sub_category_id`, `brand_id`
  - `price`, `offer_price`, `current_stock`
  - `gst_id`, `is_gst`
  - `description`, `specification`, `short_description`
  - `meta_title`, `meta_keywords`, `meta_description`
  - `status` (available/not_available)
- **Relations**: 
  - Belongs to category, sub_category, brand, gst_masters
  - Has many products_gallery_images, products_description_images, products_specifications, products_pdf_files, products_parameter_data

#### `products_gallery_images`
Product image gallery.
- **Key Fields**: `product_id`, `image_path`, `display_order`
- **Relations**: Belongs to products

#### `products_description_images`
Images within product description.
- **Key Fields**: `product_id`, `image_path`
- **Relations**: Belongs to products

#### `products_specifications`
Product technical specifications in key-value pairs.
- **Key Fields**: `product_id`, `specification_key`, `specification_value`
- **Relations**: Belongs to products

#### `products_pdf_files`
Downloadable product documents (datasheets, manuals).
- **Key Fields**: `product_id`, `pdf_name`, `pdf_path`
- **Relations**: Belongs to products

#### `products_parameter_data`
Product filter attributes (voltage, wattage, etc.).
- **Key Fields**: `product_id`, `parameter_id`, `parameter_value_id`
- **Relations**: Belongs to products, product_parameter_masters

#### `showcase_images`
Homepage/promotional showcase images.
- **Key Fields**: `image_path`, `title`, `link`, `display_order`, `status`

### Inventory Management

#### `stock_management_data`
Stock level tracking.
- **Key Fields**: `product_id`, `stock_quantity`, `reorder_level`, `last_updated`
- **Relations**: Belongs to products

#### `stock_management_logs`
Stock movement history (additions, deductions, adjustments).
- **Key Fields**: `product_id`, `movement_type`, `quantity`, `remarks`, `created_by`
- **Relations**: Belongs to products

### Shopping Cart & Checkout

#### `carts`
User shopping carts.
- **Key Fields**: `user_id`, `cart_token` (for guest carts), `total_amount`, `status`
- **Relations**: Has many cart_products

#### `cart_products`
Products in cart.
- **Key Fields**: `cart_id`, `product_id`, `quantity`, `price`, `total`
- **Relations**: Belongs to carts, products

#### `user_wishlists`
User wishlist/favorites.
- **Key Fields**: `user_id`, `product_id`
- **Relations**: Belongs to user_registers, products

### Orders & Payments

#### `orders`
Customer orders.
- **Key Fields**: 
  - `order_id`, `user_id`, `order_date_time`
  - `sub_total`, `tax_amount`, `shipping_charges`, `total_amount`
  - `couponcode`, `couponcode_amount`, `is_couponcode`
  - `order_status` (pending, confirmed, inprocess, packed, shipped, delivered, cancelled)
  - `payment_method`, `payment_status`, `stripe_payment_id`
  - `billing_address_*` (full billing address fields)
  - `shipping_address_*` (full shipping address fields)
  - `shipping_same_as_billing`
- **Relations**: 
  - Belongs to user_registers
  - Has many order_products, order_status_logs

#### `order_products`
Products within each order.
- **Key Fields**: `order_id`, `product_id`, `product_name`, `quantity`, `price`, `total`
- **Relations**: Belongs to orders, products

#### `order_status_logs`
Order status change history/tracking.
- **Key Fields**: `order_id`, `old_status`, `new_status`, `remarks`, `changed_by`, `changed_at`
- **Relations**: Belongs to orders

### CMS (Content Management)

#### `home_cms_data`
Homepage content blocks.
- **Key Fields**: `section_name`, `title`, `subtitle`, `content`, `image_path`, `status`

#### `about_us_cms`
About Us page content.
- **Key Fields**: `section_title`, `content`, `image`, `status`

#### `about_us_testimonials`
Customer testimonials.
- **Key Fields**: `customer_name`, `company`, `testimonial`, `rating`, `image`, `status`

#### `page_content_cms_data`
Generic page content (Terms, Privacy, etc.).
- **Key Fields**: `page_slug`, `page_title`, `content`, `meta_title`, `status`

#### `faq_data`
FAQ items.
- **Key Fields**: `question`, `answer`, `category`, `display_order`, `status`

#### `blogs`
Blog posts.
- **Key Fields**: `title`, `slug`, `content`, `featured_image`, `author`, `published_at`, `meta_title`, `status`

### Enquiries & Communications

#### `contact_us_enquiries`
Contact form submissions.
- **Key Fields**: `name`, `email`, `phone`, `subject`, `message`, `status`, `replied_at`

#### `reseller_enquiries`
Reseller/partnership enquiries.
- **Key Fields**: `business_name`, `contact_person`, `email`, `phone`, `message`, `status`

### System Configuration

#### `general_settings`
Global application settings (site name, email, phone, etc.).
- **Key Fields**: `setting_key`, `setting_value`, `setting_type`

#### `visual_settings`
Theme and visual customization settings (logo, colors, etc.).
- **Key Fields**: `setting_key`, `setting_value`

#### `tmp_forms`
Temporary form data storage.
- **Key Fields**: `form_type`, `form_data` (JSON), `session_id`, `expires_at`

### Laravel Default Tables

- `users`: Default Laravel users table (may not be used)
- `password_reset_tokens`: Password reset tokens
- `personal_access_tokens`: Sanctum API tokens
- `failed_jobs`: Failed queue jobs

### Entity Relationship Summary

```
Users (user_registers)
  ├── user_addresses (1:N)
  ├── orders (1:N)
  ├── carts (1:N)
  └── user_wishlists (1:N)

Products
  ├── category_masters (N:1)
  ├── sub_category_masters (N:1)
  ├── brands_masters (N:1)
  ├── gst_masters (N:1)
  ├── products_gallery_images (1:N)
  ├── products_specifications (1:N)
  ├── products_pdf_files (1:N)
  ├── products_parameter_data (1:N)
  └── stock_management_data (1:1)

Orders
  ├── user_registers (N:1)
  ├── order_products (1:N)
  └── order_status_logs (1:N)

Categories (Hierarchical)
  category_masters → sub_category_masters → sub_sub_category_masters
```

---

## API Documentation

### Base Configuration

**Base URL**: `http://your-domain.com/api`
**Authentication**: Bearer Token (Laravel Sanctum)
**Content-Type**: `application/json`

### Authentication Flow

#### 1. Check Mobile Number Exists

```http
POST /api/lsm-shop-owner-mobile-number-exists
```

**Request**:
```json
{
  "mobile_no": "+61469302231"
}
```

**Response**:
```json
{
  "status": 200,
  "exists": true,
  "message": "Mobile number exists"
}
```

#### 2. Register Mobile Number (Send OTP)

```http
POST /api/lsm-shop-owner-register-mobile-number
```

**Request**:
```json
{
  "mobile_no": "+61469302231"
}
```

**Response**:
```json
{
  "status": 200,
  "message": "OTP sent successfully",
  "otp": "123456"
}
```

#### 3. Shop Owner Registration

```http
POST /api/lsm-shop-owner-register
```

**Request**:
```json
{
  "first_name": "John",
  "last_name": "Doe",
  "email": "john@example.com",
  "mobile_no": "+61469302231",
  "password": "SecurePass123",
  "company_name": "ABC Lighting",
  "address": "123 Main St",
  "city": "Sydney",
  "otp": "123456"
}
```

**Response**:
```json
{
  "status": 200,
  "message": "Registration successful",
  "user": {
    "id": 1,
    "customer_id": "CUST001",
    "full_name": "John Doe",
    "email": "john@example.com"
  },
  "token": "1|abc123xyz..."
}
```

#### 4. Shop Owner Login

```http
POST /api/lsm-shop-owner-login
```

**Request**:
```json
{
  "email": "john@example.com",
  "password": "SecurePass123"
}
```

**Response**:
```json
{
  "status": 200,
  "message": "Login successful",
  "user": {
    "id": 1,
    "customer_id": "CUST001",
    "full_name": "John Doe",
    "email": "john@example.com"
  },
  "token": "2|xyz789abc..."
}
```

### Protected Endpoints (Require Authentication)

All endpoints below require the `Authorization: Bearer {token}` header.

#### Get Country List

```http
GET /api/lsm-country-list
```

**Response**:
```json
{
  "status": 200,
  "data": [
    {
      "id": 1,
      "country_name": "Australia",
      "country_code": "AU"
    }
  ]
}
```

#### Get State List

```http
POST /api/lsm-state-list
```

**Request**:
```json
{
  "country_id": 1
}
```

**Response**:
```json
{
  "status": 200,
  "data": [
    {
      "id": 1,
      "state_name": "New South Wales",
      "country_id": 1
    }
  ]
}
```

#### Get City List

```http
POST /api/lsm-city-list
```

**Request**:
```json
{
  "state_id": 1
}
```

#### Submit KYC

```http
POST /api/lsm-shop-owner-kyc-submit
Authorization: Bearer {token}
```

**Request**:
```json
{
  "business_license": "file_base64",
  "tax_id": "ABN12345678",
  "identity_proof": "file_base64"
}
```

#### Get Account Details

```http
GET /api/lsm-shop-owner-get-account-details
Authorization: Bearer {token}
```

**Response**:
```json
{
  "status": 200,
  "data": {
    "id": 1,
    "full_name": "John Doe",
    "email": "john@example.com",
    "phone_no": "+61469302231",
    "company_name": "ABC Lighting",
    "address": "123 Main St",
    "city": "Sydney"
  }
}
```

#### Update Account Details

```http
POST /api/lsm-shop-owner-update-account-details
Authorization: Bearer {token}
```

**Request**:
```json
{
  "first_name": "John",
  "last_name": "Doe",
  "company_name": "ABC Lighting Ltd",
  "address": "456 New St",
  "city": "Melbourne"
}
```

#### Get Category List

```http
GET /api/lsm-shop-owner-get-category-list
Authorization: Bearer {token}
```

**Response**:
```json
{
  "status": 200,
  "data": [
    {
      "id": 1,
      "category_name": "LED Lights",
      "sub_categories": [
        {
          "id": 1,
          "sub_category_name": "LED Bulbs"
        }
      ]
    }
  ]
}
```

#### Add Category

```http
POST /api/lsm-shop-owner-add-category
Authorization: Bearer {token}
```

**Request**:
```json
{
  "category_ids": [1, 2, 3]
}
```

#### Get Products List

```http
POST /api/lsm-shop-owner-products-list
Authorization: Bearer {token}
```

**Request**:
```json
{
  "category_id": 1,
  "page": 1,
  "per_page": 20
}
```

**Response**:
```json
{
  "status": 200,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "product_name": "LED Bulb 9W",
        "sku": "LED-9W-001",
        "price": 15.99,
        "offer_price": 12.99,
        "current_stock": 150,
        "product_main_image": "url_to_image"
      }
    ],
    "total": 45,
    "per_page": 20
  }
}
```

#### Add Product

```http
POST /api/lsm-shop-owner-add-product-of-category
Authorization: Bearer {token}
```

**Request**:
```json
{
  "product_name": "LED Panel 40W",
  "sku": "LED-40W-PNL",
  "category_id": 1,
  "price": 89.99,
  "offer_price": 79.99,
  "description": "High efficiency LED panel",
  "current_stock": 50
}
```

#### Update Product

```http
POST /api/lsm-shop-owner-update-product-of-category
Authorization: Bearer {token}
```

**Request**:
```json
{
  "product_id": 1,
  "price": 85.99,
  "current_stock": 75
}
```

#### Delete Product

```http
POST /api/lsm-shop-owner-delete-product-of-category
Authorization: Bearer {token}
```

**Request**:
```json
{
  "product_id": 1
}
```

### Error Responses

```json
{
  "status": 401,
  "message": "Unauthorized user"
}
```

```json
{
  "status": 422,
  "message": "Validation failed",
  "errors": {
    "email": ["The email field is required."]
  }
}
```

```json
{
  "status": 500,
  "message": "Internal server error"
}
```

---

## Environment Configuration

### Complete .env Reference

Below is a comprehensive list of environment variables used in the application.

#### Application Settings

```env
APP_NAME="LCW Lighting Co"
APP_ENV=local                    # local, staging, production
APP_KEY=base64:...              # Generated by php artisan key:generate
APP_DEBUG=true                  # false in production
APP_URL=http://localhost:8000   # Your domain in production
```

#### Database Configuration

```env
DB_CONNECTION=mysql             # mysql, pgsql, sqlite, sqlsrv
DB_HOST=127.0.0.1              # Database host
DB_PORT=3306                   # 3306 for MySQL, 5432 for PostgreSQL
DB_DATABASE=lcw_database       # Your database name
DB_USERNAME=root               # Database username
DB_PASSWORD=                   # Database password
```

#### Mail Configuration

```env
MAIL_MAILER=smtp               # smtp, sendmail, mailgun, ses, postmark
MAIL_HOST=smtp.mailtrap.io     # SMTP server
MAIL_PORT=2525                 # 587 (TLS), 465 (SSL), 25 (plain)
MAIL_USERNAME=null             # SMTP username
MAIL_PASSWORD=null             # SMTP password
MAIL_ENCRYPTION=tls            # tls, ssl, or null
MAIL_FROM_ADDRESS="info@lcwlighting.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**Production Mail Example (Gmail)**:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
```

#### Stripe Payment Gateway

```env
STRIPE_KEY=pk_test_...          # Publishable key (frontend)
STRIPE_SECRET=sk_test_...       # Secret key (backend)
STRIPE_BASE_URI=https://api.stripe.com

# For production, use live keys:
# STRIPE_KEY=pk_live_...
# STRIPE_SECRET=sk_live_...
```

#### PayPal Payment Gateway (Optional)

```env
PAYPAL_CLIENT_ID=
PAYPAL_CLIENT_SECRET=
```

#### AWS S3 File Storage (Optional)

```env
FILESYSTEM_DISK=local          # local or s3

# If using S3:
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=ap-southeast-2  # Sydney region
AWS_BUCKET=lcw-uploads
AWS_URL=
AWS_ENDPOINT=
AWS_USE_PATH_STYLE_ENDPOINT=false
```

#### Cache Configuration

```env
CACHE_DRIVER=file              # file, redis, memcached, database
CACHE_PREFIX=lcw_cache_
```

**For Redis cache**:
```env
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
REDIS_CLIENT=phpredis          # or predis
```

#### Session Configuration

```env
SESSION_DRIVER=file            # file, cookie, database, redis
SESSION_LIFETIME=120           # Minutes
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
```

#### Queue Configuration

```env
QUEUE_CONNECTION=sync          # sync, database, redis, sqs, beanstalkd

# For database queue:
# QUEUE_CONNECTION=database

# For Redis queue:
# QUEUE_CONNECTION=redis
# REDIS_QUEUE=default
```

#### Broadcasting (Optional)

```env
BROADCAST_DRIVER=log           # pusher, redis, log, null
```

#### Logging

```env
LOG_CHANNEL=stack              # stack, single, daily, slack, syslog
LOG_LEVEL=debug                # debug, info, notice, warning, error, critical
```

#### Additional Services

```env
# Location Service (IP-based geolocation)
LOCATION_DRIVER=ip-api         # or maxmind

# Sanctum (API Authentication)
SANCTUM_STATEFUL_DOMAINS=localhost,127.0.0.1
```

### Environment-Specific Configurations

#### Local Development

```env
APP_ENV=local
APP_DEBUG=true
MAIL_MAILER=log                # Logs emails instead of sending
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

#### Staging

```env
APP_ENV=staging
APP_DEBUG=true
APP_URL=https://staging.lcwlighting.com
MAIL_MAILER=smtp               # Use real SMTP
CACHE_DRIVER=redis
QUEUE_CONNECTION=database
```

#### Production

```env
APP_ENV=production
APP_DEBUG=false                # MUST be false
APP_URL=https://lcwlighting.com
MAIL_MAILER=smtp
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
FILESYSTEM_DISK=s3             # Use S3 for scalability
```

---

## Debugging Guide

### Laravel Logging

#### Log Files Location

```bash
storage/logs/laravel.log        # Current log file
storage/logs/laravel-YYYY-MM-DD.log  # Daily logs
```

#### View Recent Logs

```bash
# Last 50 lines
tail -n 50 storage/logs/laravel.log

# Follow logs in real-time
tail -f storage/logs/laravel.log

# Search for errors
grep "ERROR" storage/logs/laravel.log
```

#### Writing to Logs

```php
// In any controller or class
use Illuminate\Support\Facades\Log;

Log::info('User logged in', ['user_id' => $userId]);
Log::warning('Stock running low', ['product_id' => $productId]);
Log::error('Payment failed', ['error' => $exception->getMessage()]);
Log::debug('Variable dump', ['data' => $someVariable]);
```

### Debug Helper Functions

#### `dd()` - Dump and Die

```php
// Dump variable and stop execution
dd($variable);

// Dump multiple variables
dd($user, $order, $products);
```

#### `dump()` - Dump and Continue

```php
// Dump variable but continue execution
dump($variable);

// In Blade templates
@dump($variable)
```

#### `ddd()` - Dump, Die, and Debug

```php
// Enhanced dd() with better formatting
ddd($variable);
```

### Database Query Debugging

#### Enable Query Logging

Add to any controller method or route:

```php
use Illuminate\Support\Facades\DB;

// Enable query log
DB::enableQueryLog();

// Your code here
$products = Product::where('status', 'available')->get();

// Get executed queries
$queries = DB::getQueryLog();
dd($queries);
```

#### Log All Queries

Add to `app/Providers/AppServiceProvider.php`:

```php
use Illuminate\Support\Facades\DB;

public function boot()
{
    if (config('app.debug')) {
        DB::listen(function ($query) {
            Log::info(
                $query->sql,
                [
                    'bindings' => $query->bindings,
                    'time' => $query->time
                ]
            );
        });
    }
}
```

### Debugging with Tinker

Laravel Tinker is an interactive REPL (Read-Eval-Print Loop):

```bash
php artisan tinker
```

```php
// Test database connection
>>> DB::connection()->getPdo();

// Query data
>>> App\Models\Product::count();
>>> App\Models\User::find(1);

// Test relationships
>>> $product = App\Models\Product::first();
>>> $product->category->category_name;

// Test email
>>> Mail::raw('Test email', function($msg) {
    $msg->to('test@example.com')->subject('Test');
});
```

### Common Debug Scenarios

#### 1. Debugging Authentication Issues

```php
// Check if user is authenticated
use Illuminate\Support\Facades\Auth;

if (Auth::check()) {
    dd('User is logged in', Auth::user());
} else {
    dd('User is not logged in');
}

// Check API token
$user = auth('sanctum')->user();
dd($user);
```

#### 2. Debugging Form Validation

```php
// In controller
try {
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8'
    ]);
} catch (\Illuminate\Validation\ValidationException $e) {
    dd($e->errors());
}

// Or dump all request data
dd($request->all());
```

#### 3. Debugging Payment Gateway

```php
// Log Stripe API calls
try {
    $charge = \Stripe\Charge::create([...]);
    Log::info('Stripe charge successful', ['charge' => $charge]);
} catch (\Stripe\Exception\CardException $e) {
    Log::error('Stripe card error', [
        'message' => $e->getMessage(),
        'code' => $e->getStripeCode()
    ]);
}
```

#### 4. Debugging Email Issues

```php
// Test mail configuration
php artisan tinker

>>> config('mail.mailers.smtp');
>>> config('mail.from');
```

Check `storage/logs/laravel.log` for mail errors.

#### 5. Debugging Routes

```bash
# List all routes
php artisan route:list

# Filter by name
php artisan route:list --name=product

# Filter by path
php artisan route:list --path=api
```

### Performance Debugging

#### Check Route Performance

```php
// Add to routes/web.php or specific route
Route::get('/test', function() {
    $start = microtime(true);
    
    // Your code here
    $products = Product::with('category')->get();
    
    $end = microtime(true);
    $executionTime = ($end - $start);
    
    dd("Execution time: {$executionTime} seconds");
});
```

#### Database Query Performance

```php
// Check N+1 query problem
DB::enableQueryLog();

$orders = Order::all();
foreach ($orders as $order) {
    echo $order->user->full_name;  // Triggers N queries!
}

dd(DB::getQueryLog());  // Will show many queries

// Solution: Use eager loading
$orders = Order::with('user')->get();
```

### Using Xdebug (Advanced)

#### Install Xdebug

```bash
# macOS (Homebrew)
pecl install xdebug

# Linux
sudo apt-get install php-xdebug
```

#### Configure Xdebug

Add to `php.ini`:

```ini
[xdebug]
zend_extension=xdebug.so
xdebug.mode=debug
xdebug.start_with_request=yes
xdebug.client_host=127.0.0.1
xdebug.client_port=9003
```

#### VS Code Configuration

Install "PHP Debug" extension, then create `.vscode/launch.json`:

```json
{
    "version": "0.2.0",
    "configurations": [
        {
            "name": "Listen for Xdebug",
            "type": "php",
            "request": "launch",
            "port": 9003,
            "pathMappings": {
                "/path/to/project": "${workspaceFolder}"
            }
        }
    ]
}
```

### Debugging Commands

```bash
# Clear all caches
php artisan optimize:clear

# Specific cache clears
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Check application health
php artisan about

# Check database connection
php artisan migrate:status

# Check queue jobs
php artisan queue:failed
```

---

## Deployment (Apache/LAMP)

### Server Requirements

#### Minimum Specifications

- **OS**: Ubuntu 20.04/22.04 LTS or CentOS 7/8
- **Apache**: 2.4+
- **PHP**: 8.1 or higher
- **MySQL**: 8.0+ or MariaDB 10.3+
- **Memory**: 2GB RAM minimum, 4GB+ recommended
- **Storage**: 20GB minimum

#### Required Apache Modules

```bash
# Check enabled modules
apache2ctl -M

# Enable required modules
sudo a2enmod rewrite
sudo a2enmod ssl
sudo a2enmod headers
```

Required modules:
- mod_rewrite (URL rewriting)
- mod_ssl (HTTPS)
- mod_headers (header manipulation)

### Step-by-Step Deployment

#### 1. Install LAMP Stack

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install Apache
sudo apt install apache2 -y

# Install MySQL
sudo apt install mysql-server -y
sudo mysql_secure_installation

# Install PHP 8.1 and extensions
sudo apt install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update

sudo apt install php8.1 php8.1-fpm php8.1-cli php8.1-common \
    php8.1-mysql php8.1-xml php8.1-curl php8.1-gd \
    php8.1-mbstring php8.1-zip php8.1-bcmath \
    php8.1-intl php8.1-readline libapache2-mod-php8.1 -y

# Verify PHP version
php -v
```

#### 2. Install Composer

```bash
cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Verify
composer --version
```

#### 3. Create Database

```bash
sudo mysql -u root -p
```

```sql
CREATE DATABASE lcw_production CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'lcw_user'@'localhost' IDENTIFIED BY 'SecurePassword123!';
GRANT ALL PRIVILEGES ON lcw_production.* TO 'lcw_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### 4. Clone and Setup Application

```bash
# Create web directory
sudo mkdir -p /var/www/lcwlighting

# Clone repository
cd /var/www/lcwlighting
sudo git clone <repository-url> .

# Set ownership
sudo chown -R www-data:www-data /var/www/lcwlighting
sudo chmod -R 755 /var/www/lcwlighting
```

#### 5. Install Dependencies

```bash
cd /var/www/lcwlighting

# Install PHP dependencies (production mode)
sudo -u www-data composer install --no-dev --optimize-autoloader

# Install Node dependencies and build assets
npm install
npm run build
```

#### 6. Configure Environment

```bash
# Copy environment file
sudo cp .env.example .env
sudo chown www-data:www-data .env
sudo chmod 640 .env

# Edit environment variables
sudo nano .env
```

**Production `.env` configuration**:

```env
APP_NAME="LCW Lighting Co"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://www.lcwlighting.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lcw_production
DB_USERNAME=lcw_user
DB_PASSWORD=SecurePassword123!

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=info@lcwlighting.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@lcwlighting.com"
MAIL_FROM_NAME="${APP_NAME}"

STRIPE_KEY=pk_live_...
STRIPE_SECRET=sk_live_...
STRIPE_BASE_URI=https://api.stripe.com

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=database

FILESYSTEM_DISK=local
```

#### 7. Generate Application Key

```bash
sudo -u www-data php artisan key:generate
```

#### 8. Run Migrations

```bash
# Run migrations
sudo -u www-data php artisan migrate --force

# Seed database if needed
sudo -u www-data php artisan db:seed --force
```

#### 9. Set Permissions

```bash
# Storage and cache directories must be writable
sudo chown -R www-data:www-data /var/www/lcwlighting/storage
sudo chown -R www-data:www-data /var/www/lcwlighting/bootstrap/cache

sudo chmod -R 775 /var/www/lcwlighting/storage
sudo chmod -R 775 /var/www/lcwlighting/bootstrap/cache

# Create storage symlink
sudo -u www-data php artisan storage:link
```

#### 10. Optimize Application

```bash
# Cache configuration
sudo -u www-data php artisan config:cache

# Cache routes
sudo -u www-data php artisan route:cache

# Cache views
sudo -u www-data php artisan view:cache

# Optimize autoloader
sudo -u www-data composer dump-autoload --optimize
```

#### 11. Configure Apache Virtual Host

Create virtual host configuration:

```bash
sudo nano /etc/apache2/sites-available/lcwlighting.conf
```

**HTTP Configuration** (will redirect to HTTPS):

```apache
<VirtualHost *:80>
    ServerName www.lcwlighting.com
    ServerAlias lcwlighting.com
    
    # Redirect all HTTP to HTTPS
    Redirect permanent / https://www.lcwlighting.com/
</VirtualHost>
```

**HTTPS Configuration**:

```apache
<VirtualHost *:443>
    ServerName www.lcwlighting.com
    ServerAlias lcwlighting.com
    ServerAdmin info@lcwlighting.com
    
    DocumentRoot /var/www/lcwlighting/public
    
    <Directory /var/www/lcwlighting/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    # Logging
    ErrorLog ${APACHE_LOG_DIR}/lcw_error.log
    CustomLog ${APACHE_LOG_DIR}/lcw_access.log combined
    
    # SSL Configuration (after obtaining SSL certificate)
    SSLEngine on
    SSLCertificateFile /etc/letsencrypt/live/lcwlighting.com/fullchain.pem
    SSLCertificateKeyFile /etc/letsencrypt/live/lcwlighting.com/privkey.pem
    Include /etc/letsencrypt/options-ssl-apache.conf
</VirtualHost>
```

#### 12. Enable Site and Restart Apache

```bash
# Disable default site
sudo a2dissite 000-default.conf

# Enable new site
sudo a2ensite lcwlighting.conf

# Test configuration
sudo apache2ctl configtest

# Restart Apache
sudo systemctl restart apache2
```

#### 13. Install SSL Certificate (Let's Encrypt)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-apache -y

# Obtain SSL certificate
sudo certbot --apache -d lcwlighting.com -d www.lcwlighting.com

# Auto-renewal test
sudo certbot renew --dry-run
```

Certbot will automatically configure SSL in your Apache virtual host.

#### 14. Setup Cron Jobs

```bash
# Edit crontab for www-data user
sudo crontab -u www-data -e
```

Add Laravel scheduler:

```cron
* * * * * cd /var/www/lcwlighting && php artisan schedule:run >> /dev/null 2>&1
```

#### 15. Setup Queue Worker (Optional)

If using queues, setup supervisor:

```bash
sudo apt install supervisor -y

# Create supervisor config
sudo nano /etc/supervisor/conf.d/lcw-worker.conf
```

```ini
[program:lcw-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/lcwlighting/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/lcwlighting/storage/logs/worker.log
stopwaitsecs=3600
```

```bash
# Start supervisor
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start lcw-worker:*
```

### Post-Deployment Checks

#### 1. Verify Application

```bash
# Check if site is accessible
curl https://www.lcwlighting.com

# Check PHP info
echo "<?php phpinfo(); ?>" | sudo tee /var/www/lcwlighting/public/info.php
# Visit: https://www.lcwlighting.com/info.php
# DELETE THIS FILE after checking!
```

#### 2. Test Database Connection

```bash
cd /var/www/lcwlighting
sudo -u www-data php artisan tinker

>>> DB::connection()->getPdo();
```

#### 3. Check Permissions

```bash
# Should return www-data
ls -la /var/www/lcwlighting/storage
```

#### 4. Monitor Logs

```bash
# Apache logs
sudo tail -f /var/log/apache2/lcw_error.log

# Laravel logs
sudo tail -f /var/www/lcwlighting/storage/logs/laravel.log
```

### Security Hardening

#### 1. Protect .env File

```bash
sudo chmod 600 /var/www/lcwlighting/.env
```

#### 2. Disable Directory Listing

Ensure `.htaccess` has:
```apache
Options -Indexes
```

#### 3. Hide Server Information

Edit Apache config:
```bash
sudo nano /etc/apache2/conf-enabled/security.conf
```

```apache
ServerTokens Prod
ServerSignature Off
```

#### 4. Setup Firewall

```bash
sudo ufw allow 'Apache Full'
sudo ufw allow 22
sudo ufw enable
```

### Deployment Checklist

- [ ] Server meets minimum requirements
- [ ] LAMP stack installed and configured
- [ ] Database created with proper user privileges
- [ ] Application code deployed
- [ ] Composer dependencies installed (--no-dev --optimize-autoloader)
- [ ] Node dependencies installed and assets built
- [ ] `.env` configured for production (APP_DEBUG=false)
- [ ] Application key generated
- [ ] Migrations run successfully
- [ ] Storage and cache permissions set (775)
- [ ] Storage symlink created
- [ ] Application optimized (config, route, view cache)
- [ ] Apache virtual host configured
- [ ] SSL certificate installed
- [ ] Cron jobs configured
- [ ] Queue workers setup (if using queues)
- [ ] Logs are writable and monitored
- [ ] Firewall configured
- [ ] Backup strategy in place

---

## Troubleshooting

### Common Issues and Solutions

#### 1. 500 Internal Server Error

**Symptoms**: Blank white page or "500 Internal Server Error"

**Diagnosis**:
```bash
# Check Apache error log
sudo tail -n 50 /var/log/apache2/error.log

# Check Laravel log
tail -n 50 storage/logs/laravel.log

# Check PHP errors
php -l public/index.php
```

**Common Causes & Solutions**:

a) **Missing or incorrect .env file**
```bash
# Verify .env exists
ls -la .env

# Check APP_KEY is set
grep APP_KEY .env

# Regenerate if needed
php artisan key:generate
```

b) **Wrong file permissions**
```bash
# Set correct permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

c) **Cached configuration with wrong values**
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

d) **PHP extensions missing**
```bash
# Check required extensions
php -m | grep -E 'pdo|mysql|mbstring|xml|curl'

# Install missing extensions
sudo apt install php8.1-mysql php8.1-mbstring php8.1-xml
sudo systemctl restart apache2
```

#### 2. Blank White Page (No Error Message)

**Cause**: `APP_DEBUG=false` hides errors

**Solution**:
```bash
# Temporarily enable debug (NEVER in production long-term)
nano .env
# Change: APP_DEBUG=true

php artisan config:clear

# Check storage/logs/laravel.log for actual error
```

#### 3. Storage Permission Errors

**Symptoms**: "Permission denied" errors when uploading files or writing logs

**Error Example**:
```
file_put_contents(/var/www/lcwlighting/storage/logs/laravel.log): failed to open stream: Permission denied
```

**Solution**:
```bash
# Fix storage permissions
sudo chown -R www-data:www-data storage
sudo chmod -R 775 storage

# Fix bootstrap/cache
sudo chown -R www-data:www-data bootstrap/cache
sudo chmod -R 775 bootstrap/cache

# For development (less restrictive)
sudo chmod -R 777 storage bootstrap/cache  # NOT for production
```

#### 4. Database Connection Errors

**Error**: "SQLSTATE[HY000] [2002] Connection refused"

**Solutions**:

a) **Check database is running**
```bash
sudo systemctl status mysql
sudo systemctl start mysql
```

b) **Verify credentials in .env**
```bash
grep DB_ .env

# Test connection
mysql -u lcw_user -p lcw_production
```

c) **Check MySQL bind address**
```bash
sudo nano /etc/mysql/mysql.conf.d/mysqld.cnf

# Ensure this line exists:
bind-address = 127.0.0.1

sudo systemctl restart mysql
```

d) **Grant privileges**
```sql
GRANT ALL PRIVILEGES ON lcw_production.* TO 'lcw_user'@'localhost';
FLUSH PRIVILEGES;
```

#### 5. .htaccess Not Working (404 on all pages except home)

**Symptoms**: Homepage works but all other routes return 404

**Cause**: mod_rewrite not enabled or AllowOverride not set

**Solution**:
```bash
# Enable mod_rewrite
sudo a2enmod rewrite

# Verify AllowOverride in virtual host
sudo nano /etc/apache2/sites-available/lcwlighting.conf

# Should have:
# <Directory /var/www/lcwlighting/public>
#     AllowOverride All
# </Directory>

# Restart Apache
sudo systemctl restart apache2
```

#### 6. Storage Link Missing

**Error**: Images/files not loading, 404 on `/storage/*` URLs

**Cause**: Storage symlink not created

**Solution**:
```bash
# Create symlink
php artisan storage:link

# Verify symlink exists
ls -la public/storage

# Should show: public/storage -> ../storage/app/public

# If it fails, manually create
ln -s ../storage/app/public public/storage
```

#### 7. Mail Not Sending

**Symptoms**: Emails not being sent, timeout errors

**Diagnosis**:
```bash
# Test SMTP connection
telnet smtp.gmail.com 587

# Check Laravel logs
tail -f storage/logs/laravel.log

# Test with Tinker
php artisan tinker
>>> Mail::raw('Test', function($msg) { $msg->to('test@example.com')->subject('Test'); });
```

**Common Solutions**:

a) **Incorrect SMTP credentials**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password  # NOT your regular password!
MAIL_ENCRYPTION=tls
```

b) **Gmail requires App Password**
- Go to Google Account → Security → 2-Step Verification → App Passwords
- Generate app password and use in `.env`

c) **Firewall blocking port 587**
```bash
sudo ufw allow out 587/tcp
```

d) **Use log driver for testing**
```env
MAIL_MAILER=log  # Writes emails to storage/logs/laravel.log
```

#### 8. Stripe Payment Errors

**Error**: "No API key provided" or "Invalid API key"

**Solutions**:

a) **Check environment variables**
```bash
grep STRIPE .env

# Should have:
# STRIPE_KEY=pk_live_... (or pk_test_...)
# STRIPE_SECRET=sk_live_... (or sk_test_...)
```

b) **Clear config cache**
```bash
php artisan config:clear
```

c) **Verify keys are correct**
- Live keys start with `pk_live_` and `sk_live_`
- Test keys start with `pk_test_` and `sk_test_`
- Never mix live and test keys

d) **Check SSL certificate**
Stripe requires HTTPS. Ensure SSL is properly configured.

#### 9. Session Not Persisting (Logged Out Immediately)

**Cause**: Session configuration or cookie issues

**Solutions**:

a) **Check session permissions**
```bash
ls -la storage/framework/sessions
sudo chmod -R 775 storage/framework/sessions
```

b) **Verify .env session settings**
```env
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_DOMAIN=null  # Or .yourdomain.com for subdomains
SESSION_SECURE_COOKIE=true  # If using HTTPS
```

c) **Clear sessions**
```bash
php artisan session:table  # If using database sessions
php artisan migrate
```

d) **Check APP_KEY is set**
```bash
php artisan key:generate
php artisan config:clear
```

#### 10. Composer Install Errors

**Error**: "Your requirements could not be resolved"

**Solutions**:

a) **Update Composer**
```bash
sudo composer self-update
```

b) **Clear Composer cache**
```bash
composer clear-cache
composer install
```

c) **Increase memory limit**
```bash
php -d memory_limit=-1 /usr/local/bin/composer install
```

d) **Check PHP version**
```bash
php -v
# Should be 8.1 or higher

# Update PHP if needed
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php8.1
```

#### 11. npm Build Errors

**Error**: "Cannot find module" or build failures

**Solutions**:

a) **Clear npm cache**
```bash
rm -rf node_modules package-lock.json
npm cache clean --force
npm install
```

b) **Check Node version**
```bash
node -v
# Should be 16.x or higher

# Update Node using nvm
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
nvm install 16
nvm use 16
```

#### 12. High Memory Usage / Slow Performance

**Solutions**:

a) **Enable OpCache**
```bash
sudo nano /etc/php/8.1/apache2/php.ini

# Add/uncomment:
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=10000
opcache.revalidate_freq=60

sudo systemctl restart apache2
```

b) **Use Redis for caching**
```bash
sudo apt install redis-server
sudo systemctl start redis

# Update .env
CACHE_DRIVER=redis
SESSION_DRIVER=redis
```

c) **Optimize queries (check N+1 problems)**
```php
// Bad: Triggers N queries
$orders = Order::all();
foreach ($orders as $order) {
    echo $order->user->name;
}

// Good: Single query with eager loading
$orders = Order::with('user')->get();
```

d) **Enable production optimizations**
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Getting Help

If issues persist:

1. **Check Laravel logs**: `storage/logs/laravel.log`
2. **Check Apache logs**: `/var/log/apache2/error.log`
3. **Enable debug mode temporarily**: `APP_DEBUG=true`
4. **Search Laravel documentation**: https://laravel.com/docs/10.x
5. **Community forums**: 
   - Laravel Forum: https://laracasts.com/discuss
   - Stack Overflow: Tag `laravel`
   - GitHub Issues (for package-specific problems)

---

## License

Proprietary - LCW Lighting Co. All rights reserved.

## Support

For technical support, contact:
- **Email**: info@lcwlighting.com
- **Phone**: +61 469 302 231

---

**Last Updated**: May 19, 2026