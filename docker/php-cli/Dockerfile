FROM composer:2.9 as composer

FROM php:8.5-cli-alpine

RUN apk update && apk add unzip autoconf g++ make libpq-dev \
    && apk add --update linux-headers \
    && pecl install xdebug ds \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-enable xdebug ds

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

RUN addgroup -g 1000 app && adduser -u 1000 -G app -s /bin/sh -D app

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

COPY ./conf.d /usr/local/etc/php/conf.d

WORKDIR /var/www/app

USER app
