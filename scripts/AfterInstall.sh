#!/bin/bash
# Set permissions to storage and bootstrap cache
sudo chmod -R 0777 /var/www/html/storage
sudo chmod -R 0777 /var/www/html/bootstrap/cache
#
cd /var/www/html
#
# Run composer
#sudo /usr/bin/composer.phar install --no-ansi --no-dev --no-suggest --no-interaction --no-progress --prefer-dist --no-scripts -d /var/www/html
#
# Run artisan commands
php /var/www/html/artisan migrate
php /var/www/html/artisan config:clear
php /var/www/html/artisan config:cache
php /var/www/html/artisan cache:clear
