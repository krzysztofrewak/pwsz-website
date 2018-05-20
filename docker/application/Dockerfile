FROM php:7.1.8-apache

COPY . /var/www
COPY docker/application/httpd.conf /etc/apache2/sites-available/000-default.conf

RUN docker-php-ext-install mbstring pdo pdo_mysql
RUN pecl install -f redis xdebug
RUN echo "extension=phalcon.so" > /usr/local/etc/php/conf.d/phalcon.ini

WORKDIR /usr/src/php/ext/
RUN cd ~; git clone https://github.com/phalcon/cphalcon -b master --single-branch; cd ~/cphalcon/build; ./install; rm -rf ~/cphalcon

RUN chown -R www-data:www-data /var/www
RUN a2enmod rewrite
