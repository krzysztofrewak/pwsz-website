FROM php:7.1-apache

ARG PSR_VERSION=1.0.1
ARG PHALCON_VERSION=3.1.2
ARG PHALCON_EXT_PATH=php7/64bits
ARG COMPOSER_VERSION=2.0.7
ENV COMPOSER_HOME=/application/.composer
ENV COMPOSER_MEMORY_LIMIT=-1

RUN set -xe && \
    curl -LO https://github.com/jbboehr/php-psr/archive/v${PSR_VERSION}.tar.gz && \
    tar xzf ${PWD}/v${PSR_VERSION}.tar.gz && \
    curl -LO https://github.com/phalcon/cphalcon/archive/v${PHALCON_VERSION}.tar.gz && \
    tar xzf ${PWD}/v${PHALCON_VERSION}.tar.gz && \
    docker-php-ext-install -j $(getconf _NPROCESSORS_ONLN) \
    ${PWD}/php-psr-${PSR_VERSION} \
    ${PWD}/cphalcon-${PHALCON_VERSION}/build/${PHALCON_EXT_PATH} \
    && \
    rm -r \
    ${PWD}/v${PSR_VERSION}.tar.gz \
    ${PWD}/php-psr-${PSR_VERSION} \
    ${PWD}/v${PHALCON_VERSION}.tar.gz \
    ${PWD}/cphalcon-${PHALCON_VERSION} \
    && \
    php -m \
    && curl -sS https://getcomposer.org/installer | php -- --version=${COMPOSER_VERSION} --install-dir=/usr/local/bin --filename=composer

ADD apache-site.conf /etc/apache2/sites-available/000-default.conf
