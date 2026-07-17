FROM php:8.3-fpm-alpine

RUN apk add --no-cache git unzip \
    && docker-php-ext-install opcache

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY app/composer.json app/composer.lock* ./
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader \
    || composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader --no-scripts

COPY app/ .

RUN chown -R www-data:www-data /var/www/html

USER www-data

EXPOSE 9000
