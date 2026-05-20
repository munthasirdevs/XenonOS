# XenonOS - Project Documentation

## Overview
This document covers all major features and changes implemented in the XenonOS project.

---

## Table of Contents
1. [Project Create Page](#1-project-create-page)
2. [Live Filtering System](#2-live-filtering-system)
3. [Navbar State Persistence](#3-navbar-state-persistence)
4. [Flash Notification System](#4-flash-notification-system)
5. [Draft System for Forms](#5-draft-system-for-forms)
6. [File Structure](#6-file-structure)

---

## 1. Project Create Page

### Route
- **URL**: `/projects/create`
- **Method**: `GET`
- **Controller**: `App\Http\Controllers\Web\ProjectController`
- **Function**: `create()`

### Form Fields
| Field | Type | Required | Options |
|-------|------|---------|---------|
| name | text | Yes | - |
| description | textarea | No | - |
| client_id | select | Yes | From clients table |
| status | select | Yes | active, pending, on_hold |
| start_date | date | No | - |
| end_date | date | No | Must be after start_date |
| priority | select | Yes | low, medium, high, urgent |
| budget | number | No | Decimal value |

### Files Modified
- `app/Http/Controllers/Web/ProjectController.php` - Added `create()` and `store()` methods
- `routes/web.php` - Added route for create and store
- `resources/views/projects/create.blade.php` - New view file

### Files Created
- `resources/views/projects/create.blade.php`

---

## 2. Live Filtering System

### Features
- **Real-time Search**: Searches project name, description, and client name
- **Status Filter**: Filter by active, completed, pending, on_hold
- **Client Filter**: Filter by specific client
- **Sort Options**: Newest first, Oldest first, By deadline
- **Debounced Search**: 300ms delay before API call
- **LocalStorage Persistence**: Filter state saved and restored on page reload

### API Endpoint
- **URL**: `/projects/filter`
- **Method**: `GET`
- **Controller**: `App\Http\Controllers\Web\ProjectController`
- **Function**: `filterJson()`

### Query Parameters
| Parameter | Description |
|-----------|-------------|
| search | Search term for name, description, client |
| status | Project status filter |
| client | Client ID filter |
| sort | new, oldest, deadline |

### Files Modified
- `app/Http/Controllers/Web/ProjectController.php` - Added `filterJson()` method
- `routes/web.php` - Added filter route
- `public/js/projects-index.js` - Complete rewrite for live filtering
- `resources/views/projects/index.blade.php` - Updated filter forms

---

## 3. Navbar State Persistence

### Features
- **Sidebar Toggle**: Open/close sidebar on click
- **State Persistence**: Saves sidebar state to localStorage
- **Responsive**: Different behavior on mobile vs desktop
- **Section Collapse**: Expandable/collapsible navigation sections

### LocalStorage Key
```
xenonos_sidebar_state
```

### Values
- `open` - Sidebar is open
- `closed` - Sidebar is closed

### Desktop Behavior
- Sidebar open by default
- Remembers user's preference
- Main content margin adjusts (260px when open)

### Mobile Behavior
- Sidebar closed by default
- Opens as overlay
- Close on overlay click or link click

### Files Created
- `public/css/navbar.css` - All navbar styles
- `public/js/navbar.js` - Sidebar toggle, section collapse logic

### Files Modified
- `resources/views/components/navbar.blade.php` - Cleaned up inline styles/scripts
- `resources/views/layouts/app.blade.php` - Single navbar include
- All view files - Removed duplicate navbar includes

---

## 4. Flash Notification System

### Features
- **SweetAlert2 Integration**: Beautiful toast notifications
- **Types**: Success, Error, Warning
- **Auto-dismiss**: Closes after 2-4 seconds
- **Session-based**: Uses Laravel session flash data

### Usage
```php
// In Controller
return redirect()->route('projects.show', $project)
    ->with('success', 'Project created successfully.');

// Or for error
return redirect()->back()
    ->with('error', 'Something went wrong.');
```

### Files
- `resources/views/layouts/app.blade.php` - Includes SweetAlert CDN and flash elements
- `public/js/swal-custom.js` - Custom SweetAlert wrapper
- `public/js/global.js` - Flash message detection and display

---

## 5. Draft System for Forms

### Features
- **Auto-save**: Form data saved to localStorage on input change
- **Manual Save**: "Save Draft" button for explicit save
- **Load Draft**: Restore previously saved draft
- **Delete Draft**: Remove saved draft
- **Visual Indicator**: Badge shows when draft is saved
- **Clear Form**: Reset form and remove saved data

### LocalStorage Keys
```
project_draft       - Saved draft data
project_create_form - Auto-save data (cleared on submit)
```

### Files
- `resources/views/projects/create.blade.php` - Draft buttons and JavaScript

### JavaScript Functions
```javascript
saveDraft()   // Save current form state
loadDraft()   // Load saved draft
deleteDraft() // Delete saved draft
clearFormData() // Clear form and localStorage
```

---

## 6. File Structure

### Controllers
```
app/Http/Controllers/
├── Web/
│   └── ProjectController.php    # Web project routes
└── Api/
    └── ProjectController.php    # API project routes
```

### Views
```
resources/views/
├── layouts/
│   └── app.blade.php           # Main layout (single navbar)
├── components/
│   └── navbar.blade.php        # Navbar component
└── projects/
    ├── index.blade.php         # Project list with filters
    ├── create.blade.php        # Create project form
    ├── details.blade.php       # Project details
    ├── hub.blade.php           # Project hub
    └── ...
```

### Assets
```
public/
├── css/
│   ├── navbar.css              # Navbar styles
│   ├── global.css              # Global styles
│   └── projects-index.css      # Projects page styles
└── js/
    ├── navbar.js               # Navbar functionality
    ├── global.js               # Global JavaScript
    ├── projects-index.js       # Projects page JS
    ├── projects-hub.js         # Projects hub JS
    └── swal-custom.js          # SweetAlert wrapper
```

### Routes
```
routes/
├── web.php                     # Web routes
│   ├── GET /projects           # Project list
│   ├── GET /projects/create    # Create form
│   ├── POST /projects          # Store project
│   ├── GET /projects/filter   # Filter API
│   └── GET /projects/{id}      # Project details
└── api.php                     # API routes (v1)
    └── GET /projects/filter    # API filter endpoint
```

---

## Database Changes

### Projects Table Status Enum
```sql
ALTER TABLE projects MODIFY COLUMN status ENUM(
    'active',
    'completed', 
    'pending',
    'on_hold',
    'paused',
    'cancelled'
) DEFAULT 'active';
```

### Migration
```php
// database/migrations/2024_01_01_000007_create_projects_tables.php
$table->enum('status', [
    'active', 
    'completed', 
    'pending', 
    'on_hold', 
    'paused', 
    'cancelled'
])->default('active');
```

---

## Key Fixes

### 1. Team Members Column Error
**Problem**: `team_members.project_id` column not found
**Cause**: Project model was using wrong relationship
**Fix**: Changed to use `project_users` pivot table

### 2. diffForHumans on Null
**Problem**: Error when displaying null dates
**Fix**: Added null-safe operator with fallback text

### 3. Duplicate Navbar
**Problem**: Navbar rendered twice on most pages
**Fix**: Single navbar in layout, removed from all views

---

## Installation & Setup

```bash
# Run migrations
php artisan migrate

# Clear caches
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Start development server
php artisan serve
```

---

## Browser Requirements
- Modern browser with JavaScript enabled
- LocalStorage support
- ES6+ JavaScript support

---

## External Dependencies
- [Tailwind CSS](https://tailwindcss.com/) - CDN (development)
- [SweetAlert2](https://sweetalert2.github.io/) - Toast notifications
- [Google Fonts](https://fonts.google.com/) - Syne, Outfit, Material Symbols

---

## Version History

| Date | Version | Changes |
|------|---------|---------|
| 2026-05-21 | 1.0 | Initial implementation |
| 2026-05-21 | 1.1 | Added live filtering |
| 2026-05-21 | 1.2 | Navbar refactoring |
| 2026-05-21 | 1.3 | Flash notifications |
| 2026-05-21 | 1.4 | Draft system |
| 2026-05-21 | 1.5 | Duplicate navbar fix |

---

## Author
Xenon Studios Development Team

## License
Proprietary - All Rights Reserved