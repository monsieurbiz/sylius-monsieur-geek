.DEFAULT_GOAL := help
SHELL=/bin/bash

# Configuration
# ¯¯¯¯¯¯¯¯¯¯¯¯¯

DOMAINS=monsieurgeek
SYLIUS_FIXTURES_SUITE=monsieurgeek

BASH_CONTAINER=php
export USER_UID=$(shell id -u)

DC_DIR=infra/dev
DC_PREFIX=monsieurgeek

ifndef DC_PREFIX
  $(error Please define DC_PREFIX before running make)
endif

SYMFONY_ENV=dev

### QUICK
# ¯¯¯¯¯¯¯

up start: docker.up symfony.server.start ## Up

down: docker.down symfony.server.stop ## Down

stop: docker.stop symfony.server.stop ## Stop

logs: symfony.server.log ## Logs


### PROJECT
# ¯¯¯¯¯¯¯¯¯

project.install: docker.up app.start app.cache.clean composer.install sylius.install theme.install ## Install the project (⚠ Reset database)

project.infra.update: ## Update the Docker infrastructure
	${MAKE} PULL_FROM=1 docker.pull docker.build docker.up

include resources/makefiles/application.mk
include resources/makefiles/symfony.mk
include resources/makefiles/sylius.mk
include resources/makefiles/composer.mk
include resources/makefiles/theming.mk
include resources/makefiles/docker.mk
include resources/makefiles/help.mk
