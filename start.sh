# Install dependencies without production optimizations
composer install &
wait $!

chown -R www-data:www-data /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/storage/app #optinal
chown -R www-data:www-data /var/www/html/storage/app/public #optinal
chown -R www-data:www-data /var/www/html/storage/app/private #optinal
chmod -R g+s /var/www/html/storage

# Generate key and run migrations first
# php artisan migrate:fresh --seed
php artisan key:generate --force
php artisan migrate --force

# THEN clear caches (this preserves the built assets)
php artisan optimize:clear
php artisan optimize
# Laravel optimizations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link if needed
php artisan storage:link

# Retry failed jobs
php artisan queue:retry all

# Start services
apache2-foreground &
php artisan reverb:start --port=8090 &
php artisan queue:work

