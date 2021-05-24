#!/bin/bash
sudo curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin
sudo php /usr/local/bin/composer.phar
git clone https://github.com/jestinas/aspire.git aspire
cd aspire
cp .env.example .env
