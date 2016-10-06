########################################
# Dockerfile - Laravel dev environment #
# ------------------------------------ #
# Created on 09/28/2016                #
########################################

# Base image - Ubuntu
FROM php:7.0-fpm-alpine

# Maintainer
MAINTAINER Guillaume Petitpierre

RUN set -xe \
    && apk add --no-cache \
        acl \
        autoconf \
        curl \
        g++ \
        gcc \
        icu-dev \
        libc-dev \
        libtool \
        imagemagick-dev \
        make \
        mysql-dev \
        nodejs \
        postgresql-dev \
        # Required by node-sass
        python \
    # Native modules
    && docker-php-ext-install \
        intl \
        pdo_mysql \
        pdo_pgsql \
    # PECL modules
    && pecl install \
        apcu \
        imagick \
        redis \
        xdebug \
    && docker-php-ext-enable \
        apcu \
        imagick \
        redis \
    # NPM global packages
    && npm install -g \
        gulp \
        node-gyp \
    # Clean up
    && apk del \
        autoconf \
        gcc \
        libc-dev \
        libtool \
    && rm -rf /var/cache/apk/* \
    # Composer
    && \
        curl -sS https://getcomposer.org/installer | \
            php -- --install-dir=/usr/local/bin --filename=composer

# User stuff.
RUN set -x \
    && adduser -h /home/laravel -s /bin/sh -D laravel
COPY boot.sh /usr/local/bin/boot.sh
RUN set -xe \
    && chmod +x /usr/local/bin/boot.sh

USER laravel
RUN ln -s /var/www/laravel /home/laravel/html

USER root
CMD [ "/usr/local/bin/boot.sh" ]
