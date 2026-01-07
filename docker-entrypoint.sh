#!/bin/bash

# Change ownership and permissions
chown -R www-data:www-data /var/www
chmod -R 755 /var/www/storage
chmod -R 755 /var/www/bootstrap/cache

# Execute the main command
exec "$@"