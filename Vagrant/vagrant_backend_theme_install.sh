#!/bin/bash
# backend theme install script
sudo rm -rf /usr/share/fsddev-app;sudo mkdir --mode=u+rwx,g+rwx,o-r /usr/share/fsddev-app; sudo chown -R vagrant:www-data /usr/share/fsddev-app;cd /var/www/fsd_dev;
php7.0 bin/console empire-cli:backend_theme_install Empire-Backend
sudo rm -rf /usr/share/fsddev-app;sudo mkdir --mode=u+rwx,g+rwx,o-r /usr/share/fsddev-app; sudo chown -R www-data:www-data /usr/share/fsddev-app;
