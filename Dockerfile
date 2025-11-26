FROM php:8.4-apache

ARG DEBIAN_FRONTEND=noninteractive

ENV TZ="Europe/Berlin"
ENV APP_ENV="dev"
ENV APACHE_DOCUMENT_ROOT="/var/www/html"
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update && \
    apt-get install -y \
        git \
        curl \
        unzip \
        libicu-dev \
        libpq-dev \
        libjpeg-dev \
        libpng-dev \
        zlib1g-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        libssl-dev \
        libmcrypt-dev \
        libsqlite3-dev \
        sqlite3 \
    && rm -rf /var/lib/apt/lists/*

# Node.js 24 LTS
RUN curl -fsSL https://deb.nodesource.com/setup_24.x | bash - && \
    apt-get install -y nodejs && \
    node -v && npm -v

# Apache-Configuration
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf && \
    sed -ri -e 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf && \
    a2enmod rewrite

# PHP-Timezone
RUN echo "date.timezone=${TZ}" > /usr/local/etc/php/conf.d/timezone.ini

# PHP Extensions
RUN docker-php-ext-configure intl && \
    docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install -j"$(nproc)" \
        intl \
        gd \
        mbstring \
        pdo_mysql \
        pdo_sqlite \
        xml \
        zip

# APCu and Xdebug
RUN set -eux; \
    pecl install apcu; \
    docker-php-ext-enable apcu; \
    if pecl install xdebug; then \
        docker-php-ext-enable xdebug; \
    else \
        echo "### Note: Xdebug is not available for this PHP version – skipped.."; \
    fi

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --install-dir=/usr/local/bin \
        --filename=composer

WORKDIR /var/www/html
COPY . /var/www/html

RUN git config --global --add safe.directory /var/www/html && \
    composer install \
        --no-interaction \
        --no-plugins \
        --no-scripts \
        --prefer-dist

RUN chown -R www-data:www-data /var/www/html && \
    rm -f /var/www/html/index.html

EXPOSE 80
CMD ["apache2-foreground"]
