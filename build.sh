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

# Check if migrations table exists
echo "Checking database state..."
MIGRATIONS_EXIST=$(php artisan migrate:status 2>&1 | grep -c "Migration table not found" || true)

if [ "$MIGRATIONS_EXIST" -gt 0 ]; then
    echo "Fresh database detected, running migrations..."
    php artisan migrate --force
else
    echo "Database has migrations, checking status..."
    # Try regular migrate (will skip already run migrations)
    php artisan migrate --force 2>&1 | grep -q "Nothing to migrate" && echo "Database already up to date" || {
        echo "Migrations have conflicts, running fresh migration..."
        php artisan migrate:fresh --force
    }
fi

# Create storage link
php artisan storage:link || true

# Cache configuration
echo "Optimizing application..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "Laravel initialization completed!"
