FROM php:8.2-apache
# Instala permanentemente las extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql
# Copia tu código PHP al contenedor
COPY . /var/www/html