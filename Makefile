##################
# Variables
##################
DOCKER_COMPOSE = docker-compose

DOCKER_COMPOSE_PHP = ${DOCKER_COMPOSE} exec php

##################
# Script for setting up most of the required files for local development using docker-compose
##################
up:
	cp .env.example .env
	${DOCKER_COMPOSE} build
	${DOCKER_COMPOSE} up -d --remove-orphans

set_up:
	cp .env.example .env
	${DOCKER_COMPOSE} build
	${DOCKER_COMPOSE} up -d --remove-orphans
	${DOCKER_COMPOSE_PHP} composer install
	${DOCKER_COMPOSE_PHP} php artisan key:generate
	${DOCKER_COMPOSE_PHP} php artisan migrate
	${DOCKER_COMPOSE_PHP} php artisan passport:install
	${DOCKER_COMPOSE_PHP} php artisan storage:link
	${DOCKER_COMPOSE_PHP} php artisan db:seed

##################
# App
##################
app_bash:
	${DOCKER_COMPOSE_PHP} bash
