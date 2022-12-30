FROM php:7.4.33-fpm

WORKDIR  /var/www/html

RUN docker-php-ext-install mysqli