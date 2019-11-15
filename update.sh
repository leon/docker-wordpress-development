#!/bin/bash
set -eo pipefail

# Pull new versions of deps
docker pull nginx:mainline-alpine
docker pull wordpress:5.3-php7.3-fpm
docker pull php:7.3-fpm

# Build wordpress image
docker build wordpress -t wec360/wordpress-development
docker build nginx -t wec360/wordpress-development-nginx

# Build wordpress composer image
docker build composer-wordpress -t wec360/wordpress-development-composer
docker build composer-nginx -t wec360/wordpress-development-composer-nginx

# Push to hub
docker push wec360/wordpress-development:latest
docker push wec360/wordpress-development-nginx:latest

docker push wec360/wordpress-development-composer:latest
docker push wec360/wordpress-development-composer-nginx:latest
