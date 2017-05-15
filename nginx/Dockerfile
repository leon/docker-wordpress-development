FROM nginx:mainline-alpine

# Proxy conf
COPY ./proxy_params /etc/nginx/proxy_params

# Override conf
COPY ./server_include /etc/nginx/server_include

# Nginx config
COPY default.conf /etc/nginx/conf.d/default.conf
