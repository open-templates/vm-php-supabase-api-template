---
type: Playbook
title: Response helpers
description: Consistent success and error JSON envelopes.
tags: [api, hono]
timestamp: 2026-07-15T00:00:00Z
resource: src/utils/response.ts
---

# Shapes

* Success: `{ success: true, data: T }`
* Error: `{ success: false, error: { message, code } }`

Use helpers from `src/utils/response.ts` in all route handlers.
