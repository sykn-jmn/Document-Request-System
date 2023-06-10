# Use a PHP 8.1 base image
FROM php:8.1

# Set the working directory in the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    zlib1g-dev \
    libpng-dev \
    libzip-dev

# Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install the correct version of libzip
RUN pecl install -o -f zip

# Enable the installed PHP extension
RUN docker-php-ext-enable zip

# Install Node.js and NPM
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y nodejs

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the composer.json and composer.lock files
COPY composer.json composer.lock ./

# Install project dependencies
RUN composer install --optimize-autoloader --no-dev

# Copy the rest of the application code
COPY . .

# Build the assets using Vite
RUN npm install
RUN npm run production

# Expose port 80 (change if your Laravel app runs on a different port)
EXPOSE 80

# Start the PHP built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
