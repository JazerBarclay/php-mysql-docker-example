FROM php:7.3-apache
RUN apt-get update && apt-get -y upgrade
RUN docker-php-ext-install mysqli
EXPOSE 80
