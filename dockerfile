FROM php:8.2-apache

# Instala las extensiones necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html/
EXPOSE 80
