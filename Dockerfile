FROM php:8.1-fpm

# Set the working directory
WORKDIR /var/www

# Install system dependencies required for PHP extensions and GD
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libicu-dev \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    libpq-dev \
    libbz2-dev \
    libmcrypt-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (other extensions first, then GD)
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl intl bcmath

# Install GD with the correct configuration (do not use --with-png-dir anymore)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Install Composer (for dependency management)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add a user and group for the application (recommended for better security)
RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/bash -g www www

# Copy application code and set correct permissions
COPY . /var/www
COPY --chown=www:www . /var/www

# Change to the 'www' user for running the application
USER www

# Expose port 9000 and start PHP-FPM server
EXPOSE 9000

# Set the command to run PHP-FPM
CMD ["php-fpm"]