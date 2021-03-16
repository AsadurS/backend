After cloning repo.... 
composer install 
php artisan:migrate:fresh --seed
php artisan key:generate
php artisan jwt:secret
php artisan cache:clear
php artisan config:clear
