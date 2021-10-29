build: ## build development environment
	cp .env.example .env
	docker-compose build
php:
	docker-compose run --rm php composer install
serve:
	docker-compose up -d
stop:
	docker-compose stop
down:
	docker-compose down -v