---
type: Feature
title: Supabase integration
description: PHP Guzzle client for Supabase Auth user lookup.
tags: [supabase, php]
timestamp: 2026-07-17T00:00:00Z
---

# Supabase integration

`/me` calls `GET {SUPABASE_URL}/auth/v1/user` with:

- `apikey: SUPABASE_ANON_KEY`
- `Authorization: Bearer <access_token>`

Class: `App\Supabase\SupabaseAuthClient`.

Maps response to `id`, `email`, `user_metadata`, `app_metadata`, `created_at`.

Shared: [worker-client-helpers.md](../../.agents/skills/shared/supabase/worker-client-helpers.md) (same Auth semantics; runtime is PHP + Docker).
