FROM composer:2.9 as composer

FROM php:8.5-cli-alpine

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

RUN addgroup -g 1000 app && adduser -u 1000 -G app -s /bin/sh -D app

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/app

USER app
