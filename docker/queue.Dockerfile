FROM php:fpm-alpine

WORKDIR /var/www/formzend

RUN chown -R www-data:www-data /var/www
RUN apk add --no-cache libxml2-dev && \
    docker-php-ext-install mysqli pdo pdo_mysql xml
RUN composer install --optimize-autoloader --no-dev && \
    php artisan route:cache && \
    php artisan view:cache

ENTRYPOINT ["php", "artisan", "queue:work", "--tries=3"]
