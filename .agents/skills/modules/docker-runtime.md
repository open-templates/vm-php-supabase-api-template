---
type: Module
title: Docker runtime
description: Compose services, ports, and deploy scripts.
tags: [docker, deployment]
---

# Docker runtime

- `docker-compose.yml`: `php` (build `docker/Dockerfile`) + `nginx` on `${APP_PORT:-8080}`.
- App root: `app/` mounted into PHP container; `public/index.php` front controller.
- Production refresh: `./scripts/deploy.sh` (build + `up -d`).
- Logs: `docker compose logs -f php nginx`.

Spec: [08-docker-runtime.md](../../../specs/features/08-docker-runtime.md)
