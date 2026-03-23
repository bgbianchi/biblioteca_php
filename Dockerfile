FROM php:8.2-apache
# Instala permanentemente las extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql
# Copia tu código PHP al contenedor
COPY . /var/www/html
# Asegurar que Apache sea el dueño de los archivos
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html