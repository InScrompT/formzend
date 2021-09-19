FROM --platform=arm64 php:8.0-fpm-alpine

RUN apk update && apk upgrade
RUN apk --update add \
    php8-curl \
    php8-mbstring \
    php8-bcmath \
    php8-json \
    php8-openssl \
    php8-tokenizer \
    php8-xml \
    php8-redis \
    php-zip
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

WORKDIR /project
