FROM php:8.2-apache
WORKDIR /var/www/html/



RUN apt-get update -y && apt-get install -y libmariadb-dev && apt-get install nano
RUN docker-php-ext-install mysqli && docker-php-ext-install pdo_mysql
