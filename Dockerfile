FROM php:8.0-fpm

# Install required extensions
RUN pdo pdo_mysql

# Set working directory
WORKDIR /var/www/html
