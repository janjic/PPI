#!/bin/bash
# Deploy script
rsync -a --no-perms --no-owner --no-group --progress --exclude-from='.gitignore' ./ root@207.154.192.245:/var/www/fsd_dev;ssh root@207.154.192.245 <<'ENDSSH'
cd /var/www/fsd_dev; curl -sS https://getcomposer.org/installer | php7.0;
cp /var/www/parameters.gitlab-ci.yml /var/www/fsd_dev/app/config/parameters.yml
cp /var/www/gitlab-ci.composer.lock /var/www/fsd_dev/composer.lock
rm -rf web/Resource
mkdir web/Resource
sudo chmod -R  755 bin.sh/*
sudo chown -R :www-data /var/www/fsd_dev;
rm app/config/theme_settings.yml
touch app/config/theme_settings.yml
rm app/config/plugin_settings.yml
touch app/config/plugin_settings.yml
rm -rf app/cache
rm -rf app/logs
rm -rf vendor
rm /usr/local/bin/uglifycss
rm /usr/local/bin/uglifyjs
ln -s  /usr/local/lib/npm/bin/uglifyjs /usr/local/bin/uglifyjs
ln -s  /usr/local/lib/npm/bin/uglifycss /usr/local/bin/uglifycss
php7.0 composer.phar install
php7.0 bin/console doctrine:database:create --if-not-exists
php7.0 bin/console doctrine:schema:update --force
php7.0 bin/console assets:install --env=prod --no-debug
php7.0  bin/console doctrine:cache:clear-metadata
php7.0  bin/console doctrine:cache:clear-query
php7.0  bin/console doctrine:cache:clear-result
php7.0 bin/console empire-cli:deploy --rclear=1  --ftheme=Fashion --btheme=Empire-Backend --env=prod --no-debug
sudo rm -rf /var/www/fsd_dev/app/cache;sudo mkdir --mode=u+rwx,g+rwx,o-r /var/www/fsd_dev/app/cache; sudo chown -R www-data:www-data /var/www/fsd_dev/app/cache;
sudo rm -rf /var/www/fsd_dev/app/logs;sudo mkdir --mode=u+rwx,g+rwx,o-r /var/www/fsd_dev/app/logs; sudo chown -R www-data:www-data /var/www/fsd_dev/app/logs;
php7.0 bin/console assetic:dump --env=prod --no-debug
sudo rm -rf /var/www/fsd_dev/app/cache;sudo mkdir --mode=u+rwx,g+rwx,o-r /var/www/fsd_dev/app/cache; sudo chown -R www-data:www-data /var/www/fsd_dev/app/cache;
sudo rm -rf /var/www/fsd_dev/app/logs;sudo mkdir --mode=u+rwx,g+rwx,o-r /var/www/fsd_dev/app/logs; sudo chown -R www-data:www-data /var/www/fsd_dev/app/logs;
ENDSSH

