# Use a specific PHP version
FROM php:8.2-fpm AS base


# Set working directory
WORKDIR /var/www

# Copy the application code
COPY . .

# Install dependencies
RUN apt-get update && apt-get install -y libzip-dev unzip && \
    docker-php-ext-install zip

# Install Composer (specific version)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose the application port
EXPOSE 9000

# Command to run the PHP server
CMD ["php-fpm"]
