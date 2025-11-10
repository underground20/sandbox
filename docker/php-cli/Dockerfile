FROM php:8.4-cli-alpine

RUN curl -sS https://getcomposer.org/installer | php -- \
--install-dir=/usr/bin --filename=composer

RUN apk update && apk add unzip autoconf g++ make libpq-dev \
    && apk add --update linux-headers \
    && docker-php-ext-install sockets

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

RUN addgroup -g 1000 app && adduser -u 1000 -G app -s /bin/sh -D app

WORKDIR /var/www/app

USER app
