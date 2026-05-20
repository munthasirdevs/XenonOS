# XenonOS API Documentation

## Base URL
```
http://127.0.0.1:8000/api/v1
```

## Authentication
Most endpoints require authentication via Laravel Sanctum.
```http
Authorization: Bearer {token}
```

---

## Projects API

### List Projects
```http
GET /api/v1/projects
```

**Query Parameters:**
| Parameter | Type | Description |
|-----------|------|-------------|
| search | string | Search in name/description |
| status | string | Filter by status |
| client_id | int | Filter by client |
| assigned_to | int | Filter by assigned user |
| date_from | date | Filter by start date |
| date_to | date | Filter by end date |
| page | int | Page number |
| per_page | int | Items per page |

**Response:**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "name": "Project Name",
        "description": "Description",
        "status": "active",
        "priority": "high",
        "client": {
          "id": 1,
          "name": "Client Name"
        },
        "users": [...]
      }
    ],
    "per_page": 15,
    "last_page": 5,
    "total": 75
  }
}
```

---

### Filter Projects (Web)
```http
GET /projects/filter
```
**Note:** This is a web route, not API. Returns HTML or JSON.

**Query Parameters:**
| Parameter | Type | Description |
|-----------|------|-------------|
| search | string | Search in name/description/client |
| status | string | active, completed, pending, on_hold |
| client | int | Client ID |
| sort | string | newest, oldest, deadline |

**Response (JSON):**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "name": "Project Name",
        "status": "active",
        "client": {"id": 1, "name": "Client"},
        "team": [...],
        "tasks": [...]
      }
    ]
  }
}
```

---

### Create Project
```http
POST /api/v1/projects
```

**Body:**
```json
{
  "name": "Project Name",
  "description": "Project description",
  "client_id": 1,
  "status": "active",
  "start_date": "2026-05-01",
  "end_date": "2026-06-01",
  "priority": "high",
  "budget": 5000.00
}
```

**Response:**
```json
{
  "success": true,
  "message": "Project created successfully",
  "data": {
    "id": 1,
    "name": "Project Name",
    ...
  }
}
```

---

### Get Project
```http
GET /api/v1/projects/{id}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Project Name",
    "client": {...},
    "users": [...],
    "tasks": [...],
    "timeline": [...],
    "files": [...]
  }
}
```

---

### Update Project
```http
PUT /api/v1/projects/{id}
```

**Body:** Same as create

---

### Delete Project
```http
DELETE /api/v1/projects/{id}
```

**Response:**
```json
{
  "success": true,
  "message": "Project deleted successfully"
}
```

---

### Assign Users to Project
```http
POST /api/v1/projects/{id}/users
```

**Body:**
```json
{
  "user_ids": [1, 2, 3],
  "role": "developer"
}
```

---

### Remove User from Project
```http
DELETE /api/v1/projects/{project_id}/users/{user_id}
```

---

### Get Project Users
```http
GET /api/v1/projects/{id}/users
```

---

### Project Timeline
```http
GET /api/v1/projects/{id}/timeline
POST /api/v1/projects/{id}/timeline
```

---

### Project Files
```http
GET /api/v1/projects/{id}/files
POST /api/v1/projects/{id}/files
```

---

## Response Format

### Success Response
```json
{
  "success": true,
  "message": "Optional message",
  "data": { ... }
}
```

### Error Response
```json
{
  "success": false,
  "message": "Error message",
  "errors": {
    "field": ["Validation error"]
  }
}
```

---

## HTTP Status Codes

| Code | Description |
|------|-------------|
| 200 | Success |
| 201 | Created |
| 400 | Bad Request |
| 401 | Unauthorized |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Validation Error |
| 500 | Server Error |

---

## Rate Limiting
No rate limiting implemented yet.

---

## Pagination
Default pagination is 15 items per page.

To change:
```
?page=2&per_page=30
```

Response includes:
```json
{
  "current_page": 2,
  "per_page": 30,
  "last_page": 10,
  "total": 150
}
```