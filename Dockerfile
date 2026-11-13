
FROM php:8.2-apache

# Instalar la conexión de PHP con MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Configurar Apache para Render
RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf
RUN sed -i 's/:80>/:10000>/' /etc/apache2/sites-available/000-default.conf

# Copiar el proyecto
COPY . /var/www/html/

# Puerto de Render
EXPOSE 10000

CMD ["apache2-foreground"]
