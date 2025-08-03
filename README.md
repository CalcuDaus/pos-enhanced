# 📊 Laravel Admin Dashboard Template

A clean, modern, and fully responsive Admin Dashboard built with **Laravel 12** and **Blade Templating**. Designed for rapid development of admin panels, backoffice apps, POS systems, and more.

---

## 🚀 Features

-   ✅ Blade template inheritance (component-based)
-   🌙 Light & Dark theme switcher
-   🎨 Accent color customization
-   🧭 RTL/LTR direction support
-   📱 Responsive design (mobile-friendly)
-   ⚙️ Dynamic layout settings panel
-   📊 Pre-integrated charts (ApexCharts, jsvectormap)
-   📦 Organized asset structure

---

## 🧰 Tech Stack

-   **Laravel 12**
-   **Blade Templates**
-   **Bootstrap 5**
-   **ApexCharts**
-   **JS Vector Map**
-   **Vanilla JS**

---

## 📁 Project Structure

```
resources/
├── views/
│   ├── layouts/
│   │   └── master.blade.php       # Main layout template
│   ├── components/                # Reusable Blade partials
│   │   ├── navbar.blade.php
│   │   ├── sidebar.blade.php
│   │   └── ...
│   └── pages/
│       ├── dashboard.blade.php
│       └── ...
public/
├── dist/assets/                  # CSS, JS, images
routes/
└── web.php                       # Route definitions
```

---

## ⚙️ Getting Started

### 1. Clone the Repo

```bash
git clone https://github.com/your-username/laravel-dashboard.git
cd laravel-dashboard
```

### 2. Install Dependencies

```bash
composer install
npm install && npm run build
```

### 3. Configure Environment

Copy `.env.example` to `.env` and configure your database:

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Run the App

```bash
php artisan serve
```

Visit [http://localhost:8000](http://localhost:8000)

---

## 🛠 Customization Guide

-   Modify layout in `resources/views/layouts/master.blade.php`
-   Add/extend pages in `resources/views/pages/`
-   Tweak components in `resources/views/components/`
-   Update assets inside `public/dist/assets/`

---

## 💡 License

This project is open-sourced under the [MIT License](LICENSE).

---

> Built with ❤️ by \[Mhd Firdaus]

---
