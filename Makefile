up:
	docker-compose up --build -d

down:
	docker-compose down

composer-install:
	docker run --rm -v $(PWD):/app composer install

composer-update:
	docker run --rm -v $(PWD):/app composer update

composer-require:
	docker run --rm -v $(PWD):/app composer require ${PACKAGE}

composer-dump-autoload:
	docker run --rm -v $(PWD):/app composer dump-autoload

db-migrate:
	docker exec -it property_web php artisan migrate

db-seed:
	docker exec -it property_web php artisan db:seed

run-tests:
	docker exec -it property_web vendor/bin/phpunit --testsuite Unit --log-junit build/logs/phpunit.junit.xml --coverage-xml build/logs/coverage-xml
