#!/bin/bash

if [[ ${ENV} = "DEV" ]]; then
    echo "Installing xdebug..."
    pecl install xdebug
    echo "xdebug has been installed"

    docker-php-ext-enable xdebug

    echo "Add configurations xdebug to php.ini file..."
    echo "xdebug.mode=develop,debug,coverage" >> ${PHP_INI_DIR}/conf.d/docker-php-ext-xdebug.ini
    echo "xdebug.start_with_request=yes" >> ${PHP_INI_DIR}/conf.d/docker-php-ext-xdebug.ini
    echo "xdebug.client_host=host.docker.internal" >> ${PHP_INI_DIR}/conf.d/docker-php-ext-xdebug.ini
    echo "xdebug.log=/tmp/xdebug.log" >> ${PHP_INI_DIR}/conf.d/docker-php-ext-xdebug.ini
    echo "xdebug configurations has been added"
fi
