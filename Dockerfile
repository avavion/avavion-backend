FROM php:8.2-fpm

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV TZ=Europe/Moscow
ENV GROUP_NAME=dev
ENV USERNAME=dev
ENV USER_ID=1000
ENV GROUP_ID=1000

RUN groupadd --gid "$GROUP_ID" "$GROUP_NAME"

RUN useradd \
    --gid "$GROUP_ID" \
    --no-create-home \
    --uid "$USER_ID" \
    --shell /bin/bash \
    --groups "$GROUP_NAME" \
    $USERNAME

USER $USERNAME

WORKDIR /var/www/avavion

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

RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

EXPOSE 9000

CMD ["php-fpm"]
