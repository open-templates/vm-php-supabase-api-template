---
type: API Endpoint
title: GET /health
description: Public liveness check for frontend health polling.
tags: [api, health]
timestamp: 2026-07-17T00:00:00Z
resource: GET /health
---

# `GET /health`

* **Authentication:** none
* **Use case:** Frontend polls on an interval for online/offline header state

# Response

```json
{
  "success": true,
  "data": {
    "status": "healthy",
    "timestamp": "2026-07-03T12:00:00.000Z"
  }
}
```
