### COMPOSER
# ¯¯¯¯¯¯¯¯¯¯

composer.install: ## Run composer install
	$(call symfony.composer,install -o --prefer-source)

composer.install.dist: ## Run composer install (prefer dist)
	$(call symfony.composer,install -o --prefer-dist)

composer.install.dist.no-interaction: ## Run composer install (prefer dist, no interaction)
	$(call symfony.composer,install -o --prefer-dist -n)

composer.install.no-script: ## Run composer install without scripts
	$(call symfony.composer,install -o --prefer-source --no-scripts)

composer.autoload.dump: ## Dump Composer autoload (optimized)
	$(call symfony.composer,dump -o)
