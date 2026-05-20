# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/).

## [Unreleased]

---

## [1.0.0] - 2026-05-21

### Added

#### Project Create Page
- New create project form at `/projects/create`
- Form fields: name, description, client, status, start/end dates, priority, budget
- Draft system with save/load/delete functionality
- Auto-save form data to localStorage
- Visual indicator when draft is saved
- Form validation on server side

#### Live Filtering System
- Real-time project filtering without page reload
- Search by project name, description, client name
- Filter by status (active, completed, pending, on_hold)
- Filter by client
- Sort options (newest, oldest, deadline)
- Debounced search (300ms delay)
- Filter state saved to localStorage
- Restores filters on page reload
- Loading states during fetch
- Clear filters button

#### Navbar State Persistence
- Sidebar open/close state saved to localStorage
- State persists across browser sessions
- Responsive behavior (mobile vs desktop)
- Section collapse/expand with chevron animation
- Mobile overlay with close on click
- Main content margin adjusts with sidebar state

#### Flash Notification System
- SweetAlert2 integration for toast notifications
- Success, error, warning notification types
- Auto-dismiss after 2-4 seconds
- Session-based flash data from controllers

#### API Endpoints
- `GET /projects/filter` - Filter projects (web route)
- `GET /api/v1/projects/filter` - Filter projects (API route)

### Changed

#### Project Model
- Fixed `team()` and `teamMembers()` relationships to use `project_users` table
- Changed from `hasMany(TeamMember::class)` to `belongsToMany(User::class)`

#### Database
- Added `pending` and `on_hold` to projects status enum
- Migration updated to support new statuses

#### Views
- Removed duplicate `<x-navbar />` from all view files
- Single navbar now in `layouts/app.blade.php`
- Navbar styles moved to separate `navbar.css`
- Navbar JavaScript moved to separate `navbar.js`

### Fixed

#### Team Members Column Error
- **Issue**: `team_members.project_id` column not found
- **Cause**: Wrong table referenced in Project model
- **Fix**: Changed to use `project_users` pivot table

#### diffForHumans on Null
- **Issue**: Error when displaying null dates
- **Fix**: Added null-safe operator with fallback text

#### 404 on /projects/hub
- **Issue**: Page not found
- **Cause**: Route exists but required authentication
- **Fix**: User needed to be logged in

### Refactored

#### Navbar Component
- Separated inline styles to `public/css/navbar.css`
- Separated inline JavaScript to `public/js/navbar.js`
- Removed Tailwind CDN from individual components
- Cleaned up component template

#### Global Layout
- Added back Tailwind CDN for page styling
- Single navbar include per page
- Proper CSS loading order

### Documentation

- Created `docs/PROJECT_DOCUMENTATION.md` - Full feature documentation
- Created `docs/QUICK_REFERENCE.md` - Quick reference guide
- Created `docs/API_DOCUMENTATION.md` - API endpoints documentation
- Created `CHANGELOG.md` - Change tracking

---

## Files Changed

### Created
```
resources/views/projects/create.blade.php
public/css/navbar.css
public/js/navbar.js
docs/PROJECT_DOCUMENTATION.md
docs/QUICK_REFERENCE.md
docs/API_DOCUMENTATION.md
docs/CHANGELOG.md
```

### Modified
```
app/Http/Controllers/Web/ProjectController.php
app/Http/Controllers/Api/ProjectController.php
app/Models/Project.php
database/migrations/2024_01_01_000007_create_projects_tables.php
routes/web.php
routes/api.php
resources/views/layouts/app.blade.php
resources/views/components/navbar.blade.php
resources/views/projects/index.blade.php
resources/views/projects/details.blade.php
resources/views/projects/hub.blade.php
resources/views/projects/team.blade.php
resources/views/projects/tasks-workspace.blade.php
resources/views/projects/files-workspace.blade.php
resources/views/projects/my-assigned.blade.php
resources/views/projects/overview.blade.php
resources/views/projects/assigned.blade.php
resources/views/projects/timeline.blade.php
resources/views/tasks/*.blade.php (8 files)
resources/views/roles/*.blade.php (2 files)
resources/views/settings.blade.php
resources/views/reports/*.blade.php (6 files)
resources/views/analytics/*.blade.php (3 files)
resources/views/activity/admin.blade.php
resources/views/team/assign.blade.php
resources/views/communication/*.blade.php (4 files)
resources/views/billing/*.blade.php (4 files)
resources/views/clients/clientDetails.blade.php
resources/views/users/dashboard.blade.php
public/js/global.js
public/js/projects-index.js
public/css/global.css
```

### Deleted
```
(Noney deleted in this release)
```

---

## Commit History

```
f4dbc8f refactor: separate navbar into dedicated CSS and JS files
f32bf58 fix: restore Tailwind CDN and proper config in layout
7d137f0 fix: remove duplicate navbar from projects views
50ab6b0 fix: remove duplicate navbar from all view files
8c44008 feat: add navbar state persistence with localStorage
67053bd feat: add flash notification system using SweetAlert
de4920f feat: add live filtering system for projects page
18f9516 feat: add project create page with form persistence and draft system
a3d64d5 fix: add null-safe operators for diffForHumans calls
9b09a4c fix: resolve team_members column error
```

---

## Migration Commands

```bash
# Clear all caches
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run migrations
php artisan migrate

# Database update (if migration fails)
# Run manually:
# ALTER TABLE projects MODIFY COLUMN status ENUM('active','completed','pending','on_hold','paused','cancelled') DEFAULT 'active';
```

---

## Known Issues

1. Tailwind CDN used for development (should use compiled CSS in production)
2. Some pages may need cache clear after deployment
3. Session may expire requiring re-login

---

## Next Steps

- [ ] Compile Tailwind CSS for production
- [ ] Add unit tests
- [ ] Implement rate limiting
- [ ] Add email notifications
- [ ] Create API documentation frontend
- [ ] Add more export options