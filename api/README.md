docker-compose up -d

docker exec -it infuse-laravel bash

composer install

./vendor/bin/sail php artisan migrate

./vendor/bin/sail php artisan db:seed --class=DatabaseSeeder

./vendor/bin/sail up
<!-- http://127.0.0.1:89/api/users -->
