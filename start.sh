#!/bin/bash
set -e

echo "=== BizCRM Railway Deployment Started ==="

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
  echo "Generating APP_KEY..."
  php artisan key:generate --force
fi

# Wait for database connection
echo "Waiting for database..."
for i in {1..30}; do
  if php artisan tinker --execute="DB::connection()->getPdo();" 2>/dev/null; then
    echo "Database connection established!"
    break
  fi
  echo "Attempt $i/30 - Waiting for database..."
  sleep 2
done

# Run migrations
echo "Running migrations..."
php artisan migrate --force --no-interaction

# Storage link
echo "Creating storage link..."
php artisan storage:link 2>/dev/null || true

# Optimize
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Seed if fresh install
echo "Running seeders..."
php artisan db:seed --force 2>/dev/null || true

# Configure Apache to listen on Railway's dynamic PORT
if [ -n "$PORT" ]; then
  echo "Configuring Apache for PORT: $PORT"
  sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf
  sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf
fi

echo "=== Starting BizCRM (Apache) on port ${PORT:-80} ==="
apache2-foreground
