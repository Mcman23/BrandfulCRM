#!/bin/bash
set -e

echo "=== BizCRM Render Deployment ==="

# APP_KEY should come from Render's dashboard env vars (persists across
# deploys). If somehow missing, generate one for THIS process only -
# never try to write it to a .env file, since no .env file exists in
# the container (Render injects env vars directly into the process).
if [ -z "$APP_KEY" ]; then
  echo "WARNING: APP_KEY not set via environment, generating a temporary one..."
  export APP_KEY="base64:$(php -r 'echo base64_encode(random_bytes(32));')"
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
