#!/bin/bash
sudo rm -rf /usr/share/fsddev-app;sudo mkdir --mode=u+rwx,g+rwx,o-r /usr/share/fsddev-app; sudo chown -R www-data:www-data /usr/share/fsddev-app;
sudo mkdir --mode=u+rwx,g+rwx,o-r /usr/share/fsddev-app/cache; sudo chown -R www-data:www-data /usr/share/fsddev-app/cache;
sudo mkdir --mode=u+rwx,g+rwx,o-r /usr/share/fsddev-app/cache/prod; sudo chown -R www-data:www-data /usr/share/fsddev-app/cache/prod;
sudo mkdir --mode=u+rwx,g+rwx,o-r /usr/share/fsddev-app/cache/dev; sudo chown -R www-data:www-data /usr/share/fsddev-app/cache/dev;
