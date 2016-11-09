#!/bin/sh

set -xe

username=laravel

if [ -d "/var/www/laravel/bootstrap/cache" ] && [ -d "/var/www/laravel/storage" ]; then
    setfacl -R -m u:www-data:rwx \
        /var/www/laravel/bootstrap/cache
        /var/www/laravel/storage
    setfacl -dR -m u:${username}:rwx \
        /var/www/laravel/bootstrap/cache
        /var/www/laravel/storage
fi

exec php-fpm
