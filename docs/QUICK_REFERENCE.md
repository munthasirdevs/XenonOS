# XenonOS Quick Reference

## Routes

### Projects
| URL | Route Name | Controller | Description |
|-----|------------|------------|-------------|
| `/projects` | projects.index | Web\ProjectController | Project list with filtering |
| `/projects/create` | projects.create | Web\ProjectController | Create project form |
| `/projects/{id}` | projects.show | Web\ProjectController | Project details |
| `/projects/filter` | projects.filter | Web\ProjectController | Filter API (JSON) |
| `/projects/hub` | projects.hub | Web\ProjectController | Project hub |
| `/projects/assigned` | projects.assigned | Web\ProjectController | User's assigned projects |

## LocalStorage Keys

| Key | Description | Used In |
|-----|-------------|---------|
| `xenonos_sidebar_state` | Sidebar open/closed | Navbar |
| `project_draft` | Saved project draft | Create form |
| `project_create_form` | Auto-saved form data | Create form |
| `projects_filter_state` | Projects filter state | Projects index |
| `projects_view_mode` | Grid/List view | Projects index |

## JavaScript Functions

### Navbar (navbar.js)
```javascript
toggleSidebar()     // Toggle sidebar open/close
toggleSection(id)   // Toggle section expand/collapse
```

### Projects (projects-index.js)
```javascript
fetchProjects()      // Fetch filtered projects
clearFilters()      // Clear all filters
saveFilterState()   // Save current filters to localStorage
```

### Create Form (create.blade.php)
```javascript
saveDraft()         // Save form as draft
loadDraft()         // Load saved draft
deleteDraft()       // Delete saved draft
clearFormData()     // Clear form and saved data
```

## View Composers / Components

### Navbar Component
```blade
<x-navbar />
```
Location: `resources/views/components/navbar.blade.php`

### Main Layout
```blade
@extends('layouts.app')
```
Location: `resources/views/layouts/app.blade.php`

## Flash Messages

```php
// Success
return redirect()->back()->with('success', 'Message here');

// Error  
return redirect()->back()->with('error', 'Message here');

// Warning
return redirect()->back()->with('warning', 'Message here');
```

## CSS Classes

### Custom Colors
| Class | Hex Code | Usage |
|-------|----------|-------|
| `bg-surface` | #161922 | Card backgrounds |
| `bg-surface-container` | #12151e | Input backgrounds |
| `bg-surface-container-low` | #0f121a | Page background |
| `bg-primary` | #818cf8 | Primary accent |
| `text-on-surface` | #dfe2f1 | Main text |
| `text-on-surface-variant` | #94a3b8 | Secondary text |

### Custom Fonts
| Class | Font | Usage |
|-------|------|-------|
| `font-headline` | Syne | Headings |
| `font-body` | Outfit | Body text |
| `font-label` | Outfit | Labels |

## API Endpoints

### Projects Filter
```
GET /projects/filter?search=&status=&client=&sort=
```

Parameters:
- `search` - Search term
- `status` - active, completed, pending, on_hold
- `client` - Client ID
- `sort` - newest, oldest, deadline

Response:
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [...],
    "last_page": 5,
    "per_page": 15
  }
}
```

## Model Relationships

### Project Model
```php
$project->client     // BelongsTo Client
$project->owner      // BelongsTo User (created_by)
$project->team       // BelongsToMany User (via project_users)
$project->tasks      // HasMany Task
$project->files      // BelongsToMany File (via project_files)
```

## Database Schema

### project_users (Pivot)
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| project_id | bigint | Foreign key to projects |
| user_id | bigint | Foreign key to users |
| role | string | Project role (nullable) |
| assigned_at | timestamp | When assigned |

## Troubleshooting

### Navbar not working on page
- Check if page extends `layouts.app`
- Check if `<x-navbar />` NOT in content section (layout has it)

### Styles not loading
- Clear cache: `php artisan view:clear`
- Check Tailwind CDN is included in layout
- Check global.css exists

### Filters not working
- Check `/projects/filter` route exists
- Check JavaScript console for errors
- Check API returns JSON

### Draft not saving
- Check localStorage is enabled
- Check browser console for errors
- Data saved to `project_draft` key