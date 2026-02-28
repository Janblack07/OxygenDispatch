#!/bin/bash

composer install
npm install --production
php artisan optimize
php artisan storage:link
php artisan migrate:fresh --seed
# Ejecutar servidor web en segundo plano
php -S 0.0.0.0:8080 -t public &

# Ejecutar worker en primer plano
php artisan queue:work
