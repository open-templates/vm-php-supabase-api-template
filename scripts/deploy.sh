#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "${ROOT}"

if [[ ! -f .env ]]; then
  echo "Missing .env — copy .env.example and configure secrets."
  exit 1
fi

if [[ -n "${GIT_REPO_URL:-}" ]]; then
  git pull --ff-only || true
fi

docker compose build
docker compose up -d

echo "API listening on http://localhost:${APP_PORT:-8080} (see docker-compose.yml)"
