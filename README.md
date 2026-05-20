# XenonOS

> A modern project management system with real-time features

---

## Features

- **Project Management** - Create, manage, and track projects
- **Live Filtering** - Real-time search and filter with localStorage persistence
- **Task Management** - Organize tasks within projects
- **Team Collaboration** - Assign team members to projects
- **Client Management** - Track clients and their projects
- **Billing & Invoicing** - Financial management
- **Analytics & Reports** - Insights and data visualization
- **Draft System** - Auto-save forms to prevent data loss
- **Responsive Design** - Works on desktop and mobile

---

## Quick Start

### Requirements
- PHP 8.2+
- MySQL 5.7+
- Composer
- Node.js (for asset compilation)

### Installation

```bash
# Clone the repository
git clone https://github.com/munthasirdevs/XenonOS.git
cd XenonOS

# Install dependencies
composer install
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Create database and update .env
# DB_DATABASE=xenonos
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed

# Start the server
php artisan serve
```

Visit `http://127.0.0.1:8000`

---

## Documentation

| Document | Description |
|----------|-------------|
| [PROJECT_DOCUMENTATION.md](docs/PROJECT_DOCUMENTATION.md) | Full feature documentation |
| [QUICK_REFERENCE.md](docs/QUICK_REFERENCE.md) | Quick reference guide |
| [API_DOCUMENTATION.md](docs/API_DOCUMENTATION.md) | API endpoints |

---

## Key Features Explained

### 1. Project Create with Draft System
The create project form automatically saves to localStorage and allows manual draft saving/loading.

```bash
# View the create page
GET /projects/create
```

### 2. Live Filtering
Projects can be filtered in real-time without page reloads.

```bash
# Filter examples
GET /projects?search=client&status=active&client=1&sort=newest
```

### 3. Navbar State Persistence
Sidebar open/close state is saved to localStorage and persists across sessions.

### 4. Flash Notifications
Success/error messages show as toast notifications using SweetAlert2.

```php
// Usage in controller
return redirect()->route('projects.index')
    ->with('success', 'Project created!');
```

---

## Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Tailwind CSS, JavaScript
- **Database**: MySQL
- **Auth**: Laravel Sanctum
- **Notifications**: SweetAlert2
- **Icons**: Material Symbols

---

## Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Web/           # Web controllers
│   │   └── Api/          # API controllers
│   └── Models/           # Eloquent models
├── resources/views/
│   ├── layouts/          # Layout files
│   ├── components/       # Blade components
│   └── projects/         # Project views
├── routes/
│   ├── web.php           # Web routes
│   └── api.php           # API routes
├── public/
│   ├── css/             # Stylesheets
│   └── js/              # JavaScript files
└── docs/                # Documentation
```

---

## Contributing

1. Create a feature branch
2. Make your changes
3. Run tests
4. Submit a pull request

---

## License

Proprietary - All Rights Reserved

---

## Support

For support, contact the development team or create an issue on GitHub.