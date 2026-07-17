# Agent & developer instructions — vm-php-supabase-api-template

Use this file when turning this template into a **production Supabase Auth API** on Docker (local or VM). This repository is **self-contained** for the API; pair with any [Supabase Auth frontend pack](https://github.com/open-templates) SPA for end-to-end demos.

## What ships out of the box

| Endpoint | Auth | Purpose |
|----------|------|---------|
| `GET /health` | Public | Liveness check |
| `GET /me` | Bearer JWT | Current Supabase user |

Same JSON envelope as `cf-hono-supabase-api-template`. Details: [`index.md`](index.md)

## Deployment layers

1. **Docker Compose** — local and generic VMs (`docker compose up -d`)
2. **Terraform + cloud-init** — Oracle Cloud Always Free ([docs/DEPLOYMENT.md](docs/DEPLOYMENT.md))
3. **Manual** — `scripts/install.sh` then `scripts/deploy.sh`

---

## Prerequisites

### Toolchain

- Docker + Docker Compose v2
- Git
- Optional: Terraform ≥ 1.5, OCI account, SSH keys (Oracle deploy)

### Supabase project

1. Create a project at [supabase.com](https://supabase.com).
2. **Settings → API**:
   - **Project URL** → `SUPABASE_URL`
   - **anon key** → `SUPABASE_ANON_KEY`
3. Optional: **service_role** → `SUPABASE_SERVICE_ROLE_KEY` (future admin routes only).

No Postgres tables required for default `/me` (Auth API only).

---

## Setup checklist

```bash
cp .env.example .env
# Edit SUPABASE_URL, SUPABASE_ANON_KEY, ALLOWED_ORIGINS
docker compose up -d
curl -s http://localhost:8080/health
```

Verify `/me` with a Supabase access token:

```bash
curl -s -H "Authorization: Bearer <access_token>" http://localhost:8080/me
```

---

## Environment variables

| Variable | Required | Notes |
|----------|----------|-------|
| `SUPABASE_URL` | Yes | |
| `SUPABASE_ANON_KEY` | Yes | Used with user JWT against `auth/v1/user` |
| `ALLOWED_ORIGINS` | Recommended | Comma-separated SPA origins (CORS) |
| `APP_PORT` | No | Host port (default `8080`) |
| `SUPABASE_SERVICE_ROLE_KEY` | No | Reserved for extensions |
| `SUPABASE_JWT_SECRET` | No | Optional local JWT verification |

Production: inject via `.env` on the VM (never commit). cloud-init template uses `/opt/app.env`.

---

## Frontend pairing

Pick any auth-pack SPA (`react-`, `vue-`, `svelte-`, `astro-supabase-auth-template`):

1. Complete the frontend `INSTRUCTIONS.md` (Supabase + OAuth).
2. Frontend `.env.local`:
   ```bash
   VITE_API_BASE_URL=http://localhost:8080   # or https://api.yourdomain.com
   ```
3. Set `ALLOWED_ORIGINS` to the SPA origin (e.g. `http://localhost:5173`).
4. Run API: `docker compose up -d`, frontend: `bun run dev`.

---

## Oracle Cloud (summary)

```bash
cd infrastructure/terraform/oracle
cp terraform.tfvars.example terraform.tfvars
terraform init && terraform apply
```

cloud-init installs Docker, clones your repo, starts Compose. Full steps: [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md).

Recommended edge: **Cloudflare proxy** → VM Nginx :80.

---

## Extending the API

1. Add route class under `app/src/Routes/`.
2. Register in `AppFactory.php` (public vs auth group).
3. Document in `specs/features/` and link from `index.md`.
4. Add OKF module under `.agents/skills/modules/` when the pattern is reusable.

Keep response shape: `{ success, data }` / `{ success: false, error: { message, code } }`.

---

## Agent read order

1. This file → `index.md` → `.agents/skills/index.md`
2. Deployment: `docs/DEPLOYMENT.md`, `specs/features/08-docker-runtime.md`, `09-oracle-terraform.md`
3. Shared skills: `.agents/skills/shared/auth/`, `shared/supabase/`

---

## Maintainer sync

When workspace `specs/shared/` or `.agents/skills/{auth,supabase}/` change, run from the monorepo:

```bash
node specs/scripts/sync-shared.mjs
node specs/scripts/sync-skills.mjs
```
