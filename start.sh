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

# Seed if fresh install (safe to ignore errors if already seeded)
php artisan db:seed --force 2>/dev/null || true

# Configure Apache to listen on Railway's dynamic PORT
if [ -n "$PORT" ]; then
  sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf
  sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf
fi

echo "Starting BizCRM (Apache) on port ${PORT:-80}..."
apache2-foreground
