---
type: Feature
title: Frontend pairing
description: Contract with Supabase Auth SPA templates.
tags: [pairing, frontend]
timestamp: 2026-07-17T00:00:00Z
---

# Pairing

| Frontend call | Backend route |
|---------------|---------------|
| Header health indicator | `GET /health` (no auth) |
| Home profile card | `GET /me` (Bearer from `localStorage['x-auth-token']`) |

Base URL in frontends: `VITE_API_BASE_URL` (default **`http://localhost:8080`** for this template).

## Paired frontend templates

| Template | Stack |
|----------|-------|
| [react-supabase-auth-template](https://github.com/open-templates/react-supabase-auth-template) | React |
| [vue-supabase-auth-template](https://github.com/open-templates/vue-supabase-auth-template) | Vue |
| [svelte-supabase-auth-template](https://github.com/open-templates/svelte-supabase-auth-template) | Svelte |
| [astro-supabase-auth-template](https://github.com/open-templates/astro-supabase-auth-template) | Astro |

Cloudflare worker alternative: `cf-hono-supabase-api-template` (port `8787`).

Set `ALLOWED_ORIGINS` to each SPA dev/prod origin.
