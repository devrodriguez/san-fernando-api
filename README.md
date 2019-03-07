# san-fernando-api

-- Serving Application
php -S localhost:8000 -t public

php -S 192.168.0.26:8000 -t public

-- Create migration and table
php artisan make:migration create_dishes_table --create=dishes

-- Create migration and update table
php artisan make:migration create_dishes_table --table=dishes

-- Create model and migration
php artisan make:model Order --migration

-- Create resource controller
php artisan make:controller OrderController --resource

-- Create table seeder
php artisan make:seeder OrderSeeder