#!/usr/bin/env bash
set -e

# Render sets PORT
PORT="${PORT:-10000}"

# Ensure storage is writable
mkdir -p storage bootstrap/cache
chmod -R 775 storage bootstrap/cache || true

# Cache config (safe)
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Migrations (if DB is configured)
php artisan migrate --force || true

# Start Laravel on the assigned port
php artisan serve --host=0.0.0.0 --port=$PORT
