#!/bin/bash
sudo rm -rf /usr/share/fsddev-app;sudo mkdir --mode=u+rwx,g+rwx,o-r /usr/share/fsddev-app; sudo chown -R vagrant:www-data /usr/share/fsddev-app;cd /var/www/fsd_dev;
composer install
sudo rm -rf /usr/share/fsddev-app;sudo mkdir --mode=u+rwx,grwx,o-r /usr/share/fsddev-app; sudo chown -R www-data:www-data /usr/share/fsddev-app;cd;
