FROM ubuntu:23.10

ARG DEBIAN_FRONTEND=noninteractive

ENV TZ="Europe/Berlin"
ENV APP_ENV="dev"

RUN apt-get update && \
    apt-get install -y apache2 \
        git \
        curl \
        composer \
        nodejs \
        npm \
        sqlite3 \
        unzip \
        php \
        php-cli \
        php-curl \
        php8.2-dev \
        php-apcu \
        php-gd \
        php-intl \
        php-mbstring \
        php-pear \
        php-pdo \
        php-sqlite3 \
        php-simplexml \
        php-xdebug \
        php-zip \
        libapache2-mod-php \
        libssl-dev \
        libmcrypt-dev \
        libicu-dev \
        libpq-dev \
        libjpeg-dev \
        libpng-dev \
        zlib1g-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev && \
    rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

# Set document root to /var/www/html
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Allow .htaccess files to be used
RUN sed -ri -e 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

COPY . /var/www/html

WORKDIR /var/www/html

RUN chown -R www-data.www-data /var/www/html

# Remove ubuntu index.html
RUN rm /var/www/html/index.html

EXPOSE 80

CMD apachectl -D FOREGROUND

