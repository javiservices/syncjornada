#!/bin/bash
echo "=== FORCING FRESH MIGRATIONS ==="
php artisan migrate:fresh --force --seed
echo "=== MIGRATIONS COMPLETED ==="
