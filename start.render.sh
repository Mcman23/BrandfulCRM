#!/bin/bash
set -e

echo "=== BizCRM Render Deployment ==="

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
  echo "Generating APP_KEY..."
  php artisan key:generate --force
fi

# Wait for database to be ready
echo "Waiting for database..."
sleep 5

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Storage link
echo "Creating storage link..."
php artisan storage:link || true

# Seed demo data (safe - ignores if already exists)
echo "Seeding database..."
php artisan db:seed --force || true

# Optimize
echo "Optimizing..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start server on Render's PORT
PORT=${PORT:-8000}
echo "Starting BizCRM on port ${PORT}..."
php artisan serve --host 0.0.0.0 --port ${PORT}
