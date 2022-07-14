#----------------------Make Environment----------------------
COMPOSE_CONFIG= -f docker/docker-compose.yml
PHP= php

#----------------------Actions----------------------
build:
	docker-compose $(COMPOSE_CONFIG) build

up:
	docker-compose $(COMPOSE_CONFIG) up -d

down:
	docker-compose $(COMPOSE_CONFIG) stop

restart:
	docker-compose $(COMPOSE_CONFIG) restart

config:
	docker-compose $(COMPOSE_CONFIG) config

sh:
	docker-compose $(COMPOSE_CONFIG) exec $(PHP) sh


