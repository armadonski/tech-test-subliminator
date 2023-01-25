.PHONY: build-development
build-development: ## Build the development docker image.
	docker compose -f docker/development/docker-compose.yml build