FROM php:fpm-alpine

ENV APP_ENV=production
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/formzend

COPY . .

RUN chown -R www-data:www-data /var/www
RUN apk add --no-cache libxml2-dev && \
    docker-php-ext-install mysqli pdo pdo_mysql xml
RUN composer install --optimize-autoloader --no-dev && \
    php artisan route:cache && \
    php artisan view:cache
