FROM ubuntu:22.04

WORKDIR /var/www/html

ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && \
    apt-get install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php -y && \
    apt-get update

RUN apt-get update && apt-get install -y \
    php8.3 \
    php8.3-ctype \
    php8.3-curl \
    php8.3-dom \
    php8.3-fpm \
    php8.3-gd \
    php8.3-intl \
    php8.3-mbstring \
    php8.3-pgsql \
    php8.3-mysql \
    php8.3-sqlite \
    php8.3-opcache \
    php8.3-phar \
    php8.3-xml \
    php8.3-xmlreader \
    php8.3-xdebug \
    php8.3-imagick \
    php8.3-raphf \
    php8.3-http \
    php8.3-zip \
    php8.3-soap \
    php8.3-redis \
    supervisor \
    nginx \
    iputils-ping \
    unzip \
    wget \
    curl \
    redis-tools \
    vim \
    git

RUN wget https://getcomposer.org/download/latest-stable/composer.phar && \
    chmod +x ./composer.phar && \
    mv ./composer.phar /usr/bin/composer

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN groupadd -g $GROUP_ID web && \
    useradd -m -N -g $GROUP_ID -u $USER_ID web && \
    usermod -L web && \
    chown web:web .

COPY docker/config/ /tmp/config/

RUN mv /tmp/config/nginx.conf /etc/nginx/nginx.conf && \
    mv /tmp/config/php/fpm-pool.conf /etc/php/8.3/fpm/pool.d/www.conf && \
    mv /tmp/config/php/php.ini /etc/php/8.3/fpm/conf.d/99-custom.ini && chmod 777 /etc/php/8.3/fpm/conf.d/99-custom.ini && \
    mv /tmp/config/php/xdebug.ini /etc/php/8.3/fpm/conf.d/99-custom-xdebug.ini && chmod 777 /etc/php/8.3/fpm/conf.d/99-custom-xdebug.ini && \
    mv /tmp/config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf && \
    chown -R web:web /var/www/html /run /var/lib/nginx /var/log/nginx /var/log/supervisor /etc/php /etc/nginx /etc/supervisor && \
    chmod -R 755 /var/www/html /var/log

USER web

# Entry point script
COPY --chown=web:web docker/entrypoint.sh /entrypoint.sh
RUN chown -R web:web /entrypoint.sh && chmod u+x /entrypoint.sh


EXPOSE 8080

ENTRYPOINT ["/entrypoint.sh"]
