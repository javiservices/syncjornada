#!/bin/bash

echo "Running Laravel initialization..."

# Wait a bit for services to be fully ready
sleep 10

# Clear all cache first
echo "Clearing cache..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Try migrations with retries
echo "Running migrations..."
max_attempts=5
attempt=0

until php artisan migrate --force 2>&1 || [ $attempt -eq $max_attempts ]; do
    echo "Migration attempt $((attempt+1))/$max_attempts failed, retrying..."
    sleep 5
    ((attempt++))
done

if [ $attempt -eq $max_attempts ]; then
    echo "WARNING: Migrations failed after $max_attempts attempts"
    echo "You may need to run migrations manually"
else
    echo "Migrations completed successfully!"
fi

# Create storage link
php artisan storage:link || true

# Cache configuration
echo "Optimizing application..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "Laravel initialization completed!"
