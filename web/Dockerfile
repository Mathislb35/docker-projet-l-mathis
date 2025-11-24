FROM php:8.2-apache

# Installer PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Répertoire de travail
WORKDIR /var/www/html

# Copier le code
COPY . /var/www/html

EXPOSE 80
