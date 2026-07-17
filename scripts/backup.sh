#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
STAMP="$(date +%Y%m%d-%H%M%S)"
DEST="${1:-${ROOT}/backups}"

mkdir -p "${DEST}"

tar -czf "${DEST}/php-api-config-${STAMP}.tar.gz" \
  -C "${ROOT}" .env docker-compose.yml 2>/dev/null || true

echo "Wrote ${DEST}/php-api-config-${STAMP}.tar.gz"
echo "Store backups off the VM."
