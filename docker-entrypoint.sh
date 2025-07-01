#!/bin/bash

# Wait for database to be ready
until php artisan db:monitor --max-attempts=60; do
    echo "Database is unavailable - waiting..."
    sleep 1
done

# Run database migrations
php artisan migrate:fresh --force

# Run database seeder
php artisan db:seed --force

# Start PHP-FPM
php-fpm 