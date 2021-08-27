
build: ## build develoment environment
	cp .env.example .env
	# cp ./nuxt/.env.example ./nuxt/.env
	cp ./slim/.env.example ./slim/.env
	docker-compose build
	docker-compose run --rm slim composer install
	docker-compose run --rm slim cp .env.example .env
serve:
	docker-compose up -d
stop:
	docker-compose stop
down:
	docker-compose down -v
migrate:
	docker-compose run --rm slim php artisan migrate
	docker-compose run --rm slim php artisan db:seed