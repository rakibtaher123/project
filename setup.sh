#!/bin/bash
set -e

# 1. Copy environment file if it doesn't exist
if [ ! -f .env ]; then
    cp .env.example .env
    echo "Environment file copied."
else
    echo ".env already exists, skipping copy."
fi

# 2. Install composer dependencies (ignore PHP version issues)
composer install --ignore-platform-reqs
composer dump-autoload
echo "Composer dependencies installed."

# 3. Generate application key
php artisan key:generate
echo "Application key generated."

# 4. Run migrations (fresh install: drops tables if they exist)
php artisan migrate:fresh --force
echo "Database migrated (fresh)."

# 5. Run seeders
php artisan db:seed --force
echo "Database seeded."

# 6. Create storage symbolic link
php artisan storage:link --force
echo "Storage link created."

echo "✅ Laravel project setup completed!"
echo "You can now run: php artisan serve"
