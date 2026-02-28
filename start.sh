#!/usr/bin/env bash
set -e

echo "==> App starting..."

# Si tu APP_KEY no existiera, podrías generarla (pero tú ya la tienes en env):
# php artisan key:generate --force || true

echo "==> Running migrations..."
php artisan migrate --force

echo "==> Running seeders..."
php artisan db:seed --force

echo "==> Caching config/routes/views..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "==> Serving on 0.0.0.0:${PORT:-8080}"
php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
