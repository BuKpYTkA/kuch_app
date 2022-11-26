FROM php:8.1-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-install exif
RUN docker-php-ext-configure exif \
            --enable-exif


WORKDIR /app

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

EXPOSE 9000
