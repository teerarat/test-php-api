FROM php:apache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite
RUN docker-php-ext-install pdo_mysql
RUN apt-get update && apt-get install -y zlib1g-dev libzip-dev unzip zip \ 
    && docker-php-ext-install zip
RUN pecl install redis && docker-php-ext-enable redis
WORKDIR /var/www/html

COPY composer.lock /var/www/html
COPY composer.json /var/www/html
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer install

COPY . /var/www/html
RUN chown -R www-data:www-data .
RUN composer development-disable
