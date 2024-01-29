#! /bin/bash

##	deploy:			instalamos lo que necesita el proyecto
deploy:
	- composer install
	- npm install
	- npm run dev
	- php bin/console doctrine:migrations:migrate --no-interaction
	- php bin/phpunit --testdox