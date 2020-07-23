FROM php:fpm-alpine

WORKDIR /var/www/formzend

RUN apk add --no-cache libxml2-dev && \
    docker-php-ext-install mysqli pdo pdo_mysql xml

ENTRYPOINT ["php", "artisan", "queue:work", "--tries=3"]
