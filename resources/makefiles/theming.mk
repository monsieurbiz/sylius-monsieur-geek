### THEMING
# ¯¯¯¯¯¯¯¯¯

theme.install: theme.yarn.install theme.build theme.assets.install ## Install everything we need to run theme commands

theme.build: ## Build the theme using gulp
	$(call docker-compose,run --rm -u www-data --entrypoint /bin/bash node -c "cd apps/sylius; yarn run gulp")

theme.yarn.install: ## Install yarn dependencies
	$(call docker-compose,run --rm -u www-data --entrypoint /bin/bash node -c "cd apps/sylius; yarn install")

theme.assets.install: theme.symlinks.broken.clean sylius.theme.assets.install ## Install theme(s) assets

theme.install.prod: ## Install and build the theme for production
	${MAKE} theme.install SYMFONY_ENV=prod

theme.symlinks.broken.clean: ## Remove all broken symlinks in themes/
	cd apps/sylius/themes; find . -type l ! -exec test -e {} \; -delete
