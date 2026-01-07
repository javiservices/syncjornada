#!/bin/bash

echo "Running Laravel initialization..."

# Clear any previous cache
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Wait for database to be ready with retries
echo "Waiting for database to be ready..."
max_attempts=30
attempt=0

until php artisan migrate:status &> /dev/null || [ $attempt -eq $max_attempts ]; do
    echo "Database not ready yet... attempt $((attempt+1))/$max_attempts"
    sleep 5
    ((attempt++))
done

if [ $attempt -eq $max_attempts ]; then
    echo "Database connection failed after $max_attempts attempts"
    echo "Continuing without migrations - you may need to run them manually"
else
    echo "Database is ready!"
    
    # Run migrations
    echo "Running migrations..."
    php artisan migrate --force || {
        echo "Migrations failed, but continuing..."
    }
fi

# Create storage link
php artisan storage:link || true

# Cache configuration AFTER migrations
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "Laravel initialization completed!"
