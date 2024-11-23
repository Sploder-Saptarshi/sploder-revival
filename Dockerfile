FROM php:8.3-apache

WORKDIR /var/www/html

RUN apt-get update \
  && apt-get install --no-install-recommends -y \
	libjpeg62-turbo-dev \
	libpng-dev \
  build-essential \
  curl \
  gifsicle \
  git \
  jpegoptim \
  libfreetype6-dev \
  libjpeg-dev \
  libmagickwand-dev \
  libonig-dev \
  libpq-dev \
  libsqlite3-dev \
  libssl-dev \
  libwebp-dev \
  libxml2-dev \
  libzip-dev \
  locales \
  optipng \
  pngquant \
  unzip \
  zip \
  zlib1g-dev \
  vim \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* 

RUN pecl install imagick \
  && docker-php-ext-enable imagick \
  && docker-php-ext-install mbstring gd pdo_pgsql pdo_sqlite xml sockets \
  && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
  && php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
  && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
  && php -r "unlink('composer-setup.php');"

COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev \
    --prefer-dist

COPY ./src /var/www/html/

EXPOSE 80

CMD ["apache2-foreground"]
