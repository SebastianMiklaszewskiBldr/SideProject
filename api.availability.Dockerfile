ARG IMAGE_TAG
FROM php:${IMAGE_TAG}

RUN apk update \
    && apk add bash \
    && apk add autoconf \
    && apk add build-base \
    && apk add --update linux-headers \
    && apk add --no-cache postgresql-dev \
    && docker-php-ext-install pdo_pgsql pgsql

RUN pecl install redis && docker-php-ext-enable redis
RUN pecl install xdebug-3.2.1 && docker-php-ext-enable xdebug

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash \
    && apk add symfony-cli

COPY ./config/xdebug.ini.example /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY ./config/error_reporting.ini.example /usr/local/etc/php/conf.d/error_reporting.ini
