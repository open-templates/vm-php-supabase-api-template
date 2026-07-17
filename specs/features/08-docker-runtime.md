---
type: Feature
title: Docker runtime
description: Nginx + PHP-FPM Compose stack for local and VM.
tags: [docker, deployment]
timestamp: 2026-07-17T00:00:00Z
---

# Docker runtime

```text
Host :8080 → nginx:80 → php-fpm:9000 → app/public/index.php
```

Files:

- `docker-compose.yml` — `php` + `nginx` services (PHP image includes `vendor/` from build)
- `docker-compose.override.yml.example` — optional bind mount for local PHP edits
- `docker/Dockerfile` — PHP 8.3-FPM, Composer vendor install
- `docker/nginx.conf` — front controller to `index.php`

Commands:

```bash
docker compose up -d
docker compose logs -f
./scripts/deploy.sh
```

See [docs/DEPLOYMENT.md](../../docs/DEPLOYMENT.md).
