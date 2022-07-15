#----------------------Make Environment----------------------
COMPOSE_CONFIG= -f docker/docker-compose.yml
PHP= php
DB= database
DB_NAME= precoro_test

#----------------------Actions----------------------
build:
	docker-compose $(COMPOSE_CONFIG) build

up:
	docker-compose $(COMPOSE_CONFIG) up -d; \
	docker-compose $(COMPOSE_CONFIG) exec $(PHP) composer update

down:
	docker-compose $(COMPOSE_CONFIG) stop

restart:
	docker-compose $(COMPOSE_CONFIG) restart

config:
	docker-compose $(COMPOSE_CONFIG) config

bash:
	docker-compose $(COMPOSE_CONFIG) exec $(PHP) bash

db:
	docker-compose $(COMPOSE_CONFIG) exec $(DB) mysql -u root -p $(DB_NAME)
