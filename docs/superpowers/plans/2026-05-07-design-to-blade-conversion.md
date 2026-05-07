# Design Files to Blade Views Conversion Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Convert 45 static HTML design files in `design/admin-panel/pages/` to Laravel Blade views using `@extends('layouts.app')` with external CSS/JS files.

**Architecture:** Each design file converts to:

- Blade view in `resources/views/<module>/<page>.blade.php` using `@extends('layouts.app')`
- Page-specific CSS in `public/css/<module>-<page>.css` (only when needed beyond global.css)
- Page-specific JS in `public/js/<module>-<page>.js` (only when needed beyond global.js)
- Route added to `routes/web.php`

**Tech Stack:** Laravel 12.x Blade, Tailwind CSS, external CSS/JS pattern

---

## File Structure Mapping

### Module: Projects (8 files)

| Design File                     | Blade Target                                         | CSS/JS                                    |
| ------------------------------- | ---------------------------------------------------- | ----------------------------------------- |
| `projects/index.html`           | `resources/views/projects/index.blade.php`           | `projects-index.css`, `projects-index.js` |
| `projects/hub.html`             | `resources/views/projects/hub.blade.php`             | `projects-hub.css`, `projects-hub.js`     |
| `projects/details.html`         | `resources/views/projects/details.blade.php`         | CSS/JS                                    |
| `projects/assigned.html`        | `resources/views/projects/assigned.blade.php`        | CSS/JS                                    |
| `projects/my-assigned.html`     | `resources/views/projects/my-assigned.blade.php`     | CSS/JS                                    |
| `projects/team.html`            | `resources/views/projects/team.blade.php`            | CSS/JS                                    |
| `projects/timeline.html`        | `resources/views/projects/timeline.blade.php`        | CSS/JS                                    |
| `projects/files-workspace.html` | `resources/views/projects/files-workspace.blade.php` | CSS/JS                                    |
| `projects/tasks-workspace.html` | `resources/views/projects/tasks-workspace.blade.php` | CSS/JS                                    |
| `projects/overview.html`        | `resources/views/projects/overview.blade.php`        | CSS/JS                                    |

### Module: Tasks (7 files)

| Design File             | Blade Target                                 | CSS/JS |
| ----------------------- | -------------------------------------------- | ------ |
| `tasks/index.html`      | `resources/views/tasks/index.blade.php`      | CSS/JS |
| `tasks/hub.html`        | `resources/views/tasks/hub.blade.php`        | CSS/JS |
| `tasks/details.html`    | `resources/views/tasks/details.blade.php`    | CSS/JS |
| `tasks/calendar.html`   | `resources/views/tasks/calendar.blade.php`   | CSS/JS |
| `tasks/analytics.html`  | `resources/views/tasks/analytics.blade.php`  | CSS/JS |
| `tasks/assign.html`     | `resources/views/tasks/assign.blade.php`     | CSS/JS |
| `tasks/assign-new.html` | `resources/views/tasks/assign-new.blade.php` | CSS/JS |
| `tasks/manage.html`     | `resources/views/tasks/manage.blade.php`     | CSS/JS |

### Module: Billing (4 files)

| Design File                    | Blade Target                                        | CSS/JS |
| ------------------------------ | --------------------------------------------------- | ------ |
| `billing/index.html`           | `resources/views/billing/index.blade.php`           | CSS/JS |
| `billing/invoices.html`        | `resources/views/billing/invoices.blade.php`        | CSS/JS |
| `billing/invoice-details.html` | `resources/views/billing/invoice-details.blade.php` | CSS/JS |
| `billing/transactions.html`    | `resources/views/billing/transactions.blade.php`    | CSS/JS |

### Module: Communication (4 files)

| Design File                              | Blade Target                                                  | CSS/JS |
| ---------------------------------------- | ------------------------------------------------------------- | ------ |
| `communication/index.html`               | `resources/views/communication/index.blade.php`               | CSS/JS |
| `communication/chat-details.html`        | `resources/views/communication/chat-details.blade.php`        | CSS/JS |
| `communication/create-conversation.html` | `resources/views/communication/create-conversation.blade.php` | CSS/JS |
| `communication/message-control.html`     | `resources/views/communication/message-control.blade.php`     | CSS/JS |
| `communication/messaging-monitor.html`   | `resources/views/communication/messaging-monitor.blade.php`   | CSS/JS |

### Module: Team (2 files)

| Design File        | Blade Target                            | CSS/JS |
| ------------------ | --------------------------------------- | ------ |
| `team/index.html`  | `resources/views/team/index.blade.php`  | CSS/JS |
| `team/assign.html` | `resources/views/team/assign.blade.php` | CSS/JS |

### Module: Roles (2 files)

