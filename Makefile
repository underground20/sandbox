init: down build

up:
	docker compose up -d

build:
	docker compose up -d --build

down:
	docker compose down -v --remove-orphans

composer-install:
	docker compose exec php-cli composer install

fill-db:
	docker compose exec postgres psql -U app -d demo -f demo.sql

phpstan-check:
	docker compose exec php-cli ./vendor/bin/phpstan analyse --ansi
