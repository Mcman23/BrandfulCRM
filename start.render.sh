#!/bin/bash
set -e

echo "=== BizCRM Render Deployment ==="

if [ -z "$APP_KEY" ]; then
  echo "Generating APP_KEY..."
  php artisan key:generate --force
fi

echo "Waiting for database..."
sleep 5

echo "Running migrations..."
php artisan migrate --force

echo "Creating storage link..."
php artisan storage:link 2>/dev/null || true

echo "Seeding database..."
php artisan db:seed --force 2>/dev/null || true

echo "Optimizing..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

PORT=${PORT:-8000}
echo "Starting BizCRM on port ${PORT}..."
php artisan serve --host 0.0.0.0 --port ${PORT}
