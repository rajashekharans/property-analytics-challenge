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

RUN a2enmod actions proxy proxy_fcgi ssl rewrite headers expires

#ENTRYPOINT "/var/www/html/bin/product_bootstrap.sh && /var/www/html/deamon/daemon_itinerary.sh" && /bin/sh
#RUN a2enmod headers
