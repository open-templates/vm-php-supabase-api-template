---
type: API Endpoint
title: GET /me
description: Returns authenticated Supabase user profile from Bearer JWT.
tags: [api, jwt, supabase]
timestamp: 2026-07-17T00:00:00Z
resource: GET /me
---

# `GET /me`

* **Authentication:** `Authorization: Bearer <supabase_access_token>`
* **Implementation:** `SupabaseAuthClient::getUser()` → `auth/v1/user`

# Success

```json
{
  "success": true,
  "data": {
    "id": "uuid",
    "email": "user@example.com",
    "user_metadata": {},
    "app_metadata": {},
    "created_at": "..."
  }
}
```

# Errors

`401` with `{ "success": false, "error": { "message": "...", "code": "UNAUTHORIZED" } }`
