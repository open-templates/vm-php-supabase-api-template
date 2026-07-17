# vm-php-supabase-api-template — Agent Skills Index

## Project status

**PHP 8.3 + Slim 4** API in Docker (Nginx + PHP-FPM). Supabase Auth via `auth/v1/user`. Same `/health` and `/me` contract as Cloudflare worker templates.

Deployment: [docs/DEPLOYMENT.md](../../docs/DEPLOYMENT.md) · OKF: [index.md](../../index.md)

## OKF modules (local)

| Module | Use when |
|--------|----------|
| [docker-runtime](modules/docker-runtime.md) | Compose, Dockerfile, deploy scripts |
| [oracle-terraform](modules/oracle-terraform.md) | OCI Terraform + cloud-init |
| [json-responses](modules/json-responses.md) | Success/error envelope |
| [auth-middleware](modules/auth-middleware.md) | Bearer JWT gate for protected routes |

## Shared (synced)

* [auth/](shared/auth/) — JWT passthrough, session flow
* [supabase/](shared/supabase/) — dashboard OAuth, client patterns

## Agent read order

`INSTRUCTIONS.md` → `index.md` → this file → `shared/auth/`
