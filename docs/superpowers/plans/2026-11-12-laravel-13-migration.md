# Laravel 13 Project Migration Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Transform the complete static Famewoven website into a full Laravel 13 application running on PHP 8.4 with MySQL database persistence, modular Blade templates, 100% design parity, and step-by-step GitHub pushes.

**Architecture:** Modern Laravel 13 MVC architecture. Public assets (CSS, JS, videos) mapped to `public/`. Blade components and master layout for DRY UI elements. Eloquent models and migrations for lead capture (`strategy_calls` and `creator_applications`). Controllers with validation and CSRF protection.

**Tech Stack:** Laravel 13.x, PHP 8.4.27, MySQL (MariaDB 10.4), Tailwind CSS, GSAP 3.12, Blade templating, PHPUnit 12.

**Spec:** Current static HTML website structure in `C:\xampp\htdocs\famewoven-M3`.

## Global Constraints
- Target Framework: Laravel 13.x (`laravel/framework: ^13.0`).
- Runtime: PHP 8.4.27 (`C:\php82\php.exe`).
- Database: MySQL running on 127.0.0.1:3306 (`famewoven` database).
- Visual Design: 100% pixel-and-interaction fidelity to original static site.
- Version Control: Atomic, step-by-step commits and pushes to `origin/main`.

## Review Focus
1. CSRF and AJAX support for Strategy Call and Creator Application forms.
2. Route naming consistency across navigation links (`route('home')`, `route('services.show', ...)`).
3. Asset paths using `asset(...)` helper so all images, CSS, JS, and videos load reliably in sub-routes.
4. Active navigation state indicators on header and mobile drawer.
5. MySQL database encoding and constraints for UTF-8 and JSON compatibility.

---

### Task 1: Scaffolding Laravel 13 Skeleton & MySQL Database

**Files:**
- Create: `composer.json`, `artisan`, `bootstrap/app.php`, `config/`, `app/`, `routes/web.php`, `routes/console.php`, `.env`, `.env.example`
- Create DB: `famewoven` in MySQL

- [ ] **Step 1: Create MySQL database `famewoven`**
- [ ] **Step 2: Scaffold Laravel 13 project skeleton files**
- [ ] **Step 3: Configure `.env` with MySQL connection**
- [ ] **Step 4: Run initial migrations to verify database connection**
- [ ] **Step 5: Commit and push to GitHub**

---

### Task 2: Static Assets & Media Pipeline

**Files:**
- Move: `css/*` -> `public/css/*`
- Move: `js/*` -> `public/js/*`
- Move: `videos/*` -> `public/videos/*`
- Move: `robots.txt` -> `public/robots.txt`
- Move: `sitemap.xml` -> `public/sitemap.xml`

- [ ] **Step 1: Copy/move assets into `public/` directory**
- [ ] **Step 2: Verify asset integrity and permissions**
- [ ] **Step 3: Commit and push to GitHub**

---

### Task 3: Base Layout & Blade Components

**Files:**
- Create: `resources/views/layouts/app.blade.php`
- Create: `resources/views/components/header.blade.php`
- Create: `resources/views/components/footer.blade.php`
- Create: `resources/views/components/mobile-drawer.blade.php`

- [ ] **Step 1: Create master layout `layouts/app.blade.php` with all meta tags, Tailwind, fonts, and scripts**
- [ ] **Step 2: Create reusable header component with active link detection**
- [ ] **Step 3: Create mobile drawer navigation component**
- [ ] **Step 4: Create global footer component with all service links**
- [ ] **Step 5: Commit and push to GitHub**

---

### Task 4: Home, About, and Error Pages

**Files:**
- Create: `resources/views/home.blade.php`
- Create: `resources/views/about.blade.php`
- Create: `resources/views/errors/404.blade.php`
- Modify: `routes/web.php`
- Test: `tests/Feature/CorePagesTest.php`

- [ ] **Step 1: Convert `index.html` to `home.blade.php` extending `layouts/app`**
- [ ] **Step 2: Convert `about.html` to `about.blade.php` extending `layouts/app`**
- [ ] **Step 3: Convert `404.html` to `errors/404.blade.php` extending `layouts/app`**
- [ ] **Step 4: Add routes in `routes/web.php`**
- [ ] **Step 5: Write feature test verifying 200 OK for core routes**
- [ ] **Step 6: Run tests to verify they pass**
- [ ] **Step 7: Commit and push to GitHub**

---

### Task 5: Work Portfolio and Services Catalog & Subpages

**Files:**
- Create: `resources/views/work/index.blade.php`
- Create: `resources/views/work/case-study.blade.php`
- Create: `resources/views/services/index.blade.php`
- Create: `resources/views/services/*.blade.php` (14 individual service templates)
- Modify: `routes/web.php`
- Test: `tests/Feature/ServicesWorkTest.php`

- [ ] **Step 1: Create Work index and case-study Blade templates**
- [ ] **Step 2: Create Services catalog and 14 individual service templates**
- [ ] **Step 3: Register service and work routes in `routes/web.php`**
- [ ] **Step 4: Write feature tests for all service and work URLs**
- [ ] **Step 5: Run tests and verify PASS**
- [ ] **Step 6: Commit and push to GitHub**

---

### Task 6: Insights & SEO Routes

**Files:**
- Create: `resources/views/insights/index.blade.php`
- Modify: `routes/web.php`
- Test: `tests/Feature/InsightsSeoTest.php`

- [ ] **Step 1: Create Insights index Blade view**
- [ ] **Step 2: Register SEO routes and static xml/txt mappings**
- [ ] **Step 3: Write and pass feature tests**
- [ ] **Step 4: Commit and push to GitHub**

---

### Task 7: Database Models, Migrations & Form Controllers

**Files:**
- Create: `database/migrations/xxxx_create_strategy_calls_table.php`
- Create: `database/migrations/xxxx_create_creator_applications_table.php`
- Create: `app/Models/StrategyCall.php`
- Create: `app/Models/CreatorApplication.php`
- Create: `app/Http/Controllers/InquiryController.php`
- Create: `resources/views/contact.blade.php`
- Create: `resources/views/creators.blade.php`
- Modify: `routes/web.php`
- Test: `tests/Feature/InquiryTest.php`

- [ ] **Step 1: Create and run migrations for `strategy_calls` and `creator_applications`**
- [ ] **Step 2: Create Eloquent models with fillable fields**
- [ ] **Step 3: Create `InquiryController` handling POST submissions with validation and response**
- [ ] **Step 4: Build `contact.blade.php` and `creators.blade.php` with working forms**
- [ ] **Step 5: Write feature tests testing successful submission and validation errors**
- [ ] **Step 6: Run tests and verify database persistence in MySQL**
- [ ] **Step 7: Commit and push to GitHub**

---

### Task 8: Verification & Goal Completion

- [ ] **Step 1: Run full test suite (`php artisan test`)**
- [ ] **Step 2: Run static health checks and artisan optimize**
- [ ] **Step 3: Push final changes to GitHub**
- [ ] **Step 4: Confirm goal completion**

