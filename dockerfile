FROM php:8.2-apache

# 1. Instala extensiones de MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 2. Cambia el DocumentRoot de Apache a la carpeta /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/perfil!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. Copia todo tu proyecto al contenedor
COPY . /var/www/html/

# 4. Asegura permisos para el servidor
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80
