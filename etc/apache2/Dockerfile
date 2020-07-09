FROM php:7.3-apache

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libicu-dev \
        libxml2-dev \
        libpq-dev \
        libzip-dev \
        curl \
        libmagickwand-dev --no-install-recommends \
        libtool \
        libssl-dev \
        libpcre3-dev \
        libcurl4 \
        libpspell-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd iconv mbstring pdo pgsql pdo_mysql pdo_pgsql soap xml sockets zip xmlrpc

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN a2enmod actions proxy proxy_fcgi ssl rewrite headers expires

#set our application folder as an environment variable
ENV APP_HOME /var/www/html

#change uid and gid of apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

#change ownership of our applications
RUN chown -R www-data:www-data $APP_HOME
