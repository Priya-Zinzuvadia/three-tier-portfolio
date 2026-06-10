FROM php:8.2-apache

# Install native PDO MySQL extensions required for database handshakes
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite module if needed later for routing variations
RUN a2enmod rewrite

# Expose port 80 internally inside the container network grid
EXPOSE 80
