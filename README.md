# Laravel Application

## Overview

This is a simple Laravel application.

## Prerequisites

Before you begin, ensure you have met the following requirements:

-   **PHP**: Version 8.0 or higher
-   **Composer**: Dependency management tool for PHP
-   **Database**: MySQL or other supported databases
-   **Node.js** and **npm**: For managing front-end dependencies and assets
-   **Laravel Installer** (optional): For creating Laravel projects (recommended)

## Setup Instructions

### 1. Clone the Repository

First, clone the repository from GitHub:

```bash
git clone https://github.com/your-username/your-repository.git
cd your-repository
```

### 2. Install PHP Dependencies

```
composer install
```

### 3. Configure Environment Variables

```
cp .env.example .env
```

### 4. Configure Sanctum

```env
SESSION_DOMAIN=localhost
FRONTEND_URL=http://localhost:5173
SANCTUM_STATEFUL_DOMAINS=localhost:8000
```

### 7. Generate Application Key

```
php artisan key:generate
```

### 8. Run Database Migrations

```
php artisan migrate
```

### 9. Install Front-End Dependencies

```
npm install
```

### 10. Compile Assets

```
npm run dev
php artisan serve
```
