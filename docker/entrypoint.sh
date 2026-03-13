#!/bin/sh
set -e

# Ensure storage directory structure exists (fresh volume is empty)
mkdir -p storage/framework/{sessions,views,cache/data} storage/logs
chown -R www-data:www-data storage
chmod -R 775 storage

php artisan config:cache
php artisan route:cache
php artisan view:cache

exec "$@"
