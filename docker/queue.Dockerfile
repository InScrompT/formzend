FROM php:fpm-alpine

WORKDIR /var/www/formzend

ENTRYPOINT ["php", "artisan", "queue:work", "--tries=3"]
