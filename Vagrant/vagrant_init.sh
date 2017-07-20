#!/bin/bash
# Deploy script
sudo rm -rf web/Resource/*
sudo rm -rf /usr/share/fsddev-app;sudo mkdir --mode=u+rwx,g+rwx,o-r /usr/share/fsddev-app; sudo chown -R vagrant:www-data /usr/share/fsddev-app;cd /var/www/fsd_dev;
sudo rm -rf web/Resource/*
php7.0 bin/console doctrine:database:create
php7.0 bin/console doctrine:schema:update --force
php7.0 bin/console empire-cli:settings_install
php7.0 bin/console empire-cli:import_admin_default admin admin
php7.0 bin/console empire-cli:import_entities 10 10 10
php7.0 bin/console assets:install --env=prod --no-debug
Vagrant/vagrant_composer_install.sh
Vagrant/vagrant_deploy.sh