| Design File        | Blade Target                            | CSS/JS |
| ------------------ | --------------------------------------- | ------ |
| `roles/index.html` | `resources/views/roles/index.blade.php` | CSS/JS |
| `roles/add.html`   | `resources/views/roles/add.blade.php`   | CSS/JS |

### Module: Analytics/Reports (7 files)

| Design File                 | Blade Target                                     | CSS/JS |
| --------------------------- | ------------------------------------------------ | ------ |
| `reports/insights.html`     | `resources/views/reports/insights.blade.php`     | CSS/JS |
| `reports/sales.html`        | `resources/views/reports/sales.blade.php`        | CSS/JS |
| `reports/financial.html`    | `resources/views/reports/financial.blade.php`    | CSS/JS |
| `reports/support.html`      | `resources/views/reports/support.blade.php`      | CSS/JS |
| `reports/builder.html`      | `resources/views/reports/builder.blade.php`      | CSS/JS |
| `reports/saved.html`        | `resources/views/reports/saved.blade.php`        | CSS/JS |
| `analytics/executive.html`  | `resources/views/analytics/executive.blade.php`  | CSS/JS |
| `analytics/marketing.html`  | `resources/views/analytics/marketing.blade.php`  | CSS/JS |
| `analytics/operations.html` | `resources/views/analytics/operations.blade.php` | CSS/JS |

### Module: Activity (1 file)

| Design File           | Blade Target                               | CSS/JS                           |
| --------------------- | ------------------------------------------ | -------------------------------- |
| `activity/index.html` | `resources/views/activity/index.blade.php` | (already exists - verify/update) |

---

## Conversion Pattern (To Follow Per File)

### Step 1: Read design HTML

- Read `design/admin-panel/pages/<module>/<page>.html`
- Identify structure, components, JS functionality

### Step 2: Create Blade view template

```blade
@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/<module>-<page>.css') }}">
@endpush

@section('title', '<Title> - XenonOS')

@section('content')
<x-navbar />

<main class="flex-1 md:ml-[260px] min-h-screen">
    <div class="p-6 md:p-8">
        <!-- Content from design -->
    </div>
</main>
@endsection

@push('scripts')
<script src="{{ asset('js/<module>-<page>.js') }}"></script>
@endpush
```

### Step 3: Create CSS file (if needed)

- Create `public/css/<module>-<page>.css`
- Use CSS custom properties from global.css
- Add page-specific styles only

### Step 4: Create JS file (if needed)

- Create `public/js/<module>-<page>.js`
- Wrap in IIFE with DOMContentLoaded
- Add page-specific functionality

### Step 5: Add route

- Add to `routes/web.php` with auth middleware
- Create controller method stub if needed

### Step 6: Verify syntax

- Run `php -l` on new Blade files

---

## Execution Strategy

**Recommended: Dispatch in Batches**

Batch 1 (5 agents - Projects):

- Task 1: projects/index.html → projects/index.blade.php
- Task 2: projects/hub.html → projects/hub.blade.php
- Task 3: projects/details.html → projects/details.blade.php
- Task 4: projects/team.html → projects/team.blade.php
- Task 5: projects/timeline.html → projects/timeline.blade.php

Batch 2 (5 agents - Tasks):

- Task 6: tasks/index.html → tasks/index.blade.php
- Task 7: tasks/hub.html → tasks/hub.blade.php
- Task 8: tasks/details.html → tasks/details.blade.php
- Task 9: tasks/calendar.html → tasks/calendar.blade.php
- Task 10: tasks/analytics.html → tasks/analytics.blade.php

Batch 3 (4 agents - Billing + Team):

- Task 11: billing/index.html → billing/index.blade.php
- Task 12: billing/invoices.html → billing/invoices.blade.php
- Task 13: team/index.html → team/index.blade.php
- Task 14: roles/index.html → roles/index.blade.php

Batch 4 (4 agents - Communication):

- Task 15: communication/index.html → communication/index.blade.php
- Task 16: communication/chat-details.html → communication/chat-details.blade.php
- Task 17: communication/create-conversation.html → communication/create-conversation.blade.php
- Task 18: reports/insights.html → reports/insights.blade.php

Batch 5 (Remaining files):

- Task 19-27: Remaining files

---

## Key Design Decisions

1. **Use `@extends('layouts.app')`** - All views use the main layout with navbar
2. **External CSS pattern** - Page-specific in `public/css/`, not inline
3. **External JS pattern** - Page-specific in `public/js/`, not inline
4. **Auth middleware** - All routes use `auth` middleware
5. **Role middleware** - Use appropriate role checks (admin, superadmin)
6. **PHP syntax check** - Verify all Blade files before commit

---

## Progress Tracking

Use checkbox syntax for tracking:

- [ ] Task N: <file> converted
- [ ] Route added
- [ ] Syntax verified
- [ ] Committed

---

**Total: 45 files across 9 modules**

**Total: 45 files across 9 modules**
