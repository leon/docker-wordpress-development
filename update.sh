#!/bin/bash
set -eo pipefail

# Pull new versions of deps
docker pull nginx:mainline-alpine
docker pull wordpress:5.4-php7.4-fpm
docker pull php:7.4-fpm

# Build wordpress image
docker build wordpress -t leon/wordpress-development
docker build nginx -t leon/wordpress-development-nginx

# Build wordpress composer image
docker build composer-wordpress -t leon/wordpress-development-composer
docker build composer-nginx -t leon/wordpress-development-composer-nginx

# Push to hub
docker push leon/wordpress-development:latest
docker push leon/wordpress-development-nginx:latest

docker push leon/wordpress-development-composer:latest
docker push leon/wordpress-development-composer-nginx:latest
