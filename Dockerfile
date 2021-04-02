FROM php:fpm-alpine3.13
LABEL Name=napoleoncatrecruitment Version=0.0.1

RUN apk update

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apk add autoconf gcc libzmq git zeromq-dev zeromq coreutils build-base
RUN git clone git://github.com/mkoppanen/php-zmq.git \
 && cd php-zmq \
 && phpize && ./configure \
 && make \
 && make install \
 && cd .. \
 && rm -fr php-zmq 
RUN docker-php-ext-enable zmq

