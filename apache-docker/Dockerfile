# Use the official PHP image as a base
FROM php:8.2.14-apache

# Update the package list and install required dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli

# Install Composer - this allows us to install php packages
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite
