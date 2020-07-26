#!/usr/bin/env sh

set -e

php artisan queue:work --verbose --tries=3 --timeout=90 &
exec php-fpm
