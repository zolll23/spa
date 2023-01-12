FROM php:8.1.5-fpm

# PDO расширения
RUN apt-get update \
    && apt-get install -y libpq-dev freetds-bin freetds-dev freetds-common libsybdb5 \
    && ln -s /usr/lib/x86_64-linux-gnu/libsybdb.so /usr/lib/ \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql pdo_dblib

# Zip
RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-configure zip \
  && docker-php-ext-install zip

# Setup GD extension
RUN apt-get update && \
    apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-install gd

# composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./entrypoint.sh /entrypoint.sh
COPY devinstall.sh devinstall.sh

RUN echo '[PHP]\ndate.timezone = "Europe/Moscow"\n' > /usr/local/etc/php/conf.d/tzone.ini

RUN chmod u+x /entrypoint.sh

CMD /entrypoint.sh

ARG ENV
RUN chmod u+x devinstall.sh && ./devinstall.sh
