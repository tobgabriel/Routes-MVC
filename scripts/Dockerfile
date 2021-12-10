FROM php:7.2-apache
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN a2enmod rewrite
RUN service apache2 restart
