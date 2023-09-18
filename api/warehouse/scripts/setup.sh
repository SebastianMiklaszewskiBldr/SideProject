printf "Install actual dependencies \n"
composer install

printf "Run db migrations \n"
bin/console d:m:m --no-interaction --verbose
printf "Migrations executed \n"

