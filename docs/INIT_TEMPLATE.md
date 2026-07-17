# Initialize from template

Run from the repository root after **Use this template**:

```bash
./scripts/init-from-template.sh
```

This rewrites placeholders (repo name, author, paired frontend hint) and removes `scripts/` when complete.

## What stays

- `app/` — PHP API source
- `docker/`, `docker-compose.yml`
- `infrastructure/` — Terraform + cloud-init
- `docs/DEPLOYMENT.md` — full deploy guide

## After init

```bash
cp .env.example .env
docker compose up -d
```

See [INSTRUCTIONS.md](../INSTRUCTIONS.md) and [DEPLOYMENT.md](DEPLOYMENT.md).
