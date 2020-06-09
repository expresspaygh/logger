## composer-test-packages: Command to install packages required for testing
composer-packages:
	@echo "=============Install packages required for testing============"
	composer install

## run-tests: Command to run all test cases
run-tests:
	@echo "=============Run all test cases============"
	cd tests && php LoggerRun info success error debug runner

## help: Command to view help
help: Makefile
	@echo
	@echo "Choose a command to run in Expresspay Refine:"
	@echo
	@sed -n 's/^##//p' $< | column -t -s ':' |  sed -e 's/^/ /'
	@echo