FROM php:8.2-apache

# 1. Instala extensiones de PostgreSQL y MySQL (por si acaso)
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mysqli pdo_mysql

# 2. Configura el DocumentRoot a /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/perfil!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. Copia el proyecto
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80