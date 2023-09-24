# Use the official PHP image with Apache for PHP 8.2
FROM php:8.2-apache

# Set working directory within the container
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && \
    apt-get install -y libpq-dev libjpeg-dev libpng-dev libfreetype6-dev zip unzip && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_mysql gd

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Set ownership of Laravel files to the Apache user
RUN chown -R www-data:www-data /var/www/html

# Copy the Laravel application files into the container
COPY . .

# Set ownership and permissions for Laravel storage directory
RUN chown -R www-data:www-data storage
RUN chmod -R 775 storage

# Copy the custom Apache configuration file for Laravel
COPY docker-config/laravel.conf /etc/apache2/sites-available/

# Enable the custom Apache configuration
RUN a2ensite laravel.conf

# Disable the default Apache configuration
RUN a2dissite 000-default.conf

# Expose port 80 for Apache (it's already done by the image, but you can leave it)
EXPOSE 80

# No need to specify CMD ["apache2-foreground"] as it's already set by the image
