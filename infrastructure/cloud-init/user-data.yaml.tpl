#cloud-config
package_update: true
packages:
  - git
  - curl
  - ca-certificates

write_files:
  - path: /opt/app.env
    permissions: "0600"
    content: |
      # Copy production secrets here after first boot, or use cloud-init secrets injection.
      APP_ENV=production
      SUPABASE_URL=
      SUPABASE_ANON_KEY=
      ALLOWED_ORIGINS=

runcmd:
  - curl -fsSL https://get.docker.com | sh
  - usermod -aG docker ubuntu
  - mkdir -p /opt/vm-php-supabase-api
  - git clone --branch ${git_branch} ${git_repo_url} /opt/vm-php-supabase-api || true
  - cp /opt/app.env /opt/vm-php-supabase-api/.env || true
  - cd /opt/vm-php-supabase-api && docker compose build && docker compose up -d
