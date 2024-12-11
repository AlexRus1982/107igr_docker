FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libonig-dev \
    zip \
    libzip-dev \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl && \
    # pecl install xdebug-3.0.1 && \
    # docker-php-ext-enable xdebug && \
    docker-php-ext-install pdo_mysql mbstring zip exif pcntl && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    # Clear cache
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Add postgresql for laravel application
# RUN apt-get update && \
#     apt-get install -y --no-install-recommends libssl-dev zlib1g-dev curl git unzip libxml2-dev libpq-dev libzip-dev && \
#     pecl install apcu && \
#     docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
#     docker-php-ext-install -j$(nproc) zip opcache intl pdo_pgsql pgsql && \
#     docker-php-ext-enable apcu pdo_pgsql sodium && \
#     apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Add user for laravel application
RUN groupadd -g 1000 www && useradd -u 1000 -ms /bin/bash -g www www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]