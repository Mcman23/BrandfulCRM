#!/bin/bash
set -e

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
  echo "Generating APP_KEY..."
  php artisan key:generate --force
fi

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Storage link
echo "Creating storage link..."
php artisan storage:link 2>/dev/null || true

# Optimize
echo "Caching config..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Seed if fresh install
php artisan db:seed --force 2>/dev/null || true

# Start server
echo "Starting BizCRM on port ${PORT:-8000}..."
php artisan serve --host 0.0.0.0 --port ${PORT:-8000}
