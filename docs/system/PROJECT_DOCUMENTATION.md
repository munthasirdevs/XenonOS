# XenonOS — Complete System Documentation

> **Version:** 2.0 | **Last Updated:** 2026-06-04  
> **Stack:** Laravel 12 / PHP 8.2 / MySQL / Tailwind CSS v4 / Sanctum  
> **Status:** Active Development

---

## Table of Contents

1. [System Overview](#1-system-overview)
2. [Architecture](#2-architecture)
3. [Module Catalog](#3-module-catalog)
4. [Database Schema](#4-database-schema)
5. [API Reference](#5-api-reference)
6. [Frontend Architecture](#6-frontend-architecture)
7. [Authentication & Authorization](#7-authentication--authorization)
8. [Security Model](#8-security-model)
9. [Testing Infrastructure](#9-testing-infrastructure)
10. [Technical Debt & Risks](#10-technical-debt--risks)
11. [Development Roadmap](#11-development-roadmap)
12. [Deployment Guide](#12-deployment-guide)
13. [Developer Onboarding](#13-developer-onboarding)

---

## 1. System Overview

XenonOS is a **project management SaaS platform** built as a modular monolith with a REST API and server-rendered Blade frontend. It manages the full lifecycle of client projects: CRM, task tracking, team collaboration, billing/invoicing, file management, analytics, and system administration.

### 1.1 Scale

| Metric         | Value                                                  |
| -------------- | ------------------------------------------------------ |
| PHP files      | ~274                                                   |
| Controllers    | 43 (26 API + 8 Web + 9 root)                           |
| Models         | 42 Eloquent models                                     |
| DB tables      | 55 application + 5 platform                            |
| Migrations     | 45 files                                               |
| Services       | 6 classes (unused — dead code)                         |
| Policies       | 13 authorization policies                              |
| Middleware     | 3 custom (1 unused)                                    |
| Events         | 4 (auth + chat)                                        |
| Blade views    | ~50 files across 15 directories                        |
| CSS files      | 42 (1 global, 1 navbar, 1 legacy, 37 page, 2 resource) |
| JS files       | 34 (5 core, 28 page, 1 resource)                       |
| Tests          | 11 meaningful tests (2% coverage — critical gap)       |
| Frontend build | Vite + Tailwind v4 (non-functional — CDN overrides)    |

### 1.2 Tech Stack

| Layer             | Technology                   | Justification                                                               |
| ----------------- | ---------------------------- | --------------------------------------------------------------------------- |
| **Backend**       | Laravel 12                   | Mature ecosystem, Eloquent ORM, built-in auth/cache/queue, Blade templating |
| **Database**      | MySQL 5.7+                   | Relational integrity, JSON column support, full-text search                 |
| **Auth (API)**    | Laravel Sanctum              | Token-based API auth with SPA support, simple setup                         |
| **Auth (Web)**    | Session-based                | Traditional Laravel session auth with remember-me                           |
| **Frontend**      | Tailwind CSS v4 + vanilla JS | Utility-first CSS, no JS framework overhead for SSR app                     |
| **Build**         | Vite + `@tailwindcss/vite`   | Fast HMR, tree-shaking, modern asset pipeline (NOT in use)                  |
| **Notifications** | SweetAlert2                  | Toast notifications (CDN-loaded)                                            |
| **Icons**         | Material Symbols             | Google Material icon set (CDN-loaded)                                       |
| **Cache**         | Database driver              | Should be Redis for production                                              |
| **Queue**         | Database driver              | Should be Redis for production                                              |

---

## 2. Architecture

### 2.1 High-Level Architecture

```
┌──────────────────────────────────────────────────────────────────┐
│                        CLIENT LAYER                              │
│  ┌───────────────────┐  ┌────────────────┐  ┌───────────────┐   │
│  │ Browser (Blade)   │  │ 3rd-party API  │  │ Mobile/SPA    │   │
│  │ Session cookies   │  │ Bearer token   │  │ Bearer token  │   │
│  └────────┬──────────┘  └───────┬────────┘  └───────┬───────┘   │
└───────────┼────────────────────┼────────────────────┼────────────┘
            │ /web/*             │ /api/v1/*           │
            ▼                    ▼                     ▼
┌──────────────────────────────────────────────────────────────────┐
│                   APPLICATION LAYER (Laravel 12)                  │
│                                                                   │
│  ┌──────────────┐  ┌─────────────┐  ┌─────────────┐              │
│  │ Middleware    │  │ FormRequest │  │ Policies    │              │
│  │ role,perm    │  │ validation  │  │ authz       │              │
│  └──────┬───────┘  └─────────────┘  └─────────────┘              │
│         │                               ┌──────────┐              │
│         ▼                               │ Services │              │
│  ┌──────────────┐                       │ (UNUSED) │              │
│  │ Controllers  │──→ Models (Eloquent)  └──────────┘              │
│  │ Web + API    │──→ 42 models                                   │
│  └──────────────┘                                                 │
└──────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌──────────────────────────────────────────────────────────────────┐
│                         DATA LAYER                                │
│  ┌──────────────────────────────────────────────────────────┐    │
│  │ MySQL — 60 tables (55 app + 5 platform)                  │    │
│  │ Cache: database / Queue: database / Session: database    │    │
│  │ Filesystem: local (S3 configured)                        │    │
│  └──────────────────────────────────────────────────────────┘    │
└──────────────────────────────────────────────────────────────────┘
```

### 2.2 Request Lifecycle

**Web Request:**

```
Browser → routes/web.php → middleware[web, auth, role] → Controller
  → validation (inline or FormRequest)
    → authorization (middleware or Policy)
      → business logic (controller inline — NOT via services)
        → Eloquent query
          → Blade view response
```

**API Request:**

```
Client → routes/api.php → middleware[api, auth:sanctum, permission]
  → API Controller
    → validation (FormRequest or inline)
      → authorization (Policy or inline hasRole)
        → business logic (controller inline — NOT via services)
          → Eloquent query + Cache::remember
            → JSON response via ApiResponse trait
```

### 2.3 Architecture Assessment

| Aspect                 | Rating | Notes                                                            |
| ---------------------- | ------ | ---------------------------------------------------------------- |
| Separation of concerns | 5/10   | Controllers do everything; services exist but unused             |
| API design             | 7/10   | Consistent response format, RESTful routes, some inconsistencies |
| Data model             | 8/10   | Well-normalized, proper relationships, soft deletes              |
| Frontend architecture  | 4/10   | Build pipeline broken (CDN vs Vite conflict), inline scripts     |
| Testability            | 2/10   | No DI in controllers, static facades, orphaned services          |
| Extensibility          | 5/10   | Events only for auth, no webhook system                          |
| Security               | 4/10   | Fake 2FA, no CSP/HSTS, mass assignment risk                      |

---

## 3. Module Catalog

### 3.1 Module Map

| #   | Module              | Models                                                | API Controllers                                                              | Web Controllers         | Services                | Key Tables                                                                    |
| --- | ------------------- | ----------------------------------------------------- | ---------------------------------------------------------------------------- | ----------------------- | ----------------------- | ----------------------------------------------------------------------------- |
| 1   | **Auth & Users**    | User, Profile, Session, LoginAttempt                  | AuthController                                                               | AuthController          | AuthService             | users, profiles, sessions, login_attempts                                     |
| 2   | **RBAC**            | Role, Permission                                      | RoleController, PermissionController, RolePermController, UserRoleController | RoleController          | —                       | roles, permissions, role_user, permission_role, permission_user               |
| 3   | **Clients (CRM)**   | Client, ClientActivity, ClientDocument, ClientSession | ClientController                                                             | ClientController        | ClientService           | clients, client_activities, client_documents, client_sessions, client_invites |
| 4   | **Projects**        | Project, ProjectTimeline, ProjectFile                 | ProjectController                                                            | ProjectController       | ProjectWorkspaceService | projects, project_users, project_timeline, project_files                      |
| 5   | **Tasks**           | Task, TaskLog                                         | TaskController                                                               | TaskController          | —                       | tasks, task_assignments, task_logs                                            |
| 6   | **Communication**   | Chat, ChatUser, Message, MessageStatus                | ChatController                                                               | CommunicationController | —                       | chats, chat_users, messages, message_statuses, chat_user_mutes                |
| 7   | **Files & Storage** | File, FileLog, FileShare                              | FileController                                                               | FileController          | —                       | files, file_shares, file_logs, file_categories, tags, file_tag                |
| 8   | **Billing**         | Invoice, InvoiceItem, Payment, Transaction            | InvoiceController, PaymentController, BillingController                      | BillingController       | BillingService          | invoices, invoice_items, payments, transactions                               |
| 9   | **Subscriptions**   | Subscription                                          | SubscriptionController                                                       | —                       | —                       | subscriptions                                                                 |
| 10  | **Notifications**   | Notification, UserNotification                        | NotificationController                                                       | NotificationController  | —                       | notifications, user_notifications                                             |
| 11  | **Reporting**       | Report, ReportFilter                                  | ReportController                                                             | ReportController        | ReportService           | reports, report_filters                                                       |
| 12  | **Analytics**       | —                                                     | —                                                                            | AnalyticsController     | —                       | analytics_snapshots, metrics_cache                                            |
| 13  | **Settings**        | Setting                                               | SettingsController                                                           | SettingsController      | —                       | settings                                                                      |
| 14  | **Audit & Logs**    | ActivityLog, SecurityLog, AuditLog                    | AuditLogController                                                           | ActivityController      | ActivityService         | activity_logs, security_logs, audit_logs                                      |
| 15  | **Integrations**    | Integration, ApiKey                                   | IntegrationController, ApiKeyController                                      | —                       | —                       | integrations, api_keys                                                        |
| 16  | **Alert Rules**     | AlertRule                                             | AlertRuleController                                                          | —                       | —                       | alert_rules                                                                   |
| 17  | **Announcements**   | Announcement                                          | AnnouncementController                                                       | —                       | —                       | announcements                                                                 |
| 18  | **Notes**           | Note (polymorphic)                                    | NoteController                                                               | —                       | —                       | notes                                                                         |
| 19  | **Teams**           | Team, TeamMember                                      | —                                                                            | TeamController          | —                       | teams, team_members                                                           |

### 3.2 Module Details

#### 3.2.1 Auth & Users

**Models:** `User` (Authenticatable, SoftDeletes, HasApiTokens), `Profile` (hasOne User), `Session` (belongsTo User), `LoginAttempt` (standalone)

**Key User Model Features:**

- 23 fillable attributes (timezone, date_format, notification prefs, quiet hours, auth rules, chat channels, 2FA secret, security score)
- Casts: JSON arrays for `chat_channels`, `notification_matrix`, `auth_rules`; `hashed` for password
- Cached role (`user_role_{id}`, TTL 3600s) and permissions (`user_permissions_{id}`, TTL 900s)
- Relationships to 18 other models (central hub)

**Login Flow (API):**

```
POST /api/v1/auth/login
  → LoginAttempt::isLocked(email) check
    → credential verification (Hash::check)
      → LoginAttempt::clearLock(email)
        → UserLoggedIn event → LogAuthActivity listener → ActivityLog + SecurityLog
          → Sanctum token created (7-day expiry)
            → Response { token, user }
```

**Login Flow (Web):**

```
POST /login
  → inline validation
    → Hash::check
      → auth()->login($user, $remember)
        → if remember: config(['session.lifetime' => 43200]) [HACK]
          → UserLoggedIn event
            → Role-based redirect: admin→/dashboard, client→/client/dashboard
```

#### 3.2.2 RBAC (Role-Based Access Control)

**Schema:**

- `roles` — id, name, slug (unique, soft-deletes)
- `permissions` — id, name, slug (unique)
- `role_user` — user_id ↔ role_id
- `permission_role` — role_id ↔ permission_id
- `permission_user` — user_id ↔ permission_id (DIRECT, NOT USED in permission resolution)

**Seeder Data:**

- 6 roles: superadmin, admin, manager, user, client, viewer
- 29 permissions across 8 modules: clients (5), projects (5), tasks (5), files (4), roles (3), announcements (3), settings (2), billing (2)

**Authorization Chain:**

```
Route middleware: role:admin,superadmin  →  Route middleware: permission:client.create
     ↓                                            ↓
  Web controller guards                  API controller guards
     ↓                                            ↓
  Policy (viewAny/view/create/update/delete)  →  Policy
     ↓                                            ↓
  Inline hasRole('admin') checks          Inline hasRole('admin') checks
  (10+ duplications)                      (10+ duplications)
```

#### 3.2.3 Clients (CRM)

**Features:**

- Full CRUD with soft deletes
- Invite-based signup (generate 20-char code → email → signup page)
- Activity stream tracking (per-client)
- Document management (upload with File model linking)
- Session tracking (IP, device info)
- Tier system: premium / standard / basic
- Revenue tracking per client

**Known Issues:**

- Web `ClientController`: 14 methods (too large), hardcoded stats in `activity()`, unused `generateCode()` method, raw `DB::table()` for invites
- `clientDashboard()` returns hardcoded zeros (stub)
- `uploadDocument()` sets `file_id => null` — no actual file linking

#### 3.2.4 Projects

**Features:**

- CRUD with soft deletes
- Status: active, completed, pending, on_hold, paused, cancelled
- Priority: low, medium, high, urgent
- Budget tracking (decimal:2)
- Team assignment via `project_users` pivot (with role + assigned_at)
- Timeline events (milestones, updates, status changes)
- File workspace (files attached to project via `project_files`)
- Task workspace

**Known Issues:**

- Web `ProjectController`: 13 methods; `index()` and `filterJson()` have identical query logic (DRY violation)
- `myAssigned()` is a wrapper that just calls `assigned()`
- `team()` shows ALL users, not filtered by project membership

#### 3.2.5 Tasks

**Features:**

- CRUD with soft deletes
- Status: todo, in_progress, review, done
- Priority: low, medium, high, urgent
- Assignment: primary assignee + multiple via `task_assignments`
- Filter scopes: status, priority, project, assignee, overdue, search
- Task logs (activity history)
- Analytics (overdue/on-time stats)
- Calendar view

**Known Issues:**

- Web `TaskController`: `index()` and `search()` have identical filter logic
- `store()` doesn't accept `project_id` or `assigned_to`
- `update()` uses `$request->all()` — mass assignment vulnerability
- Analytics loads all tasks then filters in PHP (should use DB aggregates)

#### 3.2.6 Communication (Chat)

**Features:**

- Private / group / project chat types
- Message CRUD with soft deletes
- File attachment in messages (file_id)
- Message status: sent, delivered, read (per-user tracking)
- Message flagging (for moderation)
- Per-user mute in chat rooms (with expiration)
- `ChatMessageSent` broadcast event (ShouldBroadcast — NOT wired to any WebSocket server)
- 30-second polling in frontend (no real-time)

**Known Issues:**

- Web `CommunicationController`: `store()` has confusing dual-purpose (create chat if no chat_id, send message if chat_id provided)
- `index()` loads ALL chats with no user scope
- No pagination on chat list
- Broadcast event has no Pusher/Reverb configured

#### 3.2.7 Files & Storage

**Features:**

- File upload with MIME validation (max 10MB)
- Category system (`file_categories`)
- Tag system (`tags`, `file_tag` pivot)
- User-to-user sharing via `file_shares` (view/edit permissions)
- Share link generation with:
    - Password protection (hashed)
    - Expiration date
    - View limits
    - Access level (view/download)
- File activity logs

**Known Issues:**

- Web `FileController::index()` computes `$allFiles` but passes only `$files` to view (dead code)
- No ownership check on deletion in web controller
- No S3/cloud storage — local only
- `file_id` FK missing on `client_documents` and `messages`

#### 3.2.8 Billing

**Features:**

- Invoice CRUD with auto-generated invoice numbers (INV-YYYYMM-XXXX)
- Invoice items (line items with quantity, unit_price, total)
- Status transitions: draft → sent → paid / overdue → cancelled
- Payment recording (manual, no gateway integration)
- Partial payment support
- Refund processing with invoice status recalculation
- Revenue analytics: dashboard, charts, client revenue, aging report
- CSV export
- Overlapping `Transaction` model (duplicate payment tracking)

**Known Issues:**

- No payment gateway integration (Stripe, etc.)
- `Payment` and `Transaction` overlap — same purpose, different schema
- `clientRevenue()` has N+1 query (eager loads client inside loop)
- `revenueChart()` uses MySQL-specific `DATE_FORMAT`
- Some queries use `?? 0` where `sum()` already returns 0

---

## 4. Database Schema

### 4.1 Entity-Relationship Diagram

```
users ──1:1── profiles
users ──M:N── roles (role_user)
users ──M:N── permissions (permission_user)
users ──1:N── sessions
users ──1:N── teams (owner_id)
users ──1:N── api_keys
users ──1:N── activity_logs, security_logs, audit_logs
users ──1:N── login_attempts (via email)
users ──1:N── notifications (created_by), user_notifications
users ──1:N── clients, projects, tasks (via created_by/assigned_to)
users ──1:N── invoices, payments, transactions (via created_by)
users ──1:N── files, chats, messages, notes, reports
users ──M:N── chats (chat_users), files (file_shares)

roles ──M:N── permissions (permission_role)
roles ──M:N── users (role_user)

teams ──M:N── users (team_members)
team_members ──N:1── clients (client_id)

clients ──1:N── projects, invoices, subscriptions
clients ──1:N── client_activities, client_documents, client_sessions
clients ──1:N── client_invites

projects ──1:N── tasks, project_timeline, chats
projects ──M:N── users (project_users)
projects ──M:N── files (project_files)

tasks ──1:N── task_logs
tasks ──M:N── users (task_assignments)

files ──M:N── tags (file_tag)
files ──1:N── file_shares, file_logs
files ──N:1── file_categories

chats ──1:N── messages, chat_users, chat_user_mutes
messages ──1:N── message_statuses

invoices ──1:N── invoice_items, payments, transactions

notifications ──M:N── users (user_notifications)

reports ──1:N── report_filters

notes ── morphTo ── any model
```

### 4.2 Core Tables

| Table           | Rows Est. | Key Columns                                                                        | Relationships                                     |
| --------------- | --------- | ---------------------------------------------------------------------------------- | ------------------------------------------------- |
| `users`         | ~100      | id, name, email, password, status, timezone, auth_rules (json)                     | Central hub — 18 relationships                    |
| `profiles`      | =users    | id, user_id(FK), avatar, phone, address, preferences(json)                         | belongsTo User                                    |
| `roles`         | 6-20      | id, name, slug(unique), deleted_at                                                 | belongsToMany User, Permission                    |
| `permissions`   | 29-100    | id, name, slug(unique)                                                             | belongsToMany Role, User                          |
| `clients`       | ~500      | id, name, email, company, tier, total_revenue, status, created_by(FK)              | hasMany Project, Invoice, Subscription            |
| `projects`      | ~2000     | id, client_id(FK), name, status(enum), priority(enum), budget, created_by(FK)      | belongsTo Client; hasMany Task                    |
| `tasks`         | ~10000    | id, project_id(FK), title, status(enum), priority(enum), assigned_to(FK), due_date | belongsTo Project, User(assignee)                 |
| `invoices`      | ~2000     | id, client_id(FK), invoice_number(unique), total, status(enum), due_date           | belongsTo Client; hasMany Items, Payments         |
| `payments`      | ~2000     | id, invoice_id(FK), amount, method, status(enum), gateway                          | belongsTo Invoice                                 |
| `chats`         | ~500      | id, type(enum), name, project_id(FK), created_by(FK)                               | hasMany Messages; belongsToMany Users             |
| `messages`      | ~50000    | id, chat_id(FK), sender_id(FK), message(text), type(enum), is_flagged              | belongsTo Chat, User(sender)                      |
| `files`         | ~1000     | id, name, path, size, mime_type, share_hash, share_enabled                         | belongsTo User(uploader); belongsToMany Tag, User |
| `activity_logs` | ~50000    | id, user_id(FK), action, description, module, severity, metadata(json)             | belongsTo User                                    |
| `sessions`      | ~200      | id(string), user_id(FK), ip_address, user_agent, device_info(json)                 | belongsTo User                                    |

### 4.3 Migration Status

**Total:** 45 migration files

**Broken Migrations (5 — WILL CRASH on `php artisan migrate:fresh`):**

| Migration           | Issue                                                                            | Symptom                  |
| ------------------- | -------------------------------------------------------------------------------- | ------------------------ |
| `2026_06_02_000002` | Creates `invoice_items` table that ALREADY EXISTS                                | "Table already exists"   |
| `2026_06_02_000003` | Renames `amount`→`total` but `total` already exists; re-adds existing columns    | Column already exists    |
| `2026_06_02_000004` | Adds `is_flagged` column that ALREADY EXISTS                                     | Duplicate column         |
| `2026_06_02_000008` | Adds `name` column that ALREADY EXISTS (nullable in original)                    | Duplicate column         |
| `2026_05_16_000001` | Creates index on `activity_logs(entity_type, entity_id)` — neither column exists | Key column doesn't exist |

**No-Op Migrations:**

- `2024_01_01_000022` — Fixes sessions table columns that already exist (entirely redundant)

**Portability Issues:**

- `2026_05_04_000005` — Uses MySQL-specific `CREATE INDEX IF NOT EXISTS`
- `2026_05_06_000001` — Uses MySQL-specific `ALTER TABLE ... MODIFY COLUMN`

**Recommendation:** Squash all 45 migrations into a clean baseline migration before production deployment.

### 4.4 Missing Indexes

| Table                | Query Pattern                           | Missing Index                |
| -------------------- | --------------------------------------- | ---------------------------- |
| `messages`           | "Get messages for chat ordered by time" | `(chat_id, created_at)`      |
| `notes`              | "Find notes for entity"                 | `(related_type, related_id)` |
| `task_logs`          | "Get timeline for task"                 | `(task_id, created_at)`      |
| `activity_logs`      | "Get user activity timeline"            | `(user_id, created_at)`      |
| `client_activities`  | "Get client activity timeline"          | `(client_id, created_at)`    |
| `user_notifications` | "Get unread notifications for user"     | `(user_id, read_at)`         |
| `sessions`           | "Clean up expired sessions"             | `(expires_at)`               |
| `login_attempts`     | "Check brute force by IP+email"         | `(ip_address, email)`        |

---

## 5. API Reference

### 5.1 Base URL

```
https://{host}/api/v1
```

### 5.2 Authentication

All API endpoints (except login, register, health) require `Authorization: Bearer {token}` header.

**Token generation:**

```
POST /api/v1/auth/login
Content-Type: application/json

{
  "email": "admin@example.com",
  "password": "password"
}

Response 200:
{
  "status": "success",
  "message": "Login successful",
  "data": {
    "user": { ... },
    "token": "{plain-text-token}"
  }
}
```

**Token expiry:** 10,080 minutes (7 days) — configurable via `SANCTUM_TOKEN_EXPIRATION`

### 5.3 Endpoint Catalog

#### Auth

| Method | Endpoint         | Auth | Throttle | Description            |
| ------ | ---------------- | ---- | -------- | ---------------------- |
| POST   | `/auth/login`    | No   | 5/min    | Login, returns token   |
| POST   | `/auth/register` | No   | 5/min    | Register new user      |
| POST   | `/auth/logout`   | Yes  | —        | Revoke current token   |
| GET    | `/auth/me`       | Yes  | —        | Get authenticated user |

#### Profile

| Method | Endpoint          | Auth | Description      |
| ------ | ----------------- | ---- | ---------------- |
| GET    | `/profile`        | Yes  | Get user profile |
| PUT    | `/profile`        | Yes  | Update profile   |
| POST   | `/profile/avatar` | Yes  | Update avatar    |

#### Roles (`permission:role.*`)

| Method | Endpoint                           | Auth          | Description           |
| ------ | ---------------------------------- | ------------- | --------------------- |
| GET    | `/roles`                           | Yes           | List roles            |
| POST   | `/roles`                           | `role.create` | Create role           |
| GET    | `/roles/{role}`                    | Yes           | Get role              |
| PUT    | `/roles/{role}`                    | `role.update` | Update role           |
| DELETE | `/roles/{role}`                    | `role.delete` | Delete role           |
| GET    | `/roles/{role}/permissions`        | Yes           | List role permissions |
| POST   | `/roles/{role}/permissions`        | `role.update` | Assign permission     |
| PUT    | `/roles/{role}/permissions`        | `role.update` | Sync permissions      |
| DELETE | `/roles/{role}/permissions/{perm}` | `role.update` | Remove permission     |

#### Permissions

| Method | Endpoint                    | Auth | Description          |
| ------ | --------------------------- | ---- | -------------------- |
| GET    | `/permissions`              | Yes  | List all permissions |
| GET    | `/permissions/{permission}` | Yes  | Get permission       |
| GET    | `/permissions/module/list`  | Yes  | Grouped by module    |

#### Users

| Method | Endpoint                     | Auth          | Description         |
| ------ | ---------------------------- | ------------- | ------------------- |
| GET    | `/users/{user}/roles`        | Yes           | Get user roles      |
| POST   | `/users/{user}/roles`        | `role.update` | Assign role to user |
| DELETE | `/users/{user}/roles/{role}` | `role.update` | Remove user role    |
| PUT    | `/users/{user}/roles`        | `role.update` | Sync user roles     |

#### Clients (`permission:client.*`)

| Method | Endpoint                       | Auth            | Description              |
| ------ | ------------------------------ | --------------- | ------------------------ |
| GET    | `/clients`                     | Yes             | List clients (paginated) |
| POST   | `/clients`                     | `client.create` | Create client            |
| GET    | `/clients/{client}`            | Yes             | Get client details       |
| PUT    | `/clients/{client}`            | `client.update` | Update client            |
| DELETE | `/clients/{client}`            | `client.delete` | Delete client            |
| GET    | `/clients/{client}/activities` | Yes             | Client activity log      |
| GET    | `/clients/{client}/documents`  | Yes             | Client documents         |
| GET    | `/clients/{client}/sessions`   | Yes             | Client sessions          |

#### Projects (`permission:project.*`)

| Method                                             | Endpoint                        | Auth             | Description                |
| -------------------------------------------------- | ------------------------------- | ---------------- | -------------------------- |
| GET                                                | `/projects`                     | No\*             | List projects (filterable) |
| GET                                                | `/projects/filter`              | No\*             | Filter projects            |
| POST                                               | `/projects`                     | `project.create` | Create project             |
| GET                                                | `/projects/{project}`           | No\*             | Get project                |
| PUT                                                | `/projects/{project}`           | `project.update` | Update project             |
| DELETE                                             | `/projects/{project}`           | `project.delete` | Delete project             |
| GET                                                | `/projects/{project}/users`     | Yes              | List project members       |
| POST                                               | `/projects/{project}/users`     | `project.assign` | Assign users               |
| DELETE                                             | `/projects/{project}/users/{u}` | `project.assign` | Remove user                |
| GET                                                | `/projects/{project}/timeline`  | Yes              | Project timeline           |
| POST                                               | `/projects/{project}/timeline`  | Yes              | Add timeline event         |
| GET                                                | `/projects/{project}/files`     | Yes              | Project files              |
| POST                                               | `/projects/{project}/files`     | Yes              | Link file to project       |
| GET                                                | `/projects/{project}/workspace` | Yes              | Full workspace data        |
| **\* Public read endpoints require NO auth token** |

#### Tasks (`permission:task.*`)

| Method | Endpoint                   | Auth          | Description             |
| ------ | -------------------------- | ------------- | ----------------------- |
| GET    | `/tasks`                   | Yes           | List tasks (filterable) |
| POST   | `/tasks`                   | `task.create` | Create task             |
| GET    | `/tasks/{task}`            | Yes           | Get task                |
| PUT    | `/tasks/{task}`            | `task.update` | Update task             |
| DELETE | `/tasks/{task}`            | `task.delete` | Delete task             |
| POST   | `/tasks/{task}/status`     | Yes           | Update status           |
| POST   | `/tasks/{task}/assign`     | Yes           | Assign users            |
| GET    | `/tasks/{task}/logs`       | Yes           | Task activity logs      |
| GET    | `/tasks/analytics`         | Yes           | Task statistics         |
| GET    | `/tasks/calendar`          | Yes           | Calendar format         |
| POST   | `/tasks/{task}/reschedule` | Yes           | Change dates            |

#### Chats

| Method | Endpoint                            | Auth | Description       |
| ------ | ----------------------------------- | ---- | ----------------- |
| GET    | `/chats`                            | Yes  | List user's chats |
| POST   | `/chats`                            | Yes  | Create chat       |
| GET    | `/chats/{chat}`                     | Yes  | Get chat details  |
| DELETE | `/chats/{chat}`                     | Yes  | Delete chat       |
| GET    | `/chats/{chat}/messages`            | Yes  | Get messages      |
| POST   | `/chats/{chat}/messages`            | Yes  | Send message      |
| DELETE | `/chats/{chat}/messages/{msg}`      | Yes  | Delete message    |
| POST   | `/chats/{chat}/messages/{msg}/flag` | Yes  | Flag message      |
| POST   | `/chats/{chat}/mute/{user}`         | Yes  | Mute user         |
| DELETE | `/chats/{chat}/mute/{user}`         | Yes  | Unmute user       |
| GET    | `/chats/{chat}/muted`               | Yes  | List muted users  |

#### Files (`permission:file.*`)

| Method | Endpoint                 | Auth          | Description            |
| ------ | ------------------------ | ------------- | ---------------------- |
| GET    | `/files`                 | Yes           | List files             |
| POST   | `/files`                 | `file.upload` | Upload file (max 10MB) |
| GET    | `/files/{file}`          | Yes           | Get file details       |
| DELETE | `/files/{file}`          | `file.delete` | Delete file            |
| GET    | `/files/{file}/download` | Yes           | Download file          |
| GET    | `/files/categories`      | Yes           | List categories        |
| POST   | `/files/categories`      | Yes           | Create category        |
| GET    | `/files/search`          | Yes           | Search files           |
| POST   | `/files/{file}/share`    | Yes           | Share with user        |
| DELETE | `/files/{file}/share`    | Yes           | Remove share           |

#### Invoices

| Method | Endpoint                     | Auth | Description    |
| ------ | ---------------------------- | ---- | -------------- |
| GET    | `/invoices`                  | Yes  | List invoices  |
| POST   | `/invoices`                  | Yes  | Create invoice |
| GET    | `/invoices/{invoice}`        | Yes  | Get invoice    |
| PUT    | `/invoices/{invoice}`        | Yes  | Update invoice |
| POST   | `/invoices/{invoice}/send`   | Yes  | Mark as sent   |
| POST   | `/invoices/{invoice}/paid`   | Yes  | Mark as paid   |
| POST   | `/invoices/{invoice}/cancel` | Yes  | Cancel invoice |

#### Payments

| Method | Endpoint                     | Auth | Description          |
| ------ | ---------------------------- | ---- | -------------------- |
| GET    | `/payments`                  | Yes  | List payments        |
| POST   | `/payments`                  | Yes  | Record payment       |
| GET    | `/payments/{payment}`        | Yes  | Get payment          |
| POST   | `/payments/{payment}/refund` | Yes  | Refund payment       |
| GET    | `/payments/stats`            | Yes  | Payment method stats |

#### Notifications

| Method | Endpoint                      | Auth | Description         |
| ------ | ----------------------------- | ---- | ------------------- |
| GET    | `/notifications`              | Yes  | List notifications  |
| GET    | `/notifications/unread`       | Yes  | Unread only         |
| GET    | `/notifications/unread/count` | Yes  | Unread count        |
| POST   | `/notifications/{n}/read`     | Yes  | Mark as read        |
| POST   | `/notifications/read-all`     | Yes  | Mark all read       |
| DELETE | `/notifications/{n}`          | Yes  | Delete notification |
| DELETE | `/notifications`              | Yes  | Clear all           |

#### Reports

| Method | Endpoint                 | Auth | Description        |
| ------ | ------------------------ | ---- | ------------------ |
| GET    | `/reports/dashboard`     | Yes  | Dashboard stats    |
| GET    | `/reports/activities`    | Yes  | Activity report    |
| GET    | `/reports/user/activity` | Yes  | Per-user activity  |
| GET    | `/reports/tasks`         | Yes  | Task statistics    |
| GET    | `/reports/projects`      | Yes  | Project statistics |
| GET    | `/reports/clients`       | Yes  | Client statistics  |
| GET    | `/reports/export`        | Yes  | Export data        |

#### Settings

| Method | Endpoint                  | Auth | Description       |
| ------ | ------------------------- | ---- | ----------------- |
| GET    | `/settings`               | Yes  | List settings     |
| GET    | `/settings/{setting}`     | Yes  | Get setting       |
| POST   | `/settings`               | Yes  | Create setting    |
| PUT    | `/settings/{setting}`     | Yes  | Update setting    |
| DELETE | `/settings/{setting}`     | Yes  | Delete setting    |
| GET    | `/settings/group/{group}` | Yes  | Settings by group |
| GET    | `/settings/value`         | Yes  | Get value by key  |
| POST   | `/settings/value`         | Yes  | Set value by key  |

#### System

| Method | Endpoint           | Auth   | Description           |
| ------ | ------------------ | ------ | --------------------- |
| GET    | `/system/health`   | **NO** | Health check (public) |
| GET    | `/system/stats`    | Yes    | System statistics     |
| GET    | `/system/info`     | Yes    | System information    |
| GET    | `/system/routes`   | Yes    | Route list (admin)    |
| GET    | `/system/services` | Yes    | Service status        |

#### Subscriptions

| Method | Endpoint                       | Auth | Description        |
| ------ | ------------------------------ | ---- | ------------------ |
| GET    | `/subscriptions`               | Yes  | List subscriptions |
| POST   | `/subscriptions`               | Yes  | Create             |
| GET    | `/subscriptions/{s}`           | Yes  | Get                |
| PUT    | `/subscriptions/{s}`           | Yes  | Update             |
| POST   | `/subscriptions/{s}/cancel`    | Yes  | Cancel             |
| POST   | `/subscriptions/{s}/renew`     | Yes  | Renew              |
| POST   | `/subscriptions/check-expired` | Yes  | Check expired      |

#### Other

| Module        | Endpoints                                  | Notes                               |
| ------------- | ------------------------------------------ | ----------------------------------- |
| Alert Rules   | CRUD + toggle + execute + triggerOptions   | execute() iterates but does nothing |
| Audit Logs    | List + show + entity/user history + export | Read-only                           |
| Integrations  | CRUD + test + types                        | Config stored as JSON               |
| API Keys      | CRUD + regenerate                          | Per-user keys                       |
| Announcements | CRUD                                       | Soft deletes                        |
| Notes         | CRUD (polymorphic)                         | Attach to any entity                |
| Sessions      | List + destroy (own sessions)              | User session management             |

### 5.4 Response Format

**Success:**

```json
{
  "status": "success",
  "message": "Operation completed",
  "data": { ... }
}
```

**Error:**

```json
{
    "status": "error",
    "message": "Error description",
    "errors": { "field": ["Validation error"] }
}
```

**Paginated:**

```json
{
  "status": "success",
  "message": "List retrieved",
  "data": {
    "items": [ ... ],
    "current_page": 1,
    "last_page": 5,
    "per_page": 15,
    "total": 72
  }
}
```

---

## 6. Frontend Architecture

### 6.1 Build Pipeline

**Current State: NON-FUNCTIONAL**

The project has TWO competing build systems:

1. **Vite** (`vite.config.js` with `@tailwindcss/vite` plugin):
    - Entry points: `resources/css/app.css`, `resources/js/app.js`
    - Never referenced in Blade layout (no `@vite()` directive)
    - Build output is not used

2. **CDN** (loaded in `layouts/app.blade.php`):
    - `https://cdn.tailwindcss.com` with inline config (36 lines)
    - `sweetalert2@11` CDN
    - All `public/css/*.css` and `public/js/*.js` loaded via `asset()` helpers
    - CDN Tailwind **overrides** any Vite build

**Fix Required:** Remove CDN, add `@vite()` to layout, migrate all public CSS/JS to `resources/`.

### 6.2 View Structure

```
resources/views/
├── layouts/
│   └── app.blade.php          # Master layout (CDN scripts, yield content)
├── components/
│   ├── navbar.blade.php       # Sidebar component (x-navbar)
│   └── confirm-modal.blade.php# Confirm dialog (NOT included anywhere)
├── auth/
│   ├── login.blade.php        # Standalone (no layout)
│   └── signup.blade.php       # Standalone (via invite code)
├── activity/                  # 5 views (index, admin, sessions, security, pdf)
├── analytics/                 # 3 views (executive, marketing, operations)
├── billing/                   # 4 views (index, invoices, invoice-details, transactions)
├── clients/                   # 5 views (index, details, activity, documents, projects)
├── communication/             # 5 views (index, chat-details, create, monitor, control)
├── dashboard.blade.php        # Main admin dashboard
├── files/                     # 2 views (index, share)
├── notifications/             # 2 views (index, details)
├── payments/                  # 1 view (index)
├── profile.blade.php          # User profile
├── projects/                  # 10 views (index, create, details, hub, team, etc.)
├── reports/                   # 6 views (insights, sales, financial, support, builder, saved)
├── roles/                     # 2 views (index, add)
├── settings.blade.php         # Settings (includes duplicate JS — BUG)
├── tasks/                     # 8 views + partials/
├── team/                      # 2 views (index, assign)
└── users/                     # 1 view (dashboard — client)
```

### 6.3 CSS Architecture

```
public/css/
├── global.css          (67 lines)   — Root variables, base body, scrollbar, Material defaults
├── navbar.css          (97 lines)   — Sidebar layout, toggle animations, mobile overlay
├── xenon.css          (227 lines)   — LEGACY: Duplicates Tailwind utilities (bg-surface, text-primary, etc.)
├── confirm.css         (full)       — Modal styles (duplicates confirm-modal.blade.php)
├── projects-index.css  (per page)   — 37 page-specific CSS files
├── projects-hub.css    (per page)
├── tasks-index.css     (per page)
├── clients.css         (per page)
├── ... 30+ more page CSS files
└── activity.css, billing-index.css, communication-index.css, etc.
```

**Issues:**

- Heavy duplication (`global.css` ↔ `xenon.css` ↔ `navbar.css`)
- CDN Tailwind provides the same utilities that `xenon.css` manually defines
- Page-specific CSS redeclares `.material-symbols-outlined`, transitions, etc.
- No CSS custom properties in page files
- Inconsistent naming: BEM-ish but hybrid with utility classes

### 6.4 JavaScript Architecture

```
public/js/
├── api.js              (114 lines)  — Central API client (window.API)
├── global.js           (103 lines)  — Sidebar state, flash messages, SweetAlert2 auto-dismiss
├── navbar.js           (153 lines)  — Sidebar toggle, section accordion, localStorage persistence
├── swal-custom.js      (109 lines)  — SweetAlert2 wrapper (success/error/warning/confirm/toast/copy)
├── filter-ajax.js      (154 lines)  — AjaxFilter class: DOMParser-based live filtering
├── timezone.js         (23 lines)   — Client timezone detection
├── projects-index.js   (389 lines)  — Largest: live filtering, CRUD, localStorage filter state
├── tasks-index.js      (280 lines)  — Task CRUD, AJAX search, inline editing
├── roles-index.js      (281 lines)  — Role management, permission assignment via API
├── communication-index.js (172 lines) — Chat polling (30s), CRUD
├── clients.js          (130 lines)  — Client CRUD, invite generation
├── settings.js         (110 lines)  — Tab switching, password strength
├── billing-index.js    (typical)    — Billing page interactions
├── ... 20+ page JS files
```

**Core Pattern — `api.js`:**

```javascript
window.API = {
  request: async (endpoint, options = {}) => {
    const config = {
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token]').content,
        'Accept': 'application/json',
      },
      credentials: 'same-origin',
      ...options,
    };
    const response = await fetch(`/api/v1${endpoint}`, config);
    // ... error handling, JSON parsing
  },
  chats: { getAll: () => API.request('/chats'), ... },
  tasks: { create: (data) => API.request('/tasks', { method: 'POST', body: JSON.stringify(data) }), ... },
  // ...
};
```

**Known Issues:**

- 6+ Blade views have inline `<script>` blocks (50-220 lines each)
- `settings.blade.php` has duplicated JS code outside `@push` (renders raw JS in body — BUG)
- `resources/js/bootstrap.js` imports Axios but never used in any page JS
- No JS framework (vanilla JS — adequate for SSR, but chat polling should be WebSocket)
- State management: localStorage for sidebar + filter state, DOM for everything else
- No loading state abstraction (each page implements its own spinner logic)

---

## 7. Authentication & Authorization

### 7.1 Authentication

| Aspect                   | Web                                 | API                              |
| ------------------------ | ----------------------------------- | -------------------------------- |
| **Mechanism**            | Session cookie                      | Sanctum Bearer token             |
| **Guard**                | `web`                               | `sanctum`                        |
| **Login**                | `POST /login`                       | `POST /api/v1/auth/login`        |
| **Logout**               | `POST /logout`                      | `POST /api/v1/auth/logout`       |
| **Session/token expiry** | 120 min (43200 with remember)       | 7 days                           |
| **Rate limit**           | No specific limit                   | `throttle:5,1` on login/register |
| **IP lockout**           | Via LoginAttempt model              | Via LoginAttempt model           |
| **2FA**                  | Fake (random hex string — NOT TOTP) | Fake                             |
| **Registration**         | Invite-only via `/signup/{code}`    | `POST /api/v1/auth/register`     |

### 7.2 Authorization Layers

**Layer 1 — Route Middleware:**

- `role:admin,superadmin` — Web routes for admin areas
- `permission:client.create` — API routes for granular CRUD

**Layer 2 — Policy Classes (13 total):**
| Policy | Model | Key Rules |
|--------|-------|-----------|
| `ClientPolicy` | Client | Permission check + owner/member |
| `ProjectPolicy` | Project | Permission check + owner/member |
| `TaskPolicy` | Task | Permission + project owner/member + assigned |
| `FilePolicy` | File | Permission + owner/shared |
| `ChatPolicy` | Chat | Permission + participant only |
| `NotePolicy` | Note | Permission + owner/shared |
| `InvoicePolicy` | Invoice | Permission + owner/team (view); owner only (update/delete) |
| `PaymentPolicy` | Payment | Permission + owner/team (view); owner only (refund) |
| `SettingPolicy` | Setting | Permission; system keys require special permission |
| `SubscriptionPolicy` | Subscription | Permission + owner OR manage permission |
| `AnnouncementPolicy` | Announcement | Permission; update/delete requires owner |
| `AlertRulePolicy` | AlertRule | Permission + owner |
| `ApiKeyPolicy` | ApiKey | Owner-only |

**Layer 3 — Inline Checks:**

- `$request->user()->hasRole('admin')` — duplicated 10+ times in API controllers
- Should be extracted to `AdminMiddleware`

### 7.3 Permission Resolution

```
User::hasPermission($slug)
  → User::cachedPermissions()           [Cache::remember, 900s TTL]
    → User::getAllPermissions()
      → $this->roles->load('permissions')  [Eager load via roles]
        → pluck permission slugs
          → array_unique
            → return cached
```

**Note:** The `permission_user` pivot table exists but is NOT used in this resolution chain. Direct user→permission assignment is dead code.

### 7.4 Rate Limiting & Brute Force Protection

| Layer          | Mechanism                  | Threshold          | Duration                   |
| -------------- | -------------------------- | ------------------ | -------------------------- |
| Login throttle | `throttle:5,1` middleware  | 5 requests         | 1 minute                   |
| IP lockout     | `LoginAttempt` model (DB)  | ~5 failed attempts | Lock period (configurable) |
| RateLimitByIP  | Custom middleware (UNUSED) | 5 attempts         | 60 seconds                 |

---

## 8. Security Model

### 8.1 Current Security Posture

| Control                    | Status                    | Notes                                             |
| -------------------------- | ------------------------- | ------------------------------------------------- |
| Password hashing           | ✅ Bcrypt (rounds=12)     | Strong                                            |
| CSRF protection            | ✅ Enabled for web routes | Required for Blade forms                          |
| Mass assignment protection | ⚠️ Partial                | `TaskController::update()` uses `$request->all()` |
| SQL injection              | ✅ Via Eloquent           | Protected by ORM                                  |
| XSS                        | ⚠️ Blade auto-escapes     | No CSP header                                     |
| Session encryption         | ❌ Disabled               | `SESSION_ENCRYPT=false`                           |
| HTTPS enforcement          | ❌ Not configured         | `SESSION_SECURE_COOKIE` not set                   |
| Security headers           | ❌ None                   | No CSP, HSTS, X-Frame-Options                     |
| 2FA                        | ❌ Fake                   | Random hex string, not TOTP                       |
| API rate limiting          | ⚠️ Login only             | Other endpoints unlimited                         |
| SESSION_HTTP_ONLY          | ✅ Enabled                | JS cannot read cookie                             |
| SESSION_SAME_SITE          | ⚠️ 'lax'                  | Should be 'strict' for production                 |
| Token expiry               | ✅ 7 days                 | No refresh token mechanism                        |
| System health endpoint     | ❌ Public                 | `GET /api/v1/system/health` — no auth             |

### 8.2 Risk Assessment

| Risk                   | Severity     | Impact                                 | Mitigation                                           |
| ---------------------- | ------------ | -------------------------------------- | ---------------------------------------------------- |
| Fake 2FA               | **CRITICAL** | Users believe they have 2FA protection | Remove or implement real TOTP                        |
| Mass assignment        | **HIGH**     | Unauthorized field injection           | Add `$fillable` guard or use `$request->validated()` |
| Session hijacking      | **HIGH**     | Session data readable, HTTP cookie     | Enable encryption, enforce HTTPS                     |
| XSS via missing CSP    | **MEDIUM**   | Script injection across pages          | Add CSP header middleware                            |
| Public health endpoint | **LOW**      | Information disclosure                 | Add auth or sanitize response                        |

---

## 9. Testing Infrastructure

### 9.1 Current Coverage

| Layer           | Tests                           | Coverage                                       |
| --------------- | ------------------------------- | ---------------------------------------------- |
| **Auth API**    | 5 tests in `ApiAuthTest.php`    | Login, register, logout, profile, failed login |
| **Clients API** | 6 tests in `ApiClientsTest.php` | CRUD + auth required                           |
| **All else**    | **0 tests**                     | 0%                                             |
| **Overall**     | **11 tests**                    | **~2% of codebase**                            |

### 9.2 Critical Issues

1. **`phpunit.xml` DB configuration is COMMENTED OUT:**

    ```xml
    <!-- <env name="DB_CONNECTION" value="sqlite"/> -->
    <!-- <env name="DB_DATABASE" value=":memory:"/> -->
    ```

    Tests run against the **real database** — catastrophic for CI/production.

2. **Only 2 of 42 models have factories** (`UserFactory`, `ClientFactory`). Writing tests for the other 40 models requires manual data creation.

3. **No tests exist for:**
    - All 6 services (AuthService with 2FA logic, BillingService, etc.)
    - All 13 policies
    - All 3 middleware
    - All 4 events (no `Event::fake()` usage)
    - All 3 console commands
    - All form requests (validation tests)
    - Web controllers (no HTTP tests for Blade views)

4. **Test assertions are weak** — no `assertDatabaseHas`, `assertSoftDeleted`, or `assertJsonFragment` used.

### 9.3 Factory Status

| Model     | Factory            | States                 | Notes                                   |
| --------- | ------------------ | ---------------------- | --------------------------------------- |
| User      | ✅ `UserFactory`   | `unverified`           | Missing: banned, withProfile, withRoles |
| Client    | ✅ `ClientFactory` | `inactive`, `archived` | Missing: `created_by` defaults          |
| 40 others | ❌ **None**        | —                      | Cannot write tests without factories    |

### 9.4 Recommended Test Targets

**Phase 1 (Blockers):**

- Uncomment phpunit.xml DB config
- Create factories for all 42 models

**Phase 2 (Services — High Priority):**

- `AuthService`: login, register, 2FA, lockout detection
- `BillingService`: dashboard stats, invoice creation, revenue charts
- `ActivityService`: log creation, stats caching
- `ClientService`: CRUD, invite code generation
- `ReportService`: all report types, CSV export

**Phase 3 (API Controllers — High Priority):**

- All 26 API controllers (CRUD + validation + authorization)
- Complete auth coverage: banned accounts, duplicate registration, IP locking
- Permission gate tests (403 responses)

**Phase 4 (Infrastructure — Medium):**

- Console commands via `Artisan::call()`
- Event dispatch via `Event::fake()`
- Middleware unit tests
- Policy authorization tests

---

## 10. Technical Debt & Risks

### 10.1 Technical Debt Catalog

#### CRITICAL (Blockers)

| ID   | Issue                                   | Location                                       | Impact                                                                   |
| ---- | --------------------------------------- | ---------------------------------------------- | ------------------------------------------------------------------------ |
| TD-1 | **Services layer is dead code**         | `app/Services/*` (6 files, ~650 lines)         | Business logic duplicated in controllers; any refactoring doubles effort |
| TD-2 | **5 migrations will crash**             | `2026_06_02_000002/3/4/8`, `2026_05_16_000001` | Cannot deploy to new environment                                         |
| TD-3 | **phpunit.xml DB config commented out** | `phpunit.xml`                                  | Tests run on real DB; CI pipeline will corrupt data                      |
| TD-4 | **Vite build pipeline non-functional**  | `layouts/app.blade.php` + `vite.config.js`     | CDN Tailwind overrides Vite; no asset pipeline                           |
| TD-5 | **Fake 2FA**                            | `SettingsController::toggle2FA()`              | False security guarantee                                                 |

#### HIGH

| ID    | Issue                                        | Location                                                        | Impact                                               |
| ----- | -------------------------------------------- | --------------------------------------------------------------- | ---------------------------------------------------- |
| TD-6  | `hasRole('admin')` duplicated 10+ times      | API Controllers                                                 | Maintenance burden; one missed check = security hole |
| TD-7  | `$request->all()` mass assignment            | `Web\TaskController::update()`                                  | Security vulnerability                               |
| TD-8  | Missing DB transactions                      | `Web\PaymentController`, `Web\ClientController`                 | Data inconsistency on partial failure                |
| TD-9  | Duplicate filter logic                       | `Web\ProjectController::index()`/`filterJson()`                 | Code drift                                           |
| TD-10 | SettingsController: 12 methods               | `SettingsController`                                            | Worst SRP violation                                  |
| TD-11 | No pagination on lists                       | `NotificationController::index()`, `PaymentController::index()` | Performance with data growth                         |
| TD-12 | No security headers                          | Entire application                                              | CSP, HSTS, X-Frame-Options missing                   |
| TD-13 | Inline Blade scripts (6 files, 50-220 lines) | Multiple views                                                  | Cannot test; maintainability issue                   |
| TD-14 | MySQL-specific raw SQL in migrations         | `2026_05_04_000005`, `2026_05_06_000001`                        | Breaks on PostgreSQL/SQLite                          |
| TD-15 | Two billing sub-systems                      | `Payment` + `Transaction` models                                | Feature overlap; data inconsistency risk             |

#### MEDIUM

| ID    | Issue                                              | Location                                       | Impact                                   |
| ----- | -------------------------------------------------- | ---------------------------------------------- | ---------------------------------------- |
| TD-16 | Hardcoded user ID 1                                | `GenerateSecurityReportCommand`                | Breaks if admin ID differs               |
| TD-17 | Job/Command duplication                            | `CleanupOldInvites` Job + Command              | Maintenance confusion                    |
| TD-18 | Unused RateLimitByIP middleware                    | `app/Http/Middleware/`                         | Dead code                                |
| TD-19 | Empty AppServiceProvider                           | `AppServiceProvider`                           | No service binding                       |
| TD-20 | 40 models without factories                        | All except User + Client                       | Test writing friction                    |
| TD-21 | Missing FK constraints                             | `client_documents.file_id`, `messages.file_id` | Orphan records                           |
| TD-22 | Duplicate CSS                                      | `xenon.css` vs `global.css` vs Tailwind        | Confusion, larger bundles                |
| TD-23 | `permission_user` pivot unused                     | Schema + controllers                           | Incomplete feature                       |
| TD-24 | N+1 query in `clientRevenue()`                     | `Api\BillingController`                        | Performance issue                        |
| TD-25 | Cache invalidation inconsistency                   | Controllers without clearCache()               | Stale data served                        |
| TD-26 | Auth rules only enforced at middleware level       | Web routes use blanket `role:admin,superadmin` | No granular permission checks            |
| TD-27 | `config(['session.lifetime' => 43200])` at runtime | `AuthController::loginWeb()`                   | Config mutation after boot may not apply |
| TD-28 | `system/health` endpoint public                    | `routes/api.php` line 294                      | Information disclosure                   |
| TD-29 | Duplicate `company`/`company_name` on clients      | Migration                                      | Data confusion                           |
| TD-30 | Hardcoded stats in `activity()`                    | `Web\ClientController`                         | Shows fake data to users                 |

### 10.2 Service Layer Analysis (All Dead Code)

| Service                   | Lines | Key Methods                                                          | Should Be Used By                                  |
| ------------------------- | ----- | -------------------------------------------------------------------- | -------------------------------------------------- |
| `AuthService`             | ~150  | login, register, logout, isLockedOut, enable2FA, verify2FA           | `Api\AuthController`                               |
| `ActivityService`         | ~120  | log, getUserActivity, getEntityHistory, getActivityStats             | `Api\AuditLogController`, `Web\ActivityController` |
| `BillingService`          | ~100  | getDashboardStats, getRevenueChart, createInvoice, markInvoicePaid   | `Api\BillingController`                            |
| `ClientService`           | ~130  | getClients, createClient, updateClient, deleteClient, getClientStats | `Api\ClientController`                             |
| `ProjectWorkspaceService` | ~80   | getWorkspace, getProject, getStats, getTasks, getTeam                | `Api\ProjectController::workspace()`               |
| `ReportService`           | ~70   | getDashboardReport, getActivityReport, getTaskReport, exportToCsv    | `Api\ReportController`                             |

**Total dead code:** ~650 lines + duplicate business logic in controllers.

---

## 11. Development Roadmap

### Phase 1: Critical Fixes (Sprint 1-2 — Week 1-2)

| #               | Task                                                                                 | Effort | Dependencies |
| --------------- | ------------------------------------------------------------------------------------ | ------ | ------------ |
| 1.1             | Squash/rebase 45 migrations into clean baseline                                      | 1d     | None         |
| 1.2             | Uncomment phpunit.xml DB config; verify tests pass                                   | 2h     | 1.1          |
| 1.3             | Remove `$request->all()` in TaskController::update()                                 | 1h     | None         |
| 1.4             | Add DB transactions to web payment/signup flows                                      | 4h     | None         |
| 1.5             | Remove CDN Tailwind; wire `@vite()` into layout                                      | 4h     | None         |
| 1.6             | Consolidate CSS (global.css + xenon.css → resources/)                                | 3h     | 1.5          |
| 1.7             | Extract inline Blade scripts to public/js/                                           | 1d     | None         |
| 1.8             | Register CleanupOldInvitesCommand in ConsoleServiceProvider                          | 30m    | None         |
| 1.9             | Fix hardcoded admin ID in GenerateSecurityReportCommand                              | 1h     | None         |
| **Deliverable** | System deploys on fresh env; tests protect against regressions; frontend build works |        |              |

### Phase 2: Architecture (Sprint 3-5 — Week 3-5)

| #               | Task                                                                        | Effort | Dependencies |
| --------------- | --------------------------------------------------------------------------- | ------ | ------------ |
| 2.1             | Wire 6 services into their respective controllers                           | 2d     | 1.1          |
| 2.2             | Create BaseController with shared audit/cache/authorize helpers             | 1d     | None         |
| 2.3             | Extract AdminMiddleware for hasRole('admin') duplication                    | 4h     | None         |
| 2.4             | Split SettingsController (12 methods → 4 controllers)                       | 1d     | None         |
| 2.5             | Extract shared filter logic in Project/Task controllers                     | 1d     | None         |
| 2.6             | Standardize remaining 70% of endpoints on Form Requests                     | 2d     | None         |
| 2.7             | Add pagination to list endpoints missing it                                 | 1d     | None         |
| 2.8             | Consolidate Payment/Transaction overlap                                     | 1d     | None         |
| 2.9             | Standardize cache key patterns with tagging                                 | 1d     | None         |
| 2.10            | Add missing DB indexes (8 composite indexes)                                | 4h     | None         |
| **Deliverable** | Clean architecture; services in use; focused controllers; dead code removed |        |              |

### Phase 3: Testing (Sprint 5-7 — Week 5-7)

| #               | Task                                                                                | Effort | Dependencies |
| --------------- | ----------------------------------------------------------------------------------- | ------ | ------------ |
| 3.1             | Create factories for all 42 models                                                  | 2d     | None         |
| 3.2             | Unit tests for ApiResponse trait                                                    | 2h     | None         |
| 3.3             | Unit tests for AuthService (login, 2FA, lockout)                                    | 1d     | 3.1          |
| 3.4             | Unit tests for ActivityService, BillingService, ClientService, ReportService        | 2d     | 3.1          |
| 3.5             | Feature tests for ALL 26 API controllers                                            | 5d     | 3.1, 3.3     |
| 3.6             | Policy authorization tests                                                          | 2d     | 3.5          |
| 3.7             | Middleware unit tests                                                               | 1d     | None         |
| 3.8             | Event dispatch tests (Event::fake())                                                | 4h     | None         |
| 3.9             | Form Request validation tests                                                       | 1d     | None         |
| **Deliverable** | >70% test coverage on services; >60% on API controllers; safety net for refactoring |        |              |

### Phase 4: Features (Sprint 7-10 — Week 7-10)

| #               | Task                                                                          | Effort | Dependencies |
| --------------- | ----------------------------------------------------------------------------- | ------ | ------------ |
| 4.1             | Integrate real TOTP 2FA (pragmarx/google2fa-laravel)                          | 2d     | None         |
| 4.2             | Add WebSocket/realtime for chat (Laravel Reverb)                              | 2d     | None         |
| 4.3             | Integrate payment gateway (Stripe)                                            | 3d     | 2.8          |
| 4.4             | Add S3 cloud file storage                                                     | 1d     | None         |
| 4.5             | Implement webhook system for integrations                                     | 2d     | None         |
| 4.6             | Add business events (ClientCreated, TaskAssigned, InvoicePaid, etc.)          | 2d     | None         |
| 4.7             | Set up transactional email (SMTP + templates)                                 | 2d     | None         |
| 4.8             | Implement audit log viewer                                                    | 1d     | 4.6          |
| **Deliverable** | Feature-complete for production; real 2FA, real-time chat, payment processing |        |              |

### Phase 5: Scale & Optimize (Sprint 10-12 — Week 10-12)

| #               | Task                                                                       | Effort | Dependencies |
| --------------- | -------------------------------------------------------------------------- | ------ | ------------ |
| 5.1             | Switch cache driver to Redis                                               | 1d     | None         |
| 5.2             | Switch queue driver to Redis                                               | 1d     | 5.1          |
| 5.3             | Add composite indexes for all common queries                               | 4h     | None         |
| 5.4             | Implement query result caching for expensive reports                       | 1d     | None         |
| 5.5             | Add API rate limiting for all endpoints                                    | 1d     | None         |
| 5.6             | Add security headers middleware (CSP, HSTS, etc.)                          | 2h     | None         |
| 5.7             | Enable session encryption + HTTPS enforcement                              | 2h     | None         |
| 5.8             | Dockerize (Dockerfile + docker-compose)                                    | 1d     | None         |
| 5.9             | Set up GitHub Actions CI pipeline                                          | 1d     | 3.x          |
| 5.10            | Set up Laravel Pulse or Sentry monitoring                                  | 1d     | None         |
| **Deliverable** | Production-ready at scale; Redis-backed, security-hardened, CI/CD in place |        |              |

---

## 12. Deployment Guide

### 12.1 Requirements

| Component  | Version         | Notes                               |
| ---------- | --------------- | ----------------------------------- |
| PHP        | 8.2+            | Required for Laravel 12             |
| MySQL      | 5.7+            | MariaDB 10.3+ also compatible       |
| Composer   | 2.x             | PHP dependency manager              |
| Node.js    | 18+             | For frontend build                  |
| Redis      | 6+              | Recommended for cache/queue/session |
| Web server | Nginx or Apache | Nginx preferred                     |

### 12.2 Environment Variables

```env
# Application
APP_NAME=XenonOS
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=xenonos
DB_USERNAME=root
DB_PASSWORD=

# Session (MUST be configured for production)
SESSION_DRIVER=redis        # NOT 'database' in production
SESSION_LIFETIME=120
SESSION_ENCRYPT=true
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=strict

# Cache
CACHE_STORE=redis            # NOT 'database' in production

# Queue
QUEUE_CONNECTION=redis       # NOT 'database' in production

# Sanctum
SANCTUM_TOKEN_EXPIRATION=10080  # 7 days in minutes
SANCTUM_TOKEN_PREFIX=xenos_     # Set for secret scanning

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="XenonOS"

# Filesystem (for production)
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=xenonos-files
AWS_USE_PATH_STYLE_ENDPOINT=false

# Security
BCRYPT_ROUNDS=12
APP_KEY=base64:...            # Run php artisan key:generate
```

### 12.3 Deployment Steps

```bash
# 1. Clone & install
git clone https://github.com/munthasirdevs/XenonOS.git
cd XenonOS
composer install --no-dev --optimize-autoloader
npm install && npm run build

# 2. Environment
cp .env.example .env
nano .env                     # Configure all environment variables
php artisan key:generate

# 3. Database
php artisan migrate --force
php artisan db:seed --force

# 4. Storage
php artisan storage:link

# 5. Caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Supervisord (queue worker)
# /etc/supervisor/conf.d/xenonos-queue.conf:
# [program:xenonos-queue]
# command=php /path/to/artisan queue:work --sleep=3 --tries=3 --max-time=3600
# autostart=true
# autorestart=true
# user=www-data

# 7. Cron (scheduler)
# * * * * * cd /path/to/xenonos && php artisan schedule:run >> /dev/null 2>&1

# 8. Web Server (Nginx)
# nginx config for Laravel — standard single-site config with SSL
```

### 12.4 Health Check

After deployment, verify:

```bash
php artisan migrate:status          # All migrations green
php artisan up                      # Application online
php artisan queue:status            # Queue worker running
php artisan schedule:list           # Cron jobs registered
curl https://yourdomain.com/api/v1/system/health  # Endpoint responding
```

---

## 13. Developer Onboarding

### 13.1 Getting Started

```bash
# Prerequisites
# - PHP 8.2+
# - MySQL 5.7+
# - Composer
# - Node.js 18+

# Setup
git clone https://github.com/munthasirdevs/XenonOS.git
cd XenonOS
cp .env.example .env
composer install
npm install

# Database
# Create MySQL database: xenonos
# Update .env: DB_DATABASE=xenonos, DB_USERNAME=root, DB_PASSWORD=
php artisan key:generate
php artisan migrate:fresh --seed

# Verify Tests
php artisan test
composer run-script test

# Start Development
php artisan serve
npm run dev
```

### 13.2 Key Conventions

**Naming:**

- Routes: kebab-case (`tasks.hub`, `clients.activity.all`)
- Migrations: `YYYY_MM_DD_HHMMSS_description.php`
- Controllers: PascalCase, suffixed with `Controller`
- Models: PascalCase, singular
- Tables: snake_case, plural
- Pivot tables: singular, alphabetical (`role_user`, `permission_role`)

**Architecture Rules:**

- Controllers should only orchestrate; business logic goes in Services
- All mutation endpoints should use Form Requests for validation
- All authorization should go through Policies (not inline checks)
- API controllers should use `ApiResponse` trait for responses
- Cache invalidation must happen on every mutation

### 13.3 Common Commands

```bash
# Development
php artisan serve                      # Start dev server
npm run dev                            # Vite HMR

# Database
php artisan migrate:fresh --seed       # Reset + seed
php artisan make:migration             # New migration
php artisan make:model -ms             # Model + migration + seeder

# Testing
php artisan test                       # Run all tests
php artisan test --filter=ApiAuth      # Run specific test
php artisan make:test Api/SomeTest     # Create test

# Queue
php artisan queue:work                 # Process jobs
php artisan queue:listen --tries=1     # Dev queue listener (composer run-script dev)

# Cache
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan view:clear

# Code Quality
composer run-script analyse            # PHPStan (if configured)
```

### 13.4 Key Architecture Decisions (ADRs)

**ADR-1: Why Laravel + Blade vs. SPA?**
The system is content-heavy with server-rendered pages. Blade SSR provides faster initial load, better SEO (for public pages), and simpler development without maintaining a separate API client. The REST API exists for integrations.

**ADR-2: Why Sanctum vs. Passport vs. JWT?**
Sanctum is the simplest Laravel-native token auth system. It supports both SPA cookie auth and mobile token auth. Passport is overkill for first-party apps. JWT libraries add maintenance burden.

**ADR-3: Why MySQL vs. PostgreSQL?**
MySQL is specified in requirements. The schema uses some MySQL-specific features (enum types, date formatting) that should be removed for portability.

**ADR-4: Why Database-backed cache/queue?**
Chosen for zero-dependency setup. Must upgrade to Redis before production.

---

_Document version 2.0 — Generated from full codebase analysis. For questions or corrections, contact the development team._
