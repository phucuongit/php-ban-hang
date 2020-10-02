FROM php:7.2-fpm-alpine
RUN mkdir /app

WORKDIR /app

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql
RUN docker-php-ext-install pcntl

RUN apk update && apk add \
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
    php7-zlib -q

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY . .

RUN addgroup -g 1002 appgroup

RUN adduser -D -u 1002 appuser -G appgroup

RUN chown -R appuser:appgroup /app

USER appuser