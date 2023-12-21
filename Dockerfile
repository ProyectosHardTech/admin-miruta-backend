# Use an official PHP image as the base image
FROM php:7.4-apache

# Enable Apache modules
RUN a2enmod headers

# Install Git
RUN apt-get update \
    && apt-get install -y git

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy only the necessary files for composer
COPY composer.json composer.lock /var/www/html/

# Install project dependencies
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application code
COPY . /var/www/html

# Generate Composer autoload files
RUN composer dump-autoload --optimize

# Update Apache configuration to point to the public folder
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf

# Enable Apache modules
RUN a2enmod rewrite

# Expose the port on which Apache will run
EXPOSE 80

# Start Apache when the container starts
CMD ["apache2-foreground"]