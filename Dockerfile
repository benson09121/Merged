FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY ./composer-installer.sh /usr/local/bin/composer-installer

ENV COMPOSER_ALLOW_SUPERUSER=1
EXPOSE 80


# install composer
RUN apt-get -yqq update \
&& apt-get -yqq install --no-install-recommends unzip \
&& chmod +x /usr/local/bin/composer-installer \
&& composer-installer \
&& mv composer.phar /usr/local/bin/composer \
&& chmod +x /usr/local/bin/composer \
&& composer --version

# Cache Composer dependencies
WORKDIR /tmp    
ADD app/composer.json app/composer.lock /tmp/
RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    && rm -rf composer.json composer.lock vendor/

# Add the project
ADD app /var/www/html


WORKDIR /var/www/html

COPY ./app/public /var/www/html


RUN chown -R www-data:www-data /var/www/html/html/php/new_items \
    && chmod -R 755 /var/www/html/html/php/new_items

RUN chown -R www-data:www-data /var/www/html/proof_of_payments \
    && chmod -R 755 /var/www/html/proof_of_payments
    
    RUN chown -R www-data:www-data /var/www/html/image_announcement \
    && chmod -R 755 /var/www/html/image_announcement

RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist


