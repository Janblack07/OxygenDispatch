#!/usr/bin/env bash
set -e

PORT="${PORT:-10000}"

php artisan config:clear || true
php artisan view:clear || true

php artisan migrate --force
php artisan db:seed --force

php artisan serve --host=0.0.0.0 --port=$PORT
