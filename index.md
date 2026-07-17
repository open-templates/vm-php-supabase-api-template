---
okf_version: "0.1"
---

# vm-php-supabase-api-template

OKF knowledge bundle for the Docker/VM PHP API (Supabase Auth).

## Documentation

* [README.md](README.md) — quick start
* [INSTRUCTIONS.md](INSTRUCTIONS.md) — adopter and agent guide
* [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md) — Docker, Oracle Terraform, manual VM

## Features

* [01 — Purpose](specs/features/01-purpose.md) — goals and pairing
* [02 — Health endpoint](specs/features/02-health-endpoint.md) — `GET /health`
* [03 — Me endpoint](specs/features/03-me-endpoint.md) — `GET /me` with JWT
* [04 — Middleware](specs/features/04-middleware.md) — CORS, auth, errors
* [05 — Supabase integration](specs/features/05-supabase-integration.md) — Auth REST client
* [06 — Frontend pairing](specs/features/06-frontend-pairing.md) — SPA contract
* [07 — Extension guidelines](specs/features/07-extension-guidelines.md) — new routes
* [08 — Docker runtime](specs/features/08-docker-runtime.md) — Compose stack
* [09 — Oracle Terraform](specs/features/09-oracle-terraform.md) — cloud bootstrap

## Skills

* [.agents/skills/index.md](.agents/skills/index.md)
* [.agents/skills/README.md](.agents/skills/README.md)
* [.agents/skills/shared/](.agents/skills/shared/) — synced auth + Supabase

## History

* [specs/log.md](specs/log.md)
