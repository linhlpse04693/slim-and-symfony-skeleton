build: ## build development environment
	cp .env.example .env
	cp ./slim/.env.example ./slim/.env
	docker-compose build
	docker-compose run --rm slim composer install
serve:
	docker-compose up -d
stop:
	docker-compose stop
down:
	docker-compose down -v
migrate:
