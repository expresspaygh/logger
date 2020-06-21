## composer-test-packages: Command to install packages required for testing
composer-packages:
	@echo "=============Install packages required for testing============"
	composer install && composer update

## phpunit: Run PHPUnit tests
phpunit:
	composer run test

## help: Command to view help
help: Makefile
	@echo
	@echo "Choose a command to run in Expresspay Refine:"
	@echo
	@sed -n 's/^##//p' $< | column -t -s ':' |  sed -e 's/^/ /'
	@echo