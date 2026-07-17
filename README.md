# vm-php-supabase-api-template

**Docker + PHP 8.3 (Slim)** Supabase Auth API from [@open-templates](https://github.com/open-templates). Same JSON contract as `cf-*-supabase-api-template` workers: `GET /health`, `GET /me`. Pairs with any **Supabase Auth** frontend (`react-`, `vue-`, `svelte-`, `astro-supabase-auth-template`).

Deploy on a VM with **Docker Compose**, optional **Terraform + cloud-init** on Oracle Cloud. See [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md).

## Quick start

1. **Use this template** on GitHub, then clone your repo.
2. Personalize: `./scripts/init-from-template.sh` (optional).
3. Configure and run:

```bash
cp .env.example .env
# SUPABASE_URL, SUPABASE_ANON_KEY, ALLOWED_ORIGINS
docker compose up -d
curl -s http://localhost:8080/health
```

Default API base URL for frontends: `http://localhost:8080` (`VITE_API_BASE_URL`).

## Documentation

| Doc | Purpose |
|-----|---------|
| [INSTRUCTIONS.md](INSTRUCTIONS.md) | Adopter + agent guide |
| [index.md](index.md) | OKF feature index |
| [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md) | Docker, Oracle Terraform, manual VM |
| [docs/SUPABASE_SETUP.md](docs/SUPABASE_SETUP.md) | Supabase project + OAuth |

## Stack

- PHP 8.3, Slim 4, Guzzle → Supabase `auth/v1/user`
- Nginx + PHP-FPM (Compose)
- Terraform (Oracle) + cloud-init bootstrap

## License

MIT
