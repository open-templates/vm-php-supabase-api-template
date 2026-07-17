---
type: Module
title: Auth middleware
description: Bearer JWT validation via Supabase Auth API.
tags: [auth, middleware]
---

# Auth middleware

`AuthMiddleware` extracts `Authorization: Bearer`, calls `SupabaseAuthClient::getUser()`, attaches `user` request attribute or returns `401 UNAUTHORIZED`.

Register protected routes inside the Slim group that adds this middleware (see `AppFactory.php`).

Shared: [jwt-api-passthrough.md](../shared/auth/jwt-api-passthrough.md)
