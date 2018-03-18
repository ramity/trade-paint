FROM php:7.2.1-apache

MAINTAINER Lewis Brown "github.com/ramity"

COPY ./config/php.ini /usr/local/etc/php/php.ini
COPY ./config/apache.conf /etc/apache2/sites-available/000-default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install php extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli opcache sockets
RUN docker-php-ext-enable opcache

EXPOSE 22 80
