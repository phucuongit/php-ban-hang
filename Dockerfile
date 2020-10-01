FROM php:7.2-fpm-alpine

WORKDIR /app

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql
RUN docker-php-ext-install pcntl

RUN apk update && apk add --no-cache \
    build-base shadow supervisor \
    php7-common \
    php7-pdo \
    php7-pdo_mysql \
    php7-mysqli \
    php7-mcrypt \
    php7-mbstring \
    php7-xml \
    php7-openssl \
    php7-json \
    php7-phar \
    php7-zip \
    php7-gd \
    php7-dom \
    php7-session \
    php7-zlib

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN usermod -u 1000 www-data

COPY . .
RUN mkdir /app/assets/img/upload
RUN chmod 755 /app/assets/img/upload
RUN chown -R www-data:www-data .
