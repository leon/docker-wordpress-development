FROM php:8-fpm

# Set timezone
RUN echo "Europe/Stockholm" > /etc/timezone && dpkg-reconfigure -f noninteractive tzdata

# Install unzip
RUN apt-get update && apt-get install -y unzip

# Install X-Debug for php 8
ENV XDEBUG_VERSION 3.0.4
ENV XDEBUG_SHA256 b27290491f4634b0cd3badfc3a2be98fb1e3c0c3710a706724d8b195baad72af

RUN set -x \
	&& curl -SL "https://xdebug.org/files/xdebug-$XDEBUG_VERSION.tgz" -o xdebug.tgz \
	&& echo "$XDEBUG_SHA256 xdebug.tgz" | sha256sum -c - \
	&& mkdir -p /usr/src/xdebug \
	&& tar -xf xdebug.tgz -C /usr/src/xdebug --strip-components=1 \
	&& rm xdebug.* \
	&& cd /usr/src/xdebug \
	&& phpize \
	&& ./configure --enable-xdebug \
	&& make -j"$(nproc)" \
	&& make install \
	&& make clean

# Maybe not needed any more?

# Install extra php extensions
# RUN apt-get update && \
# 	apt-get install -y libcurl4-gnutls-dev && docker-php-ext-configure curl && docker-php-ext-install curl && \
# 	apt-get install -y zlib1g-dev libicu-dev g++ && docker-php-ext-configure intl && docker-php-ext-install intl && \
# 	apt-get install -y libxml++2.6-dev && docker-php-ext-install xml && \
# 	apt-get install -y libzip-dev && docker-php-ext-install zip && \
# 	docker-php-ext-install json && \
# 	docker-php-ext-install mbstring && \
# 	docker-php-ext-install soap

# Install php wordpress required extensions

# install the PHP extensions we need
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli opcache

VOLUME /var/www/html

# Copy custom configs
COPY ./php.ini /usr/local/etc/php/php.ini
COPY ./error-logging.ini /usr/local/etc/php/conf.d/error-logging.ini
COPY ./opcache-recommended.ini /usr/local/etc/php/conf.d/opcache-recommended.ini

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Copy phpinfo.php so that we can check that it is installed correctly
COPY ./phpinfo.php /var/www/html/phpinfo.php

# Workdir
WORKDIR /var/www/html/

# Expose Debug port
EXPOSE 9999

