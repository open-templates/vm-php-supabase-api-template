# Deployment

This document explains how to deploy **vm-php-supabase-api-template** using the supported deployment methods.

The project uses a layered deployment approach:

1. **Local development** — Docker Compose
2. **Cloud deployment** — Terraform (Oracle Cloud) + cloud-init
3. **Manual VM deployment** — `scripts/install.sh` + `scripts/deploy.sh`

Application source in `app/` is the canonical artifact. Runtime and infrastructure are automated.

See also [INSTRUCTIONS.md](../INSTRUCTIONS.md) and [specs/features/08-docker-runtime.md](../specs/features/08-docker-runtime.md).

---

## Requirements

### Required

- Git
- Docker
- Docker Compose (v2 plugin)

### Optional (Oracle Cloud)

- Oracle Cloud account
- Terraform CLI ≥ 1.5
- SSH key pair
- OCI API credentials (`~/.oci/config`)

---

## Project layout

```text
.
├── app/                    # PHP API (Composer, Slim)
├── docker/                 # Dockerfile + nginx.conf
├── infrastructure/
│   ├── terraform/oracle/   # OCI compute + cloud-init
│   └── cloud-init/
├── scripts/
│   ├── deploy.sh
│   ├── install.sh
│   └── backup.sh
├── docker-compose.yml
├── .env.example
└── README.md
```

---

## Environment

```bash
cp .env.example .env
```

Required for the API:

```env
SUPABASE_URL=
SUPABASE_ANON_KEY=
ALLOWED_ORIGINS=http://localhost:5173
```

Never commit `.env`.

---

## Local development

```bash
docker compose up -d
```

Stack:

```text
Nginx → PHP-FPM → Slim app
```

API base URL:

```text
http://localhost:8080
```

Health check:

```bash
curl -s http://localhost:8080/health
```

Logs:

```bash
docker compose logs -f
```

Stop:

```bash
docker compose down
```

---

## Production: Oracle Cloud (recommended)

```text
Terraform → Oracle VM → cloud-init → Docker → docker compose up
```

### 1. Prepare OCI

- Ubuntu 22.04+ compatible image (Terraform data source)
- Public subnet + security rules for **22**, **80**, **443** (and **8080** if not using Cloudflare proxy on 80)
- SSH public key

### 2. Configure Terraform

```bash
cd infrastructure/terraform/oracle
cp terraform.tfvars.example terraform.tfvars
```

Edit `compartment_id`, `region`, `availability_domain`, `subnet_id`, `ssh_public_key`, `git_repo_url`.

### 3. Deploy

```bash
terraform init
terraform plan
terraform apply
```

Outputs include `public_ip`.

### 4. Bootstrap

cloud-init installs Docker, clones `git_repo_url`, copies `/opt/app.env` to `.env`, runs `docker compose up -d`.

Verify:

```bash
ssh ubuntu@SERVER_IP docker ps
curl -s http://SERVER_IP/health
```

### 5. Domain and HTTPS

Recommended:

```text
api.example.com → Cloudflare proxy → Oracle VM :80
```

---

## Manual VM

```bash
sudo ./scripts/install.sh
git clone <your-repo>
cd <repo>
cp .env.example .env
./scripts/deploy.sh
```

---

## Updates

```bash
git pull
docker compose build
docker compose up -d
```

Or `./scripts/deploy.sh`.

---

## Backups

```bash
./scripts/backup.sh /path/off/vm
```

Backs up `.env` and `docker-compose.yml`. Add database dumps when you extend the template.

---

## Security checklist

- [ ] Rotate Supabase keys; never commit secrets
- [ ] HTTPS at the edge (Cloudflare or reverse proxy)
- [ ] Firewall: SSH from trusted IPs only
- [ ] SSH keys only; disable password auth
- [ ] Patch OS and rebuild images regularly

---

## Philosophy

```text
Git → Application → Docker → Terraform → Cloud
```

No golden VM snapshots — reproducible from source.

---

## Other targets

Same Compose stack runs on Proxmox, VMware, other clouds; only `infrastructure/` changes.
