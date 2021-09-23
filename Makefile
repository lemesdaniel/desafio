up:
	@docker-compose up -d
down:
	@docker-compose down
build:
	@docker-compose up --build -d
phpunit:
	@docker exec desafio-php vendor/bin/phpunit
pest:
	@docker exec desafio-php vendor/bin/pest --parallel --coverage --coverage-html tests/reports/coverage/
infection:
	@docker exec desafio-php vendor/bin/infection
composer-install:
	@docker exec  desafio-php composer install
composer-update:
	@docker exec  desafio-php composer update
sh:
	docker exec -it desafio-php /bin/sh
