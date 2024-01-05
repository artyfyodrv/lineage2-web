build:
	docker compose build
up:
	docker compose up -d
up-logs:
	docker compose up
down:
	docker compose down
stop:
	docker compose stop
start:
	docker compose start
php-bash:
	docker compose exec -it php-l2cms bash
php-logs:
	docker compose logs --follow php-l2web
php-logs-f:
	docker compose logs --follow php-l2web
nginx-bash:
	docker compose exec nginx-l2cms bash
nginx-logs:
	docker compose logs nginx-l2web
nginx-logs-f:
	docker compose logs --follow php-l2web
vendor:
	docker compose exec php-l2web bash -c "composer install"
install: up vendor
	@cp .env.example .env && \
	docker compose exec php-l2web bash -c "php artisan key:generate"
migrate:
	docker compose exec php-l2web bash -c "php artisan migrate"
