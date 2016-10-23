#!/usr/bin/env bash
echo 'Start "vm.provision.sh"'

DBPASSWD=root
sudo mysqladmin -u root password $DBPASSWD > /dev/null 2>&1
mysql -u root -p$DBPASSWD -e "CREATE DATABASE IF NOT EXISTS app" > /dev/null 2>&1

sudo service nginx restart > /dev/null 2>&1
sudo composer self-update > /dev/null 2>&1
cp /var/www/app/.env.example /var/www/app/.env
cd /var/www/app && composer install > /dev/null 2>&1
php /var/www/app/artisan key:generate
php /var/www/app/artisan migrate
php /var/www/app/artisan db:seed

echo 'Provision complete.'