#!/bin/bash

# Wait for MySQL to be ready
echo "Waiting for MySQL to be ready..."
while ! nc -z db 3306; do
    sleep 1
done
echo "MySQL is ready!"

# Generate application key
php artisan key:generate --force

# Run database migrations
php artisan migrate:fresh --force

# Run database seeder
php artisan db:seed --force

php artisan storage:link

echo "Laravel application has been initialized!" 