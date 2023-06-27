#FROM php:8.2-fpm
#
#WORKDIR /var/www
#
#COPY composer.lock composer.json /var/www/
#
#RUN apt-get update && apt-get install -y \
#    build-essential \
#    libpng-dev \
#    libpq-dev \
#    libjpeg62-turbo-dev \
#    libfreetype6-dev \
#    locales \
#    libzip-dev \
#    zip unzip \
#    vim \
#    git \
#    curl
#
#RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
#RUN docker-php-ext-install gd

FROM php:8.2-fpm

ENV TZ=Europe/Moscow

WORKDIR /var/www/avavion-backend

RUN apt-get update && apt-get install -y \
		libfreetype-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
        git \
        curl \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd \
        && docker-php-ext-install pdo_mysql mbstring zip exif pcntl \

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY composer.lock /var/www/avavion-backend
COPY composer.json /var/www/avavion-backend

RUN composer install -d /var/www/avavion-backend

CMD ["echo", "hello world!"]