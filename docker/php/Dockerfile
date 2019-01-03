FROM php:5.6-fpm

# Update lists of packages and install required
RUN apt-get update
RUN apt-get install -y \
    unzip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/Moscow /etc/localtime

WORKDIR /var/www/app/backend