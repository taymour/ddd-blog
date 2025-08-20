.PHONY: install start

install:
	docker compose build
	docker compose run --rm php composer install

start:
	docker compose up -d

shell:
	docker compose exec php bash
