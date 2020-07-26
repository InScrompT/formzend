FROM php:fpm-alpine

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY docker/start.sh /usr/local/bin/start
COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/formzend

COPY . .

RUN chown -R www-data:www-data /var/www \
    && chmod u+x /usr/local/bin/start
RUN apk add --no-cache libxml2-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql xml
RUN composer install --optimize-autoloader --no-dev \
    && php artisan route:cache && php artisan view:cache

CMD ["/usr/local/bin/start"]
