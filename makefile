tinker:
	docker compose exec -u 0 php-cli php artisan tinker

cli:
	docker compose exec php-cli bash

npm-build:
	docker compose exec node npm run build

npm-install:
	docker compose exec node npm install

npm-dev:
	docker compose exec node npm run dev

