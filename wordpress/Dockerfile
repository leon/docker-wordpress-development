FROM wordpress:5.3-php7.3-fpm

# Set timezone
RUN echo "Europe/Stockholm" > /etc/timezone && dpkg-reconfigure -f noninteractive tzdata

# Install unzip
RUN apt-get update && apt-get install -y unzip

# Install X-Debug for php 7
ENV XDEBUG_VERSION 2.8.0
ENV XDEBUG_SHA256 cb1d117ecbec7409a408cf24e59d92f7e3816fe8e2331dd0ffc3dce60228c264

RUN set -x \
	&& curl -SL "http://www.xdebug.org/files/xdebug-$XDEBUG_VERSION.tgz" -o xdebug.tgz \
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

# Install extra php extensions
RUN apt-get update && \
	apt-get install -y libcurl4-gnutls-dev && docker-php-ext-configure curl && docker-php-ext-install curl && \
	apt-get install -y zlib1g-dev libicu-dev g++ && docker-php-ext-configure intl && docker-php-ext-install intl && \
	apt-get install -y libxml++2.6-dev && docker-php-ext-install xml && \
	apt-get install -y libzip-dev && docker-php-ext-install zip && \
	docker-php-ext-install json && \
	docker-php-ext-install mbstring && \
	docker-php-ext-install soap

VOLUME /var/www/html

# Copy cusom php.ini which contains debug info
COPY ./php.ini /usr/local/etc/php/php.ini

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Copy phpinfo.php so that we can check that it is installed correctly
COPY ./phpinfo.php /var/www/html/phpinfo.php

# Workdir
WORKDIR /var/www/html/

# Expose Debug port
EXPOSE 9999
