#!/bin/bash
php7.0  bin/console doctrine:cache:clear-metadata
php7.0  bin/console doctrine:cache:clear-query
php7.0  bin/console doctrine:cache:clear-result
php7.0  bin/console doctrine:schema:update --force
