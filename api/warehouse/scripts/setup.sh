printf "Install actual dependencies \n"
composer install

printf "Run \"read\" db migrations \n"
bin/console d:m:m --em=read --no-interaction
printf "Run \"write\" db migrations \n"
bin/console d:m:m --em=write --no-interaction


