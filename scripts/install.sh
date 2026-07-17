#!/usr/bin/env bash
set -euo pipefail

# Bootstrap Docker on Ubuntu (manual VM or cloud-init helper).
if [[ "${EUID}" -ne 0 ]]; then
  echo "Run as root: sudo $0"
  exit 1
fi

export DEBIAN_FRONTEND=noninteractive
apt-get update
apt-get install -y ca-certificates curl git

if ! command -v docker >/dev/null 2>&1; then
  curl -fsSL https://get.docker.com | sh
fi

if ! docker compose version >/dev/null 2>&1; then
  apt-get install -y docker-compose-plugin || true
fi

usermod -aG docker "${SUDO_USER:-ubuntu}" 2>/dev/null || true

echo "Docker installed. Log out and back in, then run scripts/deploy.sh"
