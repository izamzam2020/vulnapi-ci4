FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo_mysql mysqli mbstring exif pcntl bcmath gd intl zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory
COPY . /var/www/html

# Create uploads directory and set permissions
RUN mkdir -p /var/www/html/public/uploads \
    && mkdir -p /tmp \
    && chown -R www-data:www-data /var/www/html \
    && chown -R www-data:www-data /tmp \
    && chmod -R 755 /var/www/html/writable \
    && chmod -R 777 /var/www/html/public/uploads \
    && chmod -R 777 /tmp

# Expose port 9000 for PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]

