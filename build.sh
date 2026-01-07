#!/bin/bash
set -e

echo "Running Laravel initialization..."

# Clear any previous cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Wait for database to be ready
echo "Waiting for database..."
sleep 10

# Run migrations
php artisan migrate --force

# Create storage link
php artisan storage:link || true

# Cache configuration AFTER migrations
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Laravel initialization completed!"
