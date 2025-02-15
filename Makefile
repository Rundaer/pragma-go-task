DOCKER_COMPOSE = docker-compose
PHP_CONTAINER = pragma-php

##
## Project
## -----
##

build:
	$(DOCKER_COMPOSE) build

kill:
	$(DOCKER_COMPOSE) kill
	$(DOCKER_COMPOSE) down --remove-orphans

down:
	$(DOCKER_COMPOSE) down

install: ## Install and start the project
install: build

reinstall: ## Stop and start a fresh install of the project
reinstall: kill install start

reset: ## Stop and remake images
reset: down start

start: ## Start the project
	$(DOCKER_COMPOSE) up -d --remove-orphans --no-recreate

stop: ## Stop the project
	$(DOCKER_COMPOSE) stop

enter: ## Enter docker
	docker exec -it $(PHP_CONTAINER) bash

.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help
