.PHONY: start-development
start-development: docker-up composer-install run-migrations 

.PHONY composer-install:
	docker exec docker-php-1 composer install --no-interaction --no-scripts

.PHONY: npm-install
npm-install:
	docker exec docker-node-1 npm install

.PHONY docker-up:
docker-up:
	docker compose -f docker/docker-compose.yaml up --build -d

.PHONY: run-migrations
run-migrations:
	docker exec docker-php-1 wait-for-it database:3306
	docker exec docker-php-1 bin/console do:mi:mi --no-interaction

.PHONY stop-development:
stop-development:
	docker compose -f docker/docker-compose.yaml down --remove-orphans

.PHONY import-orders:
import-orders:
	docker exec docker-php-1 bin/console app:import-orders