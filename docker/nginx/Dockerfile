ARG NGINX_VERSION

FROM nginx:${NGINX_VERSION} as nginx

USER nginx

COPY ./php.conf /etc/nginx/conf.d/fastcgi/php.conf
COPY ./symfony.conf /etc/nginx/conf.d/default.conf
COPY ./upstream.conf /etc/nginx/conf.d/upstream.conf

WORKDIR /var/www/subliminator

EXPOSE 80

USER root