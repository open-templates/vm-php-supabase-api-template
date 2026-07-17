---
type: Playbook
title: Extension guidelines
description: Register routes, use Auth client, document endpoints in OKF specs.
tags: [extension, maintainer]
timestamp: 2026-07-17T00:00:00Z
---

# Guidelines

1. Add route classes under `app/src/Routes/` and register in `AppFactory.php`.
2. Public routes: register before the auth middleware group.
3. User-scoped data: reuse `SupabaseAuthClient` with the request Bearer token.
4. Keep `{ success, data }` / `{ success: false, error }` via `JsonResponder`.
5. Add numbered concepts under `specs/features/` and link from [index.md](../../index.md).
6. Update paired frontend `specs/` when the API contract changes.
7. Document deployment changes in `docs/DEPLOYMENT.md` and feature `08`/`09` as needed.
