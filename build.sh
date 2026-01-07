#!/bin/bash
set -e

echo "Running Laravel initialization..."

# Wait for database to be ready
echo "Waiting for database..."
sleep 10

# Run migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link || true

echo "Laravel initialization completed!"
