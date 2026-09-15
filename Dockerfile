FROM wordpress:cli AS wpcli
FROM composer:2 AS composer

FROM php:8.3-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git unzip libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
        libicu-dev libzip-dev libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" gd intl mbstring mysqli pdo_mysql zip opcache \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer /usr/bin/composer /usr/local/bin/composer
COPY --from=wpcli /usr/local/bin/wp /usr/local/bin/wp
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php/wordpress.ini /usr/local/etc/php/conf.d/wordpress.ini

WORKDIR /var/www/html
