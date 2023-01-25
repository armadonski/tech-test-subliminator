ARG PHP_VERSION

FROM php:${PHP_VERSION} as php-fpm
ENV TZ=Europe/Bucharest

RUN apk update \
    && apk add \
     #   libzip-dev \
     #   libxml2-dev \
     #   rabbitmq-c-dev \
     #   libssh-dev \
      #  unzip \
        git \
        sudo \
       # vim \
       # tzdata \
        bash \
    ;
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone;
RUN printf '[PHP]\ndate.timezone = "Europe/Bucharest"\n' > /usr/local/etc/php/conf.d/tzone.ini

#RUN apk upgrade --update-cache --available && \
#    apk add openssl && \
#    rm -rf /var/cache/apk/*

#ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

#RUN chmod +x /usr/local/bin/install-php-extensions && sync && install-php-extensions mongodb amqp

#RUN docker-php-ext-install sockets

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