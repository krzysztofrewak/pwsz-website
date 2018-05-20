FROM php:7.1.8-apache

COPY . /var/www
COPY docker/application/httpd.conf /etc/apache2/sites-available/000-default.conf

RUN docker-php-ext-install mbstring pdo pdo_mysql \
&& chown -R www-data:www-data /var/www \
&& a2enmod rewrite

RUN cd ~; git clone https://github.com/phalcon/cphalcon -b master --single-branch; cd ~/cphalcon/build; ./install; rm -rf ~/cphalcon