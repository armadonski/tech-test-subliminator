ARG PHP_VERSION

FROM php:${PHP_VERSION} as php-fpm
ENV TZ=Europe/Bucharest

COPY wait-for-it.sh /usr/bin/wait-for-it
RUN chmod +x /usr/bin/wait-for-it

RUN apk update \
    && apk add \
        git \
        sudo \
        bash \
    ;
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone;
RUN printf '[PHP]\ndate.timezone = "Europe/Bucharest"\n' > /usr/local/etc/php/conf.d/tzone.ini
RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo_mysql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && sudo mv composer.phar /usr/local/bin/composer \
    ;

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | sudo -E bash \
    && sudo apk add symfony-cli \
    ;

WORKDIR /var/www/subliminator

EXPOSE 9000