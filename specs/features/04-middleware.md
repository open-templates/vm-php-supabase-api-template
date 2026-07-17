---
type: Feature
title: Middleware
description: CORS, JWT gate, and error envelope for Slim.
tags: [middleware, cors, php]
timestamp: 2026-07-17T00:00:00Z
---

# Middleware

| Layer | Scope | Behavior |
|-------|-------|----------|
| Error | Global | Catches throwables → `INTERNAL_SERVER_ERROR` JSON |
| CORS | Global | `ALLOWED_ORIGINS`; handles `OPTIONS` |
| Auth | `/me` only | Bearer JWT → Supabase `auth/v1/user`; 401 `UNAUTHORIZED` |

`/health` is registered **before** the auth group (no JWT).

Implementation: `app/src/Middleware/`, wired in `AppFactory.php`.

Shared concept: [jwt-api-passthrough.md](../../.agents/skills/shared/auth/jwt-api-passthrough.md).
