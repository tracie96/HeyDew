#!/bin/bash
#install composer


#ssh into docker container

docker exec --tty peexoo-api_app_1 /bin/ash
sleep 5s
php artisan migrate -vvv --force
exit