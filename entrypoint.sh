#!/bin/bash

# running some shell code here as i cant run script in render manually
php artisan config:clear
php artisan cache:clear
php artisan view:clear

php artisan migrate --force

apache2-foreground
