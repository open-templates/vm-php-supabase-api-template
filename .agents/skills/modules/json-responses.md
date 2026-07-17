---
type: Module
title: JSON responses
description: Standard API envelope for success and errors.
tags: [api, php]
---

# JSON responses

Use `App\Http\JsonResponder`:

- Success: `{ "success": true, "data": { ... } }`
- Error: `{ "success": false, "error": { "message", "code", "details?" } }`

Match worker templates so frontends share one `apiFetch` pattern.
