### SYMFONY
# ¯¯¯¯¯¯¯¯¯

define symfony
	cd apps/sylius && symfony $(1)
endef

ifeq (${SYMFONY_USE_DOCKER_ONLY},1)
define symfony.console
	$(call docker-compose,exec --user www-data ${BASH_CONTAINER} bash -c "cd apps/sylius/; ./bin/console $(1)")
endef
else
define symfony.console
	cd apps/sylius && symfony console $(1)
endef
endif

ifeq (${SYMFONY_USE_DOCKER_ONLY},1)
define symfony.composer
	$(call docker-compose,exec --user www-data ${BASH_CONTAINER} bash -c "cd apps/sylius/; composer $(1)")
endef
else
define symfony.composer
	cd apps/sylius && symfony composer $(1)
endef
endif

toto:
	$(call symfony.console,help)


symfony.domain.attach: ## Attach domains to symfony proxy
	for domain in ${DOMAINS}; \
	    do $(call symfony,local:proxy:domain:attach $$domain); \
	done;

symfony.server.start: ## Serve the app
	$(call symfony,serve -d || true)

symfony.server.stop: ## Serve the app
	$(call symfony,local:server:stop)

symfony.server.log: ## Tail the logs
	$(call symfony,local:server:log)

symfony.migration.generate: ## Generate migration file
	$(call symfony.console, doctrine:migrations:diff)

symfony.migration.execute: ## Excecute migration file
	$(call symfony.console, doctrine:migrations:execute ${ARGS})

symfony.load_fixtures: ## Load fixtures
	$(call symfony.console, hautelook:fixtures:load)
