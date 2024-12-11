#!/bin/bash

set -e

echo "Deploying..."
git reset --hard
git pull https:://git@github.com:AlexRus1982/107igr_docker.git

#ssh://git@212.192.202.82:8822/AlexRus/metall-trade.dev.ru.git

# git command https://[token]@github.com/[user]/[repository].git
# git pull ssh://git@212.192.202.82:8822/AlexRus/metall.dev.ru.git
# git checkout dev

alias php-composer="php8.2 composer.phar"
alias artisan="php8.2 artisan"

# php-composer install --no-dev --optimize-autoloader
php-composer install
artisan migrate --force
artisan cache:clear
artisan config:cache
artisan event:cache
artisan route:cache
artisan view:cache

echo "Done."