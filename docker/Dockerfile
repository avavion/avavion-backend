FROM php:8.2-fpm

ENV GROUP=developers
ENV USER=avavion
ENV UID=1000
ENV GID=1000

RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git && \
      docker-php-ext-install pdo_mysql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN groupdel $GROUP

RUN addgroup --gid $GID $GROUP

RUN adduser \
    --disabled-password \
    --home "$(pwd)" \
    --no-create-home \
    --uid $UID \
    --gid $GID \
    $USER

COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

ENV TZ=Europe/Moscow

WORKDIR /var/www
