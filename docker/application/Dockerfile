FROM php:7.1.8-apache

COPY . /var/www
COPY docker/application/httpd.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update &&  \
	apt-get install -y --no-install-recommends \
	gcc \
	git

RUN docker-php-ext-install mbstring pdo pdo_mysql
RUN pecl install -f redis xdebug

RUN git clone --depth=1 git://github.com/phalcon/cphalcon.git /root/buildphalcon
RUN cd /root/buildphalcon/build/php7/64bits && \
    phpize && export CFLAGS="-O2 -s" && \
    ./configure && make -j 8 && make install && \
    echo "extension=phalcon.so" > /usr/local/etc/php/conf.d/30-phalcon.ini && \
	rm -Rf /root/buildphalcon

RUN chown -R www-data:www-data /var/www
RUN a2enmod rewrite
