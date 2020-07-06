FROM wordpress:5.4-php7.4-fpm

# Set timezone
RUN echo "Europe/Stockholm" > /etc/timezone && dpkg-reconfigure -f noninteractive tzdata

# Install unzip
RUN apt-get update && apt-get install -y unzip

# Install X-Debug for php 7
ENV XDEBUG_VERSION 2.9.6
ENV XDEBUG_SHA256 ab03b6014706491b393aa8d520b5bdaf6735a2f1bc12a7772b2916ef2646e454

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

# Install extra php extensions
# Most of them are already installed by the wordpress docker
# RUN apt-get update && \
# 	apt-get install -y zlib1g-dev libicu-dev g++ && docker-php-ext-configure intl && docker-php-ext-install intl && \
# 	apt-get install -y libxml++2.6-dev && docker-php-ext-install xml && \
# 	docker-php-ext-install mbstring && \
# 	docker-php-ext-install soap

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
