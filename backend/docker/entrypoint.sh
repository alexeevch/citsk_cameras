#!/bin/bash

if [[ -z $XDEBUG ]]; then
  echo "xdebug.mode=off" >> /etc/php/8.3/fpm/conf.d/99-custom-xdebug.ini
fi

cd /var/www/html || exit 1

/usr/bin/env bash -lc 'if [[ -f composer.json ]] && { [[ ! -f vendor/autoload.php ]] || [[ "$COMPOSER_INSTALL" == "1" ]]; }; then echo "Installing PHP dependencies..."; composer install --no-interaction --prefer-dist; fi'

/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
