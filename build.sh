#!/bin/bash

echo "Running Laravel initialization..."

# Wait for database to be ready with retries
echo "Waiting for database to be ready..."
max_attempts=60
attempt=0

until php artisan migrate:status &> /dev/null || [ $attempt -eq $max_attempts ]; do
    echo "Database not ready yet... attempt $((attempt+1))/$max_attempts"
    sleep 3
    ((attempt++))
done

if [ $attempt -eq $max_attempts ]; then
    echo "ERROR: Database connection failed after $max_attempts attempts"
    echo "Check your database configuration and try manual deploy later"
    exit 0
fi

echo "Database is ready!"

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Create storage link
php artisan storage:link || true

# Clear and cache
echo "Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Laravel initialization completed successfully!"
