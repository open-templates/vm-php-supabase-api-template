---
type: Feature
title: Purpose
description: Goals of the PHP Docker API and frontend pairing.
tags: [backend, php, docker, supabase]
timestamp: 2026-07-17T00:00:00Z
---

# Purpose

Provide a **VM-friendly** Supabase Auth API when Cloudflare Workers are not suitable. Implements the same `/health` and `/me` contract as `cf-hono-supabase-api-template`.

Pairs with any auth-pack frontend (`react-`, `vue-`, `svelte-`, `astro-supabase-auth-template`). See [06 — Frontend pairing](06-frontend-pairing.md).

Deployment: Docker Compose locally; Oracle Terraform + cloud-init for production ([08 — Docker runtime](08-docker-runtime.md), [09 — Oracle Terraform](09-oracle-terraform.md)).
