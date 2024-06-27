FROM php:8.2-apache

# Install Composer
COPY --from=composer:2.4.4 /usr/bin/composer /usr/local/bin/composer

ARG USER_ID=1000
ARG GROUP_ID=1000
ARG XDEBUG_ENABLED=false
ARG XDEBUG_CLIENT_HOST="host.docker.internal"
ARG XDEBUG_CLIENT_PORT=9003
ARG XDEBUG_IDE_KEY="PHPSTORM"

RUN apt-get install curl -y
RUN apt-get update && apt-get install -y libmcrypt-dev git zip unzip tzdata librabbitmq-dev gnupg2

RUN docker-php-ext-install pdo_mysql
RUN pecl install amqp
RUN docker-php-ext-enable amqp

RUN echo "Package: node* \nPin: release *\nPin-Priority: -1" > /etc/apt/preferences.d/no-debian-nodejs && \
    mkdir -p /etc/apt/keyrings && \
    curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg && \
    NODE_MAJOR=18 && \
    echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_MAJOR.x nodistro main" | tee /etc/apt/sources.list.d/nodesource.list && \
    apt-get update && \
    apt-get install nodejs -y

ADD ./etc/docker/php/php.ini /etc/php.ini

# timezone env with default
ENV TZ Europe/Madrid

RUN if [ ${XDEBUG_ENABLED} = "true" ] ; then \
        pecl install xdebug; \
        docker-php-ext-enable xdebug; \
        echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.client_host=${XDEBUG_CLIENT_HOST}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.client_port=${XDEBUG_CLIENT_PORT}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.idekey=${XDEBUG_IDE_KEY}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    fi ;

# Creamos usuario develop con UID de usuario local y ajustamos permisos
RUN groupadd develop -g 1000
RUN useradd -rm -d /home/develop -s /bin/bash -g develop -G root -o -u 1000 develop
RUN echo "develop:develop" | chpasswd && adduser develop sudo
RUN usermod -G www-data develop && usermod -G sudo develop


EXPOSE 9003
WORKDIR /var/www/html